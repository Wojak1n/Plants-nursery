<?php
require_once 'includes/functions.php';

// Get featured plants
$featuredPlants = getFeaturedPlants(6);
// Include header
include 'includes/header.php';
?>

<section class="relative h-96 bg-primary-800 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg" alt="Plants nursery" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="text-white max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4 slide-up">Welcome to Green Haven Nursery</h1>
            <p class="text-lg md:text-xl mb-8 slide-up">Your trusted source for beautiful plants and healthy, plant-based recipes.</p>
            <div class="space-x-4 slide-up">
                <a href="plants.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                    Explore Plants
                </a>
                <a href="recipes.php" class="inline-block bg-white hover:bg-gray-100 text-primary-800 font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                    View Recipes
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">About Green Haven</h2>
            <p class="max-w-3xl mx-auto text-lg text-gray-600">At Green Haven Nursery, we're passionate about helping you bring the beauty and benefits of plants into your life. Our carefully curated collection of plants and healthy recipes makes it easy to create a thriving green space and nourish your body with plant-based goodness.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-grow">
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Expert Knowledge</h3>
                    <p class="text-gray-600">Our team of plant specialists are passionate about sharing their expertise to help your plants thrive.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-grow">
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Quality Plants</h3>
                    <p class="text-gray-600">We source the healthiest plants and provide detailed care information for each variety.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-grow">
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Healthy Recipes</h3>
                    <p class="text-gray-600">Discover delicious, nutritious recipes featuring plants from our nursery for a healthier lifestyle.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Featured Plants</h2>
            <p class="max-w-3xl mx-auto text-lg text-gray-600">Explore our selection of beautiful, healthy plants for your home or garden.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($featuredPlants as $plant): ?>
                <a href="plant.php?id=<?= $plant['id'] ?>" class="plant-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-56 relative">
                        <img src="<?= !empty($plant['image']) ? '/plants-nursery/assets/images/plants/' . $plant['image'] : 'https://images.pexels.com/photos/1084199/pexels-photo-1084199.jpeg' ?>" 
                             alt="<?= htmlspecialchars($plant['name']) ?>" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($plant['name']) ?></h3>
                        <p class="text-sm text-gray-500 italic mb-2"><?= htmlspecialchars($plant['scientific_name']) ?></p>
                        <p class="text-gray-600 line-clamp-2"><?= substr(htmlspecialchars($plant['description']), 0, 100) ?>...</p>
                        <div class="mt-4 text-primary-600 font-medium">View Details →</div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="plants.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                View All Plants
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
            <div>
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-6">Bringing Nature to Your Home</h2>
                <p class="text-lg text-gray-600 mb-6">Our plants are carefully selected and nurtured to ensure they thrive in your home or garden. Whether you're a seasoned plant parent or just starting your green journey, we have the perfect plants for you.</p>
                <p class="text-lg text-gray-600 mb-6">Plus, explore our collection of healthy recipes that make the most of fresh, plant-based ingredients for a healthier lifestyle.</p>
                <div class="flex space-x-4">
                    <a href="plants.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                        Shop Plants
                    </a>
                    <a href="recipes.php" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-md shadow-md transition-colors">
                        Browse Recipes
                    </a>
                </div>
            </div>
            <div class="mt-10 lg:mt-0">
                <img src="https://images.pexels.com/photos/793012/pexels-photo-793012.jpeg" alt="Indoor plants" class="rounded-lg shadow-xl">
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-primary-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-serif font-bold mb-6">Get 10% Off Your First Order</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Subscribe to our newsletter for gardening tips, plant care advice, and exclusive offers.</p>
        <form class="max-w-md mx-auto">
            <div class="flex">
                <input type="email" placeholder="Enter your email" class="flex-1 rounded-l-md border-0 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-primary-500">
                <button type="submit" class="bg-white text-primary-700 font-medium px-6 py-3 rounded-r-md hover:bg-gray-100 transition-colors">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>