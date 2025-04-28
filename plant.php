<?php
require_once 'includes/functions.php';

// Get plant ID from URL
$plantId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no ID provided, redirect to plants page
if ($plantId <= 0) {
    header('Location: plants.php');
    exit;
}

// Get plant details
$plant = getPlantById($plantId);

// If plant not found, show error
if (!$plant) {
    // Include header
    include 'includes/header.php';
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">';
    echo '<h1 class="text-3xl font-bold text-gray-900 mb-4">Plant Not Found</h1>';
    echo '<p class="text-xl text-gray-600 mb-8">The plant you are looking for could not be found.</p>';
    echo '<a href="plants.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">Back to Plants</a>';
    echo '</div>';
    include 'includes/footer.php';
    exit;
}

// Get related recipes
$relatedRecipes = getRecipesByPlantId($plantId);

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
                    <a href="plants.php" class="ml-2 text-gray-500 hover:text-gray-700">Plants</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-2 text-gray-700 font-medium"><?= htmlspecialchars($plant['name']) ?></span>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <div class="mb-8 lg:mb-0">
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                    <img src="<?= !empty($plant['image']) ? '/Plants-nursery/assets/images/plants/' . $plant['image'] : 'https://images.pexels.com/photos/1084199/pexels-photo-1084199.jpeg' ?>" 
                         alt="<?= htmlspecialchars($plant['name']) ?>" 
                         class="w-full h-96 object-cover">
                </div>
            </div>
            
            <div>
                <h1 class="text-3xl font-serif font-bold text-gray-900 mb-2"><?= htmlspecialchars($plant['name']) ?></h1>
                <p class="text-lg text-gray-600 italic mb-6"><?= htmlspecialchars($plant['scientific_name']) ?></p>
                
                <div class="prose prose-lg max-w-none">
                    <p><?= nl2br(htmlspecialchars($plant['description'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($relatedRecipes)): ?>
<section class="bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-serif font-bold text-gray-900 mb-8">Healthy Recipes with <?= htmlspecialchars($plant['name']) ?></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($relatedRecipes as $recipe): ?>
                <a href="recipe.php?id=<?= $recipe['id'] ?>" class="recipe-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 relative">
                        <img src="<?= !empty($recipe['image']) ? '/assets/images/recipes/' . $recipe['image'] : 'https://images.pexels.com/photos/1640774/pexels-photo-1640774.jpeg' ?>" 
                             alt="<?= htmlspecialchars($recipe['title']) ?>" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3"><?= htmlspecialchars($recipe['title']) ?></h3>
                        <p class="text-gray-600 line-clamp-3"><?= substr(htmlspecialchars($recipe['ingredients']), 0, 100) ?>...</p>
                        <div class="mt-4 text-primary-600 font-medium">View Recipe →</div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-10 text-center">
            <a href="recipes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                View All Recipes
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>