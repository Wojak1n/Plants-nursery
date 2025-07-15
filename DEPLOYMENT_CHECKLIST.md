# 🚀 Plants Nursery - Deployment Checklist

## ✅ Pre-Deployment Checklist

### Files to Upload:
- [ ] All PHP files (index.php, plants.php, recipes.php, etc.)
- [ ] Login/ folder (complete login system)
- [ ] admin/ folder (admin panel)
- [ ] includes/ folder (core functions)
- [ ] assets/ folder (CSS, images, JS)
- [ ] error_pages/ folder (404, 500 error pages)
- [ ] .htaccess (security and configuration)
- [ ] robots.txt (SEO)
- [ ] database_setup.sql (database schema)
- [ ] deploy.php (setup script)
- [ ] check_requirements.php (server check)

### Files NOT to Upload (for security):
- [ ] README.md files
- [ ] DEPLOYMENT_GUIDE.md
- [ ] DEPLOYMENT_CHECKLIST.md
- [ ] Any .git folders
- [ ] config_production.php (template only)

## 🌐 Hosting Setup Steps

### Step 1: Choose Hosting
- [ ] **Free Option**: InfinityFree or 000webhost
- [ ] **Paid Option**: Hostinger, Bluehost, or SiteGround

### Step 2: Upload Files
- [ ] Access hosting control panel
- [ ] Use File Manager or FTP client
- [ ] Upload all files to public_html or root directory
- [ ] Set folder permissions: 755 for folders, 644 for files
- [ ] Set assets/images/ to 755 (writable)

### Step 3: Database Setup
- [ ] Create MySQL database in hosting control panel
- [ ] Create database user and password
- [ ] Assign user to database with all privileges
- [ ] Import database_setup.sql via phpMyAdmin

### Step 4: Configuration
- [ ] Visit yoursite.com/check_requirements.php
- [ ] Verify all requirements are met
- [ ] Visit yoursite.com/deploy.php
- [ ] Enter database credentials
- [ ] Test database connection
- [ ] Configuration files updated automatically

### Step 5: Testing
- [ ] Visit your website homepage
- [ ] Test plant browsing (/plants.php)
- [ ] Test recipe browsing (/recipes.php)
- [ ] Test search functionality
- [ ] Test user login (/Login/)
- [ ] Test admin login (/admin/)
- [ ] Test image uploads in admin panel

### Step 6: Security
- [ ] Change default admin password (admin/admin)
- [ ] Change default user password (test@example.com/password123)
- [ ] Delete deploy.php file
- [ ] Delete check_requirements.php file
- [ ] Verify .htaccess is working (protects sensitive files)

## 🔐 Default Login Credentials

### User Login (/Login/)
- **Email**: test@example.com
- **Password**: password123

### Admin Login (/admin/)
- **Username**: admin
- **Password**: admin

**⚠️ IMPORTANT**: Change these immediately after deployment!

## 🛠️ Troubleshooting

### Common Issues:
1. **Database connection error**
   - Check database credentials in deploy.php
   - Verify database exists and user has permissions

2. **Images not uploading**
   - Check assets/images/ folder permissions (755)
   - Verify folder exists and is writable

3. **404 errors**
   - Check .htaccess file is uploaded
   - Verify file paths are correct

4. **PHP errors**
   - Check PHP version (7.4+ required)
   - Verify required extensions are installed

### Getting Help:
- Check hosting provider documentation
- Contact hosting support
- Check error logs in hosting control panel

## 📱 Post-Deployment Tasks

### Immediate:
- [ ] Change all default passwords
- [ ] Add your own plants and recipes
- [ ] Upload your own images
- [ ] Test all functionality thoroughly

### Optional:
- [ ] Set up SSL certificate (HTTPS)
- [ ] Configure email settings
- [ ] Set up Google Analytics
- [ ] Create custom favicon
- [ ] Add more plants and recipes
- [ ] Customize colors and branding

## 🎉 You're Done!

Once all items are checked, your Plants Nursery website should be live and accessible to everyone!

**Your website will be available at**: `http://yourdomain.com` or `http://yoursubdomain.hosting-provider.com`
