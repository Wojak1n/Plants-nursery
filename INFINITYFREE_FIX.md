# 🔧 InfinityFree Database Connection Fix

## The Problem
You're getting: `SQLSTATE[HY000] [2002] No such file or directory`

This happens because **InfinityFree uses different database settings** than standard hosting.

## 🚀 Quick Fix Steps:

### Step 1: Find Your REAL Database Details
1. **Log into your InfinityFree control panel**
2. **Go to "MySQL Databases"**
3. **Look for these details** (they will be different from localhost):

```
Database Host: sql200.infinityfree.com (or similar)
Database Name: if0_12345678_plants_nursery (or similar)
Database User: if0_12345678 (or similar)
Database Password: [your password]
```

### Step 2: Use the Correct Database Host
**❌ Don't use**: `localhost`
**✅ Use**: `sql200.infinityfree.com` (or whatever your control panel shows)

### Step 3: Re-run deploy.php
1. **Visit**: `yoursite.com/deploy.php`
2. **Enter the CORRECT details from Step 1**:
   - **Host**: `sql200.infinityfree.com` (not localhost!)
   - **Database Name**: Your full database name (like `if0_12345678_plants_nursery`)
   - **Username**: Your full username (like `if0_12345678`)
   - **Password**: Your database password

### Step 4: Test
After successful setup, test your website!

## 📋 InfinityFree Database Setup (If you haven't done this):

### Create Database:
1. **InfinityFree Control Panel** → **MySQL Databases**
2. **Create Database** → Name it `plants_nursery` (or whatever you want)
3. **Note the FULL database name** (will be like `if0_12345678_plants_nursery`)
4. **Create Database User** (will be like `if0_12345678`)
5. **Set password** and remember it
6. **Assign user to database**

### Import Database:
1. **Go to phpMyAdmin** (in your control panel)
2. **Select your database**
3. **Click "Import"**
4. **Upload `database_setup.sql`**
5. **Click "Go"**

## 🆘 Still Not Working?

### Try These Database Hosts:
- `sql200.infinityfree.com`
- `sql201.infinityfree.com`
- `sql202.infinityfree.com`
- Check your InfinityFree control panel for the exact host

### Common InfinityFree Issues:
1. **Wrong host**: Must use `sql200.infinityfree.com` (not localhost)
2. **Wrong database name**: Must use full name like `if0_12345678_plants_nursery`
3. **Wrong username**: Must use full username like `if0_12345678`
4. **Database not created**: Create it first in control panel
5. **User not assigned**: Assign user to database with all privileges

## ✅ After It Works:
1. **Delete `deploy.php`** for security
2. **Test your website**
3. **Change default passwords**

## 📞 Need More Help?
- Check InfinityFree documentation
- Contact InfinityFree support
- Try a different free host like 000webhost

**The key is using the CORRECT database host from your InfinityFree control panel!**
