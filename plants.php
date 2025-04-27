<?php
require_once 'includes/functions.php';

// Check if search is being performed
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Get plants based on search or get all
if (!empty($searchTerm)) {
    $plants = searchPlants($searchTerm);
} else {
    $plants = getAllPlants();
}

// Include header
include 'includes/header.php';
?>

<section class="bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-4">Our Plants Collection</h1>
        <p class="text-lg text-gray-600 max-w-3xl">Discover our wide variety of beautiful, healthy plants for your home and garden. Each plant comes with detailed care instructions to help you keep it thriving.</p>
        
        <div class="mt-8">
            <form action="plants.php" method="GET" class="max-w-lg">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" id="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                           class="flex-1 min-w-0 block w-full px-4 py-3 rounded-l-md border-gray-300 focus:ring-primary-500 focus:border-primary-500 custom-focus"
                           placeholder="Search plants by name...">
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
                    <a href="plants.php" class="ml-4 text-primary-600 hover:text-primary-700">Clear search</a>
                </p>
            </div>
        <?php endif; ?>
        
        <?php if (empty($plants)): ?>
            <div class="text-center py-12">
                <p class="text-xl text-gray-600">No plants found. Try a different search term.</p>
                <a href="plants.php" class="mt-4 inline-block text-primary-600 hover:text-primary-700">View all plants</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($plants as $plant): ?>
                    <a href="plant.php?id=<?= $plant['id'] ?>" class="plant-card bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-56 relative">
                            <img src="<?= !empty($plant['image']) ? '/assets/images/plants/' . $plant['image'] : 'https://images.pexels.com/photos/1084199/pexels-photo-1084199.jpeg' ?>" 
                                 alt="<?= htmlspecialchars($plant['name']) ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($plant['name']) ?></h2>
                            <p class="text-sm text-gray-500 italic mb-3"><?= htmlspecialchars($plant['scientific_name']) ?></p>
                            <p class="text-gray-600 line-clamp-3"><?= substr(htmlspecialchars($plant['description']), 0, 150) ?>...</p>
                            <div class="mt-4 text-primary-600 font-medium">View Details →</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>