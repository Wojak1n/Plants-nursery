<?php
require_once '../includes/functions.php';

// Require login
requireLogin();

$message = '';
$messageType = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $scientificName = isset($_POST['scientific_name']) ? sanitizeInput($_POST['scientific_name']) : '';
    $description = isset($_POST['description']) ? sanitizeInput($_POST['description']) : '';
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Plant name is required';
    }
    
    if (empty($scientificName)) {
        $errors[] = 'Scientific name is required';
    }
    
    if (empty($description)) {
        $errors[] = 'Description is required';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        try {
            // Handle image upload
            $imageName = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = uploadImage($_FILES['image'], 'plants');
                if ($uploadResult['success']) {
                    $imageName = $uploadResult['filename'];
                } else {
                    throw new Exception($uploadResult['message']);
                }
            }
            
            // Insert plant into database
            $pdo = connectDB();
            $stmt = $pdo->prepare("
                INSERT INTO plants (name, scientific_name, description, image) 
                VALUES (:name, :scientific_name, :description, :image)
            ");
            
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':scientific_name', $scientificName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':image', $imageName, PDO::PARAM_STR);
            
            $stmt->execute();
            
            // Set success message
            $message = "Plant added successfully.";
            $messageType = "success";
            
            // Clear form fields
            $name = $scientificName = $description = '';
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
            $messageType = "error";
        }
    } else {
        $message = "Please correct the following errors:<br>" . implode('<br>', $errors);
        $messageType = "error";
    }
}

// Include admin header
include 'includes/header.php';
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Add New Plant</h1>
    <a href="plants.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
        Back to Plants
    </a>
</div>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-md <?= $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <form action="add_plant.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Plant Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                       required>
            </div>
            
            <div>
                <label for="scientific_name" class="block text-sm font-medium text-gray-700 mb-1">
                    Scientific Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="scientific_name" name="scientific_name" value="<?= isset($scientificName) ? htmlspecialchars($scientificName) : '' ?>" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                       required>
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="6" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                          required><?= isset($description) ? htmlspecialchars($description) : '' ?></textarea>
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                    Plant Image
                </label>
                <input type="file" id="image" name="image" accept="image/*" 
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-medium
                              file:bg-primary-50 file:text-primary-700
                              hover:file:bg-primary-100">
                <p class="mt-1 text-sm text-gray-500">Upload a JPG, PNG, or GIF image (max 5MB).</p>
            </div>
            
            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="plants.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Add Plant
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>