# Plants Nursery - Deployment Guide

## Overview
This guide will help you deploy your Plants Nursery website so everyone can access it online.

## Prerequisites
- Your website files (PHP, HTML, CSS, JS)
- Database schema (`database_setup.sql`)
- FTP client or hosting control panel access

## Deployment Options

### Option 1: Free Hosting (Recommended for Testing)

#### InfinityFree (Recommended)
1. **Sign up**: Go to [infinityfree.net](https://infinityfree.net)
2. **Create account**: Register with your email
3. **Create hosting account**: Choose a subdomain or use your own domain
4. **Access control panel**: Use the provided control panel

#### 000webhost Alternative
1. **Sign up**: Go to [000webhost.com](https://000webhost.com)
2. **Create free account**
3. **Set up website**

### Option 2: Paid Shared Hosting (Recommended for Production)

#### Popular Options:
- **Hostinger** (~$2-4/month) - Good performance, easy setup
- **Bluehost** (~$3-7/month) - WordPress optimized, reliable
- **SiteGround** (~$4-8/month) - Excellent support, fast

## Step-by-Step Deployment Process

### Step 1: Prepare Your Files
1. **Update configuration**:
   - Copy `config_production.php` to `Login/config.php`
   - Copy `config_production.php` to `includes/db.php` (update the function)
   - Update database credentials with your hosting provider's details

2. **File structure to upload**:
   ```
   /public_html (or root directory)
   ├── index.php
   ├── plants.php
   ├── recipes.php
   ├── contact.php
   ├── plant.php
   ├── recipe.php
   ├── Login/
   ├── admin/
   ├── includes/
   ├── assets/
   └── api/
   ```

### Step 2: Upload Files
1. **Using FTP**:
   - Download FileZilla or use hosting control panel file manager
   - Connect using FTP credentials from your hosting provider
   - Upload all files to `public_html` or root directory

2. **Using Control Panel**:
   - Most hosting providers have a file manager in their control panel
   - Upload files directly through the web interface

### Step 3: Set Up Database
1. **Create Database**:
   - Go to your hosting control panel
   - Find "MySQL Databases" or "Database" section
   - Create a new database (note the name)
   - Create a database user and password
   - Assign user to database with all privileges

2. **Import Database Schema**:
   - Find "phpMyAdmin" in your control panel
   - Select your database
   - Go to "Import" tab
   - Upload `database_setup.sql`
   - Click "Go" to execute

### Step 4: Update Configuration Files
1. **Update database credentials** in:
   - `Login/config.php`
   - `includes/db.php`

2. **Example configuration**:
   ```php
   $host = 'localhost'; // or your hosting provider's DB host
   $dbname = 'your_actual_database_name';
   $username = 'your_db_username';
   $password = 'your_db_password';
   ```

### Step 5: Set File Permissions
1. **Set proper permissions**:
   - Folders: 755
   - PHP files: 644
   - `assets/images/` folder: 755 (for uploads)

### Step 6: Test Your Website
1. **Visit your website URL**
2. **Test functionality**:
   - Browse plants and recipes
   - Test search functionality
   - Try user registration/login (`/Login/`)
   - Test admin panel (`/admin/`)

## Default Login Credentials

### User Login (`/Login/`)
- Email: `test@example.com`
- Password: `password123`

### Admin Login (`/admin/`)
- Username: `admin`
- Password: `admin`

**⚠️ Important**: Change these default passwords after deployment!

## Troubleshooting

### Common Issues:
1. **Database connection errors**:
   - Check database credentials
   - Verify database name and user permissions

2. **File upload issues**:
   - Check folder permissions for `assets/images/`
   - Ensure folder exists and is writable

3. **PHP errors**:
   - Check PHP version compatibility (PHP 7.4+ recommended)
   - Enable error logging in production

### Getting Help:
- Check your hosting provider's documentation
- Contact hosting support for database/server issues
- Check error logs in your hosting control panel

## Security Recommendations

1. **Change default passwords** immediately after deployment
2. **Use HTTPS** if available (most hosting providers offer free SSL)
3. **Regular backups** of your database and files
4. **Keep PHP and database updated**
5. **Monitor error logs** regularly

## Next Steps After Deployment

1. **Test all functionality** thoroughly
2. **Set up regular backups**
3. **Configure email settings** if needed
4. **Add your own content** (plants, recipes, images)
5. **Customize design** to match your brand
6. **Set up analytics** (Google Analytics)

## Support

If you need help with deployment, most hosting providers offer:
- Live chat support
- Email support
- Knowledge base/tutorials
- Video guides

Choose a hosting provider with good support if you're new to web hosting!
