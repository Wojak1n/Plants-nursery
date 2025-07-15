<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - Green Haven Nursery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .leaf-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23dc2626' fill-opacity='0.1'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-red-50 leaf-pattern min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <div class="mb-8">
            <div class="text-red-600 text-8xl mb-4">🚨</div>
            <h1 class="text-6xl font-bold text-red-800 mb-4">500</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Server Error</h2>
            <p class="text-gray-600 mb-8">
                Something went wrong on our end. Our gardeners are working to fix this issue. 
                Please try again in a few moments.
            </p>
        </div>
        
        <div class="space-y-4">
            <button onclick="window.location.reload()" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors">
                🔄 Try Again
            </button>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" class="text-red-600 hover:text-red-800 underline">
                    🏠 Back to Home
                </a>
                <a href="/contact.php" class="text-red-600 hover:text-red-800 underline">
                    📞 Contact Support
                </a>
            </div>
        </div>
        
        <div class="mt-12 text-sm text-gray-500">
            <p>If this problem persists, please contact our support team.</p>
            <p class="mt-2">Green Haven Nursery - We're here to help</p>
        </div>
    </div>
</body>
</html>
