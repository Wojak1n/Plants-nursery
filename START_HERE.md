# 🌱 Plants Nursery - SIMPLE DEPLOYMENT GUIDE

## 🚀 What You Need to Do (5 Easy Steps)

### Step 1: Get Web Hosting
**Choose ONE of these options:**

**FREE (Good for testing):**
- Go to [InfinityFree.net](https://infinityfree.net) 
- Sign up for free account
- Create a website

**PAID (Better for real use - $3-5/month):**
- Go to [Hostinger.com](https://hostinger.com) or [Bluehost.com](https://bluehost.com)
- Buy hosting plan
- Set up your domain

### Step 2: Upload Your Files
1. **Log into your hosting control panel**
2. **Find "File Manager" or use FTP**
3. **Upload ALL these files to your website folder** (usually called `public_html`):

```
✅ Upload these files:
- index.php, plants.php, recipes.php, contact.php, plant.php, recipe.php
- .htaccess, robots.txt
- database_setup.sql, deploy.php, check_requirements.php
- Login/ folder (complete folder)
- admin/ folder (complete folder) 
- includes/ folder (complete folder)
- assets/ folder (complete folder)
- error_pages/ folder (complete folder)
- api/ folder (complete folder)
- supabase/ folder (complete folder)
```

### Step 3: Create Database
1. **In your hosting control panel, find "MySQL Databases"**
2. **Create a new database** (remember the name)
3. **Create a database user** (remember username and password)
4. **Assign the user to the database**
5. **Find "phpMyAdmin"**
6. **Select your database**
7. **Click "Import" and upload `database_setup.sql`**

### Step 4: Configure Your Website
1. **Visit: `http://yourwebsite.com/check_requirements.php`**
   - This checks if your server is ready
2. **Visit: `http://yourwebsite.com/deploy.php`**
   - Enter your database details from Step 3
   - Click "Setup Configuration"
3. **If successful, delete these files for security:**
   - `deploy.php`
   - `check_requirements.php`

### Step 5: Test Your Website
**Visit your website and test:**
- Homepage works
- Plants page works
- Recipes page works
- User login: `test@example.com` / `password123`
- Admin login: `admin` / `admin`

## 🎉 YOU'RE DONE!

Your website is now live and everyone can see it!

## ⚠️ IMPORTANT - Change Passwords!
After deployment, immediately:
1. Go to `/admin/` and change admin password
2. Create new user accounts and delete the test account

## 🆘 Need Help?

**If something doesn't work:**
1. Check your hosting provider's help section
2. Contact their support (most have live chat)
3. Make sure you followed each step exactly

**Common problems:**
- **Database error**: Double-check your database name, username, and password
- **Files not found**: Make sure you uploaded ALL files to the right folder
- **Permission errors**: Contact your hosting support

## 📞 Your Website Will Be At:
`http://yourdomain.com` or `http://yoursubdomain.hostingprovider.com`

**That's it! Your Plants Nursery website is now online! 🌿**
