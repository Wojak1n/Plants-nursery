<?php
require_once 'includes/functions.php';

// Get featured plants
$featuredPlants = getFeaturedPlants(6);

// Include header
include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-image">
        <img src="https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg" alt="Plants nursery">
    </div>
    <div class="container hero-content">
        <div class="text-content slide-up">
            <h1 class="title-large mb-4">Welcome to Green Haven Nursery</h1>
            <p class="subtitle mb-8">Your trusted source for beautiful plants and healthy, plant-based recipes.</p>
            <div class="button-group">
                <a href="plants.php" class="btn btn-primary">Explore Plants</a>
                <a href="recipes.php" class="btn btn-secondary">View Recipes</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="title-medium mb-4">About Green Haven</h2>
            <p class="text-content">At Green Haven Nursery, we're passionate about helping you bring the beauty and benefits of plants into your life. Our carefully curated collection of plants and healthy recipes makes it easy to create a thriving green space and nourish your body with plant-based goodness.</p>
        </div>
        
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="feature-title">Expert Knowledge</h3>
                <p class="feature-text">Our team of plant specialists are passionate about sharing their expertise to help your plants thrive.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="feature-title">Quality Plants</h3>
                <p class="feature-text">We source the healthiest plants and provide detailed care information for each variety.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                    </svg>
                </div>
                <h3 class="feature-title">Healthy Recipes</h3>
                <p class="feature-text">Discover delicious, nutritious recipes featuring plants from our nursery for a healthier lifestyle.</p>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="title-medium mb-4">Featured Plants</h2>
            <p class="text-content">Explore our selection of beautiful, healthy plants for your home or garden.</p>
        </div>
        
        <div class="plant-grid">
            <?php foreach ($featuredPlants as $plant): ?>
                <a href="plant.php?id=<?= $plant['id'] ?>" class="plant-card">
                    <div class="plant-image">
                        <img src="<?= !empty($plant['image']) ? '/plants-nursery/assets/images/plants/' . $plant['image'] : 'https://images.pexels.com/photos/1084199/pexels-photo-1084199.jpeg' ?>" 
                             alt="<?= htmlspecialchars($plant['name']) ?>">
                    </div>
                    <div class="plant-content">
                        <h3 class="plant-title"><?= htmlspecialchars($plant['name']) ?></h3>
                        <p class="plant-scientific-name"><?= htmlspecialchars($plant['scientific_name']) ?></p>
                        <p class="plant-description"><?= substr(htmlspecialchars($plant['description']), 0, 100) ?>...</p>
                        <div class="plant-link">View Details →</div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="plants.php" class="btn btn-primary">View All Plants</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="content-grid">
            <div class="content-text">
                <h2 class="title-medium mb-6">Bringing Nature to Your Home</h2>
                <p class="text-content mb-6">Our plants are carefully selected and nurtured to ensure they thrive in your home or garden. Whether you're a seasoned plant parent or just starting your green journey, we have the perfect plants for you.</p>
                <p class="text-content mb-6">Plus, explore our collection of healthy recipes that make the most of fresh, plant-based ingredients for a healthier lifestyle.</p>
                <div class="button-group">
                    <a href="plants.php" class="btn btn-primary">Shop Plants</a>
                    <a href="recipes.php" class="btn btn-secondary">Browse Recipes</a>
                </div>
            </div>
            <div class="content-image">
                <img src="https://images.pexels.com/photos/793012/pexels-photo-793012.jpeg" alt="Indoor plants" class="rounded-image shadow">
            </div>
        </div>
    </div>
</section>

<section class="newsletter-section">
    <div class="container text-center">
        <h2 class="title-medium mb-6">Get 10% Off Your First Order</h2>
        <p class="newsletter-text mb-8">Subscribe to our newsletter for gardening tips, plant care advice, and exclusive offers.</p>
        <form class="newsletter-form">
            <div class="form-group">
                <input type="email" placeholder="Enter your email" class="form-input">
                <button type="submit" class="btn btn-light">Subscribe</button>
            </div>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>