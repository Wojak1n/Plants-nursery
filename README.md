# Green Haven Nursery Website

A professional website for a plant nursery featuring a collection of plants and healthy recipes.

## Features

- Responsive design for mobile, tablet, and desktop devices
- Dynamic plant catalog with detailed plant information
- Recipe collection linked to specific plants
- Search functionality for both plants and recipes
- Secure admin panel for content management
- Image upload capability for plants and recipes

## Technologies Used

- Frontend: HTML5, CSS3 with TailwindCSS, Vanilla JavaScript
- Backend: PHP with PDO
- Database: MySQL

## Setup Instructions

1. Import the database schema from `setup.sql`
2. Configure database connection in `includes/db.php`
3. Ensure proper file permissions for the `assets/images` directory

## Admin Access

- URL: `/admin/login.php`
- Default credentials:
  - Username: admin
  - Password: admin123

## Project Structure

- `/includes` - Core PHP functions and shared components
- `/assets` - CSS, JavaScript, and image files
- `/admin` - Administrative interface for content management

## Security Features

- PDO with prepared statements for database queries
- Input validation and sanitization
- Password hashing for admin authentication
- Proper error handling