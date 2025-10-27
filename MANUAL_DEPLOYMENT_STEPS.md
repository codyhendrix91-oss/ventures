# Manual Deployment Steps for Hostinger via SSH

## Quick Method (Recommended)

### Step 1: Upload the files
Upload these files to your Hostinger server at `/home/u753897407/domains/s.ventures/public_html/`:
- `s_ventures_theme_v4_update.zip`
- `deploy_hostinger_fixed.sh`

### Step 2: Run the deployment script
```bash
cd /home/u753897407/domains/s.ventures/public_html
chmod +x deploy_hostinger_fixed.sh
./deploy_hostinger_fixed.sh
```

The script will automatically:
- Create a backup of your current theme
- Extract the zip file properly (handling nested folders)
- Deploy the files to the correct location
- Set proper permissions
- Clear all caches

---

## Manual Method (If Script Fails)

### Step 1: Upload the zip file
Upload `s_ventures_theme_v4_update.zip` to `/home/u753897407/domains/s.ventures/public_html/`

### Step 2: Connect via SSH and run these commands

```bash
# Navigate to WordPress root
cd /home/u753897407/domains/s.ventures/public_html

# Create backup
cd wp-content/themes
mkdir -p backups
zip -rq backups/s_ventures_market_theme_v4_backup_$(date +%Y%m%d_%H%M%S).zip s_ventures_market_theme_v4
cd ../..

# Extract to temporary location
mkdir -p /tmp/theme_extract
unzip -q s_ventures_theme_v4_update.zip -d /tmp/theme_extract

# Remove old theme
rm -rf wp-content/themes/s_ventures_market_theme_v4

# Copy new theme (handling the nested wp-content/themes path in the zip)
cp -r /tmp/theme_extract/wp-content/themes/s_ventures_market_theme_v4 wp-content/themes/

# Clean up temp files
rm -rf /tmp/theme_extract

# Set permissions
find wp-content/themes/s_ventures_market_theme_v4 -type f -exec chmod 644 {} \;
find wp-content/themes/s_ventures_market_theme_v4 -type d -exec chmod 755 {} \;

# Clear cache
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/litespeed -type f -delete 2>/dev/null
```

### Step 3: Verify deployment
1. Visit https://s.ventures
2. Do a hard refresh (Ctrl+Shift+R)
3. Check the site styling

---

## Uploading Files to Hostinger

### Option 1: Using SCP (from your local machine)
```bash
scp s_ventures_theme_v4_update.zip u753897407@s.ventures:/home/u753897407/domains/s.ventures/public_html/
scp deploy_hostinger_fixed.sh u753897407@s.ventures:/home/u753897407/domains/s.ventures/public_html/
```

### Option 2: Using Hostinger File Manager
1. Log into Hostinger panel
2. Go to File Manager
3. Navigate to `/domains/s.ventures/public_html/`
4. Click Upload
5. Upload the zip file

### Option 3: Using SFTP client (FileZilla, WinSCP)
- Host: s.ventures (or your Hostinger IP)
- Username: u753897407
- Protocol: SFTP
- Upload to: `/home/u753897407/domains/s.ventures/public_html/`

---

## Troubleshooting

### If you see nested folders after extraction:
The deployment script handles this automatically. If doing manual extraction, use:
```bash
unzip s_ventures_theme_v4_update.zip -d /tmp/theme_extract
cp -r /tmp/theme_extract/wp-content/themes/s_ventures_market_theme_v4 wp-content/themes/
```

### If permissions are wrong:
```bash
cd /home/u753897407/domains/s.ventures/public_html
find wp-content/themes/s_ventures_market_theme_v4 -type f -exec chmod 644 {} \;
find wp-content/themes/s_ventures_market_theme_v4 -type d -exec chmod 755 {} \;
```

### If cache isn't clearing:
```bash
# Clear all possible cache locations
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/w3tc-cache -type f -delete 2>/dev/null
find wp-content/uploads/cache -type f -delete 2>/dev/null
find wp-content/litespeed -type f -delete 2>/dev/null

# Also clear from WordPress admin panel:
# LiteSpeed Cache > Toolbox > Purge All
```
