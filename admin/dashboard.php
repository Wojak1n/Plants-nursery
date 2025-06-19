<?php
require_once '../includes/functions.php';

// Require login
requireLogin();
// Include admin header
include './includes/header.php';
?>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
 <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-primary-50 p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Plants</h3>
                <span class="bg-primary-100 text-primary-800 py-1 px-3 rounded-full text-sm font-medium">
                    <?php
                    $pdo = connectDB();
                    $stmt = $pdo->query("SELECT COUNT(*) FROM plants");
                    echo $stmt->fetchColumn();
                    ?>
                </span>
            </div>
            <p class="text-gray-600 mb-4">Manage your plants collection</p>
            <a href="plants.php" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                Manage Plants
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="bg-primary-50 p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Recipes</h3>
                <span class="bg-primary-100 text-primary-800 py-1 px-3 rounded-full text-sm font-medium">
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) FROM recipes");
                    echo $stmt->fetchColumn();
                    ?>
                </span>
            </div>
            <p class="text-gray-600 mb-4">Manage your healthy recipes</p>
            <a href="recipes.php" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                Manage Recipes
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="bg-primary-50 p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Website</h3>
                <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm font-medium">Online</span>
            </div>
            <p class="text-gray-600 mb-4">View your public website</p>
            <a href="../index.php" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                Visit Website
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">Recent Plants</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scientific Name</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM plants ORDER BY id DESC LIMIT 5");
                    $recentPlants = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (!empty($recentPlants)):
                        foreach ($recentPlants as $plant):
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($plant['name']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($plant['scientific_name']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="edit_plant.php?id=<?= $plant['id'] ?>" class="text-primary-600 hover:text-primary-700">Edit</a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No plants found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 text-right">
            <a href="plants.php" class="text-primary-600 hover:text-primary-700 font-medium">View All Plants</a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">Recent Recipes</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plant</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $stmt = $pdo->query("
                        SELECT r.*, p.name as plant_name 
                        FROM recipes r
                        JOIN plants p ON r.plant_id = p.id
                        ORDER BY r.id DESC LIMIT 5
                    ");
                    $recentRecipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (!empty($recentRecipes)):
                        foreach ($recentRecipes as $recipe):
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($recipe['title']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($recipe['plant_name']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="edit_recipe.php?id=<?= $recipe['id'] ?>" class="text-primary-600 hover:text-primary-700">Edit</a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No recipes found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 text-right">
            <a href="recipes.php" class="text-primary-600 hover:text-primary-700 font-medium">View All Recipes</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>