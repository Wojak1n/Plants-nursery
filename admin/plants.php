<?php
require_once '../includes/functions.php';

// Require login
requireLogin();

// Check if search is being performed
$searchTerm = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Get plants based on search or get all
if (!empty($searchTerm)) {
    $plants = searchPlants($searchTerm);
} else {
    $plants = getAllPlants();
}
// Handle plant deletion
if (isset($_POST['delete_plant']) && isset($_POST['plant_id'])) {
    $plantId = (int)$_POST['plant_id'];
    
    try {
        $pdo = connectDB();
        
        // First, delete related recipes
        $stmt = $pdo->prepare("DELETE FROM recipes WHERE plant_id = :plant_id");
        $stmt->bindParam(':plant_id', $plantId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Then delete the plant
        $stmt = $pdo->prepare("DELETE FROM plants WHERE id = :id");
        $stmt->bindParam(':id', $plantId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Set success message
        $message = "Plant deleted successfully.";
        $messageType = "success";
        
        // Refresh plants list
        $plants = getAllPlants();
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        $messageType = "error";
    }
}

// Include admin header
include 'includes/header.php';
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manage Plants</h1>
    <a href="add_plant.php" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
        Add New Plant
    </a>
</div>

<?php if (isset($message)): ?>
    <div class="mb-6 p-4 rounded-md <?= $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <form action="plants.php" method="GET" class="mb-6">
            <div class="flex rounded-md shadow-sm">
                <input type="text" name="search" id="search" value="<?= htmlspecialchars($searchTerm) ?>" 
                       class="flex-1 min-w-0 block w-full px-4 py-2 rounded-l-md border-gray-300 focus:ring-primary-500 focus:border-primary-500 custom-focus"
                       placeholder="Search plants by name...">
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
                    <a href="plants.php" class="ml-4 text-primary-600 hover:text-primary-700">Clear search</a>
                </p>
            </div>
        <?php endif; ?>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scientific Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Related Recipes</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($plants)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                <?= !empty($searchTerm) ? 'No plants found matching your search.' : 'No plants found. Add your first plant!' ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($plants as $plant): 
                            // Get count of related recipes
                            $pdo = connectDB();
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM recipes WHERE plant_id = :plant_id");
                            $stmt->bindParam(':plant_id', $plant['id'], PDO::PARAM_INT);
                            $stmt->execute();
                            $recipeCount = $stmt->fetchColumn();
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-12 w-12 rounded overflow-hidden bg-gray-100">
                                    <img src="<?= !empty($plant['image']) ? '/plants-nursery/assets/images/plants/' . $plant['image'] : 'https://images.pexels.com/photos/1084199/pexels-photo-1084199.jpeg' ?>" 
     alt="<?= htmlspecialchars($plant['name']) ?>" 
     class="h-full w-full object-cover">

                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($plant['name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($plant['scientific_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $recipeCount ?> recipe<?= $recipeCount !== 1 ? 's' : '' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="edit_plant.php?id=<?= $plant['id'] ?>" class="text-primary-600 hover:text-primary-700 mr-3">Edit</a>
                                    <form action="plants.php" method="POST" class="inline" onsubmit="return confirmDelete('Are you sure you want to delete this plant? This will also delete all related recipes.')">
                                        <input type="hidden" name="plant_id" value="<?= $plant['id'] ?>">
                                        <button type="submit" name="delete_plant" class="text-red-600 hover:text-red-700 cursor-pointer">Delete</button>
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