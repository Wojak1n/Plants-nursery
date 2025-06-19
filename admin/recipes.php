<?php
require_once '../includes/functions.php';

// Require login
requireLogin();

// Check if search is being performed
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Get recipes based on search or get all
if (!empty($searchTerm)) {
    $recipes = searchRecipes($searchTerm);
} else {
    $recipes = getAllRecipes();
}
// Handle recipe deletion
if (isset($_POST['delete_recipe']) && isset($_POST['recipe_id'])) {
    $recipeId = (int)$_POST['recipe_id'];
    
    try {
        $pdo = connectDB();
        
        // Delete the recipe
        $stmt = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
        $stmt->bindParam(':id', $recipeId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Set success message
        $message = "Recipe deleted successfully.";
        $messageType = "success";
        
        // Refresh recipes list
        $recipes = getAllRecipes();
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        $messageType = "error";
    }
}

// Include admin header
include 'includes/header.php';
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manage Recipes</h1>
    <a href="add_recipe.php" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
        Add New Recipe
    </a>
</div>

<?php if (isset($message)): ?>
    <div class="mb-6 p-4 rounded-md <?= $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <form action="recipes.php" method="GET" class="mb-6">
            <div class="flex rounded-md shadow-sm">
                <input type="text" name="search" id="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                       class="flex-1 min-w-0 block w-full px-4 py-2 rounded-l-md border-gray-300 focus:ring-primary-500 focus:border-primary-500 custom-focus"
                       placeholder="Search recipes by title...">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Search
                </button>
            </div>
        </form>
        
        <?php if (!empty($searchTerm)): ?>
            <div class="mb-4">
                <p>
                    Search results for: <span class="font-medium"><?= htmlspecialchars($searchTerm) ?></span>
                    <a href="recipes.php" class="ml-4 text-primary-600 hover:text-primary-700">Clear search</a>
                </p>
            </div>
        <?php endif; ?>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Related Plant</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($recipes)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                <?= !empty($searchTerm) ? 'No recipes found matching your search.' : 'No recipes found. Add your first recipe!' ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($recipes as $recipe): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-12 w-12 rounded overflow-hidden bg-gray-100">
                                        <img src="<?= !empty($recipe['image']) ? '/assets/images/recipes/' . $recipe['image'] : 'https://images.pexels.com/photos/1640774/pexels-photo-1640774.jpeg' ?>" 
                                             alt="<?= htmlspecialchars($recipe['title']) ?>" 
                                             class="h-full w-full object-cover">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($recipe['title']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($recipe['plant_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="edit_recipe.php?id=<?= $recipe['id'] ?>" class="text-primary-600 hover:text-primary-700 mr-3">Edit</a>
                                    <form action="recipes.php" method="POST" class="inline" onsubmit="return confirmDelete('Are you sure you want to delete this recipe?')">
                                        <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                                        <button type="submit" name="delete_recipe" class="text-red-600 hover:text-red-700 cursor-pointer">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>