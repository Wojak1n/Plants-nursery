<?php
require_once 'includes/functions.php';

// Check if search is being performed
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Get recipes based on search or get all
if (!empty($searchTerm)) {
    $recipes = searchRecipes($searchTerm);
} else {
    $recipes = getAllRecipes();
}

// Include header
include 'includes/header.php';
?>

<section class="bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-4">Healthy Recipes</h1>
        <p class="text-lg text-gray-600 max-w-3xl">Discover delicious, nutritious recipes featuring plants from our nursery. Perfect for a healthier lifestyle and making the most of fresh ingredients.</p>
        
        <div class="mt-8">
            <form action="recipes.php" method="GET" class="max-w-lg">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" id="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           class="flex-1 min-w-0 block w-full px-4 py-3 rounded-l-md border-gray-300 focus:ring-primary-500 focus:border-primary-500 custom-focus"
                           placeholder="Search recipes by title...">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-r-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (!empty($searchTerm)): ?>
            <div class="mb-8">
                <p class="text-lg">
                    Search results for: <span class="font-medium"><?= htmlspecialchars($searchTerm) ?></span>
                    <a href="recipes.php" class="ml-4 text-primary-600 hover:text-primary-700">Clear search</a>
                </p>
            </div>
        <?php endif; ?>
        
        <?php if (empty($recipes)): ?>
            <div class="text-center py-12">
                <p class="text-xl text-gray-600">No recipes found. Try a different search term.</p>
                <a href="recipes.php" class="mt-4 inline-block text-primary-600 hover:text-primary-700">View all recipes</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($recipes as $recipe): ?>
                    <a href="recipe.php?id=<?= $recipe['id'] ?>" class="recipe-card bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 relative">
                            <img src="<?= !empty($recipe['image']) ? '/PFE-NEW/assets/images/recipes/' . $recipe['image'] : 'https://images.pexels.com/photos/1640774/pexels-photo-1640774.jpeg' ?>" 
                                 alt="<?= htmlspecialchars($recipe['title']) ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($recipe['title']) ?></h2>
                            <p class="text-sm text-primary-600 mb-3">Plant: <?= htmlspecialchars($recipe['plant_name']) ?></p>
                            <p class="text-gray-600 line-clamp-3"><?= substr(htmlspecialchars($recipe['ingredients']), 0, 150) ?>...</p>
                            <div class="mt-4 text-primary-600 font-medium">View Recipe →</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>