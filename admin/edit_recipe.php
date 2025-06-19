<?php
require_once '../includes/functions.php';

// Require login
requireLogin();

// Get recipe ID from URL
$recipeId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// If no ID provided, redirect to recipes page
if ($recipeId <= 0) {
    header('Location: recipes.php');
    exit;
}

// Get recipe details
$recipe = getRecipeById($recipeId);

// If recipe not found, redirect to recipes page with error
if (!$recipe) {
    header('Location: recipes.php');
    exit;
}

// Get all plants for the dropdown
$plants = getAllPlants();

$message = '';
$messageType = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = isset($_POST['title']) ? sanitizeInput($_POST['title']) : '';
    $plantId = isset($_POST['plant_id']) ? (int)$_POST['plant_id'] : 0;
    $ingredients = isset($_POST['ingredients']) ? sanitizeInput($_POST['ingredients']) : '';
    $instructions = isset($_POST['instructions']) ? sanitizeInput($_POST['instructions']) : '';
    
    // Validate inputs
    $errors = [];
    
    if (empty($title)) {
        $errors[] = 'Recipe title is required';
    }
    
    if ($plantId <= 0) {
        $errors[] = 'Please select a plant';
    }
    
    if (empty($ingredients)) {
        $errors[] = 'Ingredients are required';
    }
    
    if (empty($instructions)) {
        $errors[] = 'Instructions are required';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        try {
            // Handle image upload
            $imageName = $recipe['image']; // Keep existing image by default
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = uploadImage($_FILES['image'], 'recipes');
                if ($uploadResult['success']) {
                    $imageName = $uploadResult['filename'];
                } else {
                    throw new Exception($uploadResult['message']);
                }
            }
            
            // Update recipe in database
            $pdo = connectDB();
            $stmt = $pdo->prepare("
                UPDATE recipes 
                SET plant_id = :plant_id, title = :title, ingredients = :ingredients, instructions = :instructions, image = :image
                WHERE id = :id
            ");
            
            $stmt->bindParam(':plant_id', $plantId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
            $stmt->bindParam(':image', $imageName, PDO::PARAM_STR);
            $stmt->bindParam(':id', $recipeId, PDO::PARAM_INT);
            
            $stmt->execute();
            
            // Set success message
            $message = "Recipe updated successfully.";
            $messageType = "success";
            
            // Refresh recipe data
            $recipe = getRecipeById($recipeId);
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
    <h1 class="text-2xl font-bold">Edit Recipe</h1>
    <a href="recipes.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
        Back to Recipes
    </a>
</div>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-md <?= $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <form action="edit_recipe.php?id=<?= $recipeId ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    Recipe Title <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($recipe['title']) ?>" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                       required>
            </div>
            
            <div>
                <label for="plant_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Related Plant <span class="text-red-500">*</span>
                </label>
                <select id="plant_id" name="plant_id" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                        required>
                    <option value="">Select a plant</option>
                    <?php foreach ($plants as $plant): ?>
                        <option value="<?= $plant['id'] ?>" <?= $recipe['plant_id'] === $plant['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($plant['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-1">
                    Ingredients <span class="text-red-500">*</span>
                </label>
                <textarea id="ingredients" name="ingredients" rows="6" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                          required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
            </div>
            
            <div>
                <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">
                    Instructions <span class="text-red-500">*</span>
                </label>
                <textarea id="instructions" name="instructions" rows="8" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                          required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                    Recipe Image
                </label>
                
                <?php if (!empty($recipe['image'])): ?>
                    <div class="mt-2 mb-4">
                        <p class="text-sm text-gray-500 mb-2">Current image:</p>
                        <img src="<?= '/assets/images/recipes/' . $recipe['image'] ?>" 
                             alt="<?= htmlspecialchars($recipe['title']) ?>" 
                             class="h-32 w-auto object-cover rounded-md">
                    </div>
                <?php endif; ?>
                
                <input type="file" id="image" name="image" accept="image/*" 
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-medium
                              file:bg-primary-50 file:text-primary-700
                              hover:file:bg-primary-100">
                <p class="mt-1 text-sm text-gray-500">Upload a new JPG, PNG, or GIF image (max 5MB) or leave empty to keep the current image.</p>
            </div>
            
            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="recipes.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Update Recipe
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>