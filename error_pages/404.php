<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Green Haven Nursery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .leaf-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23059669' fill-opacity='0.1'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-green-50 leaf-pattern min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <div class="mb-8">
            <div class="text-green-600 text-8xl mb-4">🌱</div>
            <h1 class="text-6xl font-bold text-green-800 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page Not Found</h2>
            <p class="text-gray-600 mb-8">
                Oops! The page you're looking for seems to have grown away. 
                Let's get you back to our garden of plants and recipes.
            </p>
        </div>
        
        <div class="space-y-4">
            <a href="/" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                🏠 Back to Home
            </a>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/plants.php" class="text-green-600 hover:text-green-800 underline">
                    🌿 Browse Plants
                </a>
                <a href="/recipes.php" class="text-green-600 hover:text-green-800 underline">
                    🥗 View Recipes
                </a>
                <a href="/contact.php" class="text-green-600 hover:text-green-800 underline">
                    📞 Contact Us
                </a>
            </div>
        </div>
        
        <div class="mt-12 text-sm text-gray-500">
            <p>Green Haven Nursery - Growing together since day one</p>
        </div>
    </div>
</body>
</html>
