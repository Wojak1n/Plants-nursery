<?php
require_once 'includes/functions.php';

// Get recipe ID from URL
$recipeId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no ID provided, redirect to recipes page
if ($recipeId <= 0) {
    header('Location: recipes.php');
    exit;
}

// Get recipe details
$recipe = getRecipeById($recipeId);

// If recipe not found, show error
if (!$recipe) {
    // Include header
    include 'includes/header.php';
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">';
    echo '<h1 class="text-3xl font-bold text-gray-900 mb-4">Recipe Not Found</h1>';
    echo '<p class="text-xl text-gray-600 mb-8">The recipe you are looking for could not be found.</p>';
    echo '<a href="recipes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">Back to Recipes</a>';
    echo '</div>';
    include 'includes/footer.php';
    exit;
}

// Include header
include 'includes/header.php';
?>

<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="index.php" class="text-gray-500 hover:text-gray-700">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="recipes.php" class="ml-2 text-gray-500 hover:text-gray-700">Recipes</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-2 text-gray-700 font-medium"><?= htmlspecialchars($recipe['title']) ?></span>
                </li>
            </ol>
        </nav>

        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-gray-900 mb-2"><?= htmlspecialchars($recipe['title']) ?></h1>
            <p class="text-lg text-primary-600">
                Made with 
                <a href="plant.php?id=<?= $recipe['plant_id'] ?>" class="hover:underline">
                    <?= htmlspecialchars($recipe['plant_name']) ?>
                </a>
            </p>
        </div>

        <div class="lg:grid lg:grid-cols-3 lg:gap-12">
            <div class="lg:col-span-2 order-2 lg:order-1">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Ingredients</h2>
                        <div class="prose prose-lg max-w-none">
                            <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?>
                        </div>
                    </div>
                    
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Instructions</h2>
                        <div class="prose prose-lg max-w-none">
                            <?= nl2br(htmlspecialchars($recipe['instructions'])) ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-8 lg:mb-0 order-1 lg:order-2">
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md sticky top-8">
                    <img src="<?= !empty($recipe['image']) ? '/assets/images/recipes/' . $recipe['image'] : 'https://images.pexels.com/photos/1640774/pexels-photo-1640774.jpeg' ?>" 
                         alt="<?= htmlspecialchars($recipe['title']) ?>" 
                         class="w-full h-64 object-cover">
                    
                    <div class="p-6 bg-white">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">About This Recipe</h3>
                        <p class="text-gray-600 mb-4">This healthy recipe features <?= htmlspecialchars($recipe['plant_name']) ?>, which is known for its nutritional benefits and delicious flavor.</p>
                        
                        <a href="plant.php?id=<?= $recipe['plant_id'] ?>" class="inline-block w-full bg-primary-600 hover:bg-primary-700 text-white text-center font-medium py-2 px-4 rounded-md shadow-sm transition-colors">
                            Learn More About <?= htmlspecialchars($recipe['plant_name']) ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>