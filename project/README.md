# PHP Login System with PDO and MySQL

A secure and responsive login system built with PHP, PDO, MySQL, and styled with Tailwind CSS.

## Features

- Secure user authentication with password hashing
- PDO with prepared statements for database interactions
- Responsive design with Tailwind CSS
- Input validation and sanitization
- Session management
- Clean separation of concerns

## Setup Instructions

1. **Database Setup**

   - Create a MySQL database
   - Import the database schema from `setup.sql`
   - Update database credentials in `config.php`

   ```bash
   mysql -u username -p < setup.sql
   ```

2. **Configure Web Server**

   Make sure your web server (Apache, Nginx, etc.) is configured to serve PHP files.

3. **Test the Application**

   Navigate to the project in your web browser. You can log in with the test account:
   
   - Email: test@example.com
   - Password: password123

## Security Features

- Password hashing with `password_hash()` and `password_verify()`
- Prepared statements to prevent SQL injection
- Input sanitization to prevent XSS attacks
- Session management for authenticated users

## File Structure

- `index.php` - Login page with form
- `dashboard.php` - Protected page for authenticated users
- `config.php` - Database connection and configuration
- `functions.php` - Helper functions for authentication and validation
- `logout.php` - Handles user logout
- `setup.sql` - Database schema and test data

## Test User

For testing purposes, the system includes a user:
- Email: test@example.com
- Password: password123