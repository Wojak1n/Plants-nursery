<?php
// Include database connection
require_once 'db.php';

// Sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get all plants
function getAllPlants() {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM plants ORDER BY name");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get featured plants (limit to a specific number)
function getFeaturedPlants($limit = 6) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM plants ORDER BY RAND() LIMIT :limit");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Get a single plant by ID
function getPlantById($id) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM plants WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Search plants by name
function searchPlants($search) {
    $pdo = connectDB();
    $search = '%' . $search . '%';
    $stmt = $pdo->prepare("SELECT * FROM plants WHERE name LIKE :search OR scientific_name LIKE :search");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get all recipes
function getAllRecipes() {
    $pdo = connectDB();
    $stmt = $pdo->prepare("
        SELECT r.*, p.name as plant_name 
        FROM recipes r
        JOIN plants p ON r.plant_id = p.id
        ORDER BY r.title
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get recipes for a specific plant
function getRecipesByPlantId($plantId) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE plant_id = :plant_id");
    $stmt->bindParam(':plant_id', $plantId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get a single recipe by ID
function getRecipeById($id) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("
        SELECT r.*, p.name as plant_name, p.id as plant_id 
        FROM recipes r
        JOIN plants p ON r.plant_id = p.id
        WHERE r.id = :id
    ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Search recipes by title
function searchRecipes($search) {
    $pdo = connectDB();
    $search = '%' . $search . '%';
    $stmt = $pdo->prepare("
        SELECT r.*, p.name as plant_name 
        FROM recipes r
        JOIN plants p ON r.plant_id = p.id
        WHERE r.title LIKE :search
    ");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Handle file upload for images
function uploadImage($file, $directory = 'plants') {
    // Set the target directory
    $targetDir = "../assets/images/" . $directory . "/";
    
    // Create directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Generate a unique filename
    $fileName = uniqid() . "_" . basename($file["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if image file is an actual image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return ["success" => false, "message" => "File is not an image."];
    }
    
    // Check file size (limit to 5MB)
    if ($file["size"] > 5000000) {
        return ["success" => false, "message" => "File is too large. Max size is 5MB."];
    }
    
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return ["success" => false, "message" => "Only JPG, JPEG, PNG & GIF files are allowed."];
    }
    
    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return ["success" => true, "filename" => $fileName];
    } else {
        return ["success" => false, "message" => "There was an error uploading your file."];
    }
}

// Check if user is logged in
function isLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login-admin.php");
        exit;
    }
}