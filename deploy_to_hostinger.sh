#!/bin/bash
# 
# S.Ventures Theme Deployment Script for Hostinger
# Run this script from your Hostinger SSH session
#

echo "=========================================="
echo "S.Ventures Theme Deployment"
echo "=========================================="
echo ""

# Configuration
WP_ROOT="/home/u753897407/domains/s.ventures/public_html"
THEME_NAME="s_ventures_market_theme_v4"
BACKUP_DATE=$(date +%Y%m%d_%H%M%S)

# Check if we're in the right place
if [ ! -f "$WP_ROOT/wp-config.php" ]; then
    echo "ERROR: WordPress not found at $WP_ROOT"
    echo "Please update WP_ROOT variable in this script"
    exit 1
fi

cd "$WP_ROOT"
echo "✓ Found WordPress installation"
echo ""

# Create backup
echo "Creating backup..."
if [ -d "wp-content/themes/$THEME_NAME" ]; then
    BACKUP_FILE="wp-content/themes/${THEME_NAME}_backup_${BACKUP_DATE}.zip"
    cd wp-content/themes
    zip -rq "$BACKUP_FILE" "$THEME_NAME"
    cd "$WP_ROOT"
    echo "✓ Backup created: $BACKUP_FILE"
else
    echo "! Theme directory not found - will create new"
fi
echo ""

# Extract from git repo or uploaded zip
if [ -f "/home/user/ventures/s_ventures_theme_v4_update.zip" ]; then
    echo "Found update zip file, extracting..."
    cd wp-content/themes
    unzip -oq /home/user/ventures/s_ventures_theme_v4_update.zip
    cd "$WP_ROOT"
    echo "✓ Theme files updated"
elif [ -d "/home/user/ventures/wp-content/themes/$THEME_NAME" ]; then
    echo "Copying from git repository..."
    rsync -av --delete \
        /home/user/ventures/wp-content/themes/$THEME_NAME/ \
        wp-content/themes/$THEME_NAME/ \
        --exclude='*.bak' \
        --exclude='.git*'
    echo "✓ Theme files copied from git repo"
else
    echo "ERROR: Could not find update source"
    exit 1
fi

echo ""

# Clear cache
echo "Clearing WordPress cache..."
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/w3tc-cache -type f -delete 2>/dev/null
find wp-content/uploads/cache -type f -delete 2>/dev/null
echo "✓ Cache cleared"

echo ""
echo "=========================================="
echo "Deployment Complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Visit https://s.ventures and do a hard refresh (Ctrl+Shift+R)"
echo "2. Check footer has: Domains, Resources, Company"
echo "3. Check header has Builder.io styling"
echo "4. Clear CDN cache if you use Cloudflare/similar"
echo ""
