<?php
require_once '../includes/functions.php';

// Require login for all admin pages
requireLogin();

// Get current page for active sidebar highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Green Haven Nursery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9f1',
                            100: '#dcf1df',
                            200: '#bae3c1',
                            300: '#8ecf9a',
                            400: '#5fb56e',
                            500: '#3e9a4e',
                            600: '#2d7b3c',
                            700: '#266333',
                            800: '#224f2c',
                            900: '#1e4226',
                            950: '#0f2514',
                        }
                    },
                },
                fontFamily: {
                    'sans': ['Poppins', 'sans-serif'],
                    'serif': ['Merriweather', 'serif'],
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="bg-primary-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="./dashboard.php" class="font-serif font-bold text-xl">Green Haven Admin</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="../admin/logout.php" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-800 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-primary-800 focus:ring-white">
                                Log Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-grow flex">
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64 border-r border-gray-200 pt-5 pb-4 bg-white">
                    <div class="flex-grow flex flex-col">
                        <nav class="flex-1 px-2 space-y-1 admin-sidebar">
                            <a href="./dashboard.php" class="admin-link <?= $currentPage === 'dashboard.php' ? 'active bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 <?= $currentPage === 'dashboard.php' ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>

                            <a href="./plants.php" class="admin-link <?= $currentPage === 'plants.php' || $currentPage === 'add_plant.php' || $currentPage === 'edit_plant.php' ? 'active bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 <?= $currentPage === 'plants.php' || $currentPage === 'add_plant.php' || $currentPage === 'edit_plant.php' ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Manage Plants
                            </a>

                            <a href="./recipes.php" class="admin-link <?= $currentPage === 'recipes.php' || $currentPage === 'add_recipe.php' || $currentPage === 'edit_recipe.php' ? 'active bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 <?= $currentPage === 'recipes.php' || $currentPage === 'add_recipe.php' || $currentPage === 'edit_recipe.php' ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                Manage Recipes
                            </a>

                            <div class="pt-4 mt-4 border-t border-gray-200">
                                <a href="../" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    View Website
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="flex-1 max-w-full overflow-hidden">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Mobile menu button -->
                        <div class="md:hidden mb-6">
                            <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                                <span class="sr-only">Open main menu</span>
                                <!-- Icon when menu is closed -->
                                <svg id="menu-closed-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <!-- Icon when menu is open -->
                                <svg id="menu-open-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Mobile menu -->
                        <div id="mobile-menu" class="md:hidden hidden bg-white shadow-md rounded-md overflow-hidden mb-6">
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="/admin/dashboard.php" class="<?= $currentPage === 'dashboard.php' ? 'bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> block px-3 py-2 rounded-md text-base font-medium">
                                    Dashboard
                                </a>
                                <a href="/admin/plants.php" class="<?= $currentPage === 'plants.php' || $currentPage === 'add_plant.php' || $currentPage === 'edit_plant.php' ? 'bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> block px-3 py-2 rounded-md text-base font-medium">
                                    Manage Plants
                                </a>
                                <a href="/admin/recipes.php" class="<?= $currentPage === 'recipes.php' || $currentPage === 'add_recipe.php' || $currentPage === 'edit_recipe.php' ? 'bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?> block px-3 py-2 rounded-md text-base font-medium">
                                    Manage Recipes
                                </a>
                                <a href="/" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                                    View Website
                                </a>
                                <a href="/admin/logout.php" class="text-red-600 hover:bg-red-50 hover:text-red-900 block px-3 py-2 rounded-md text-base font-medium">
                                    Log Out
                                </a>
                            </div>
                        </div>