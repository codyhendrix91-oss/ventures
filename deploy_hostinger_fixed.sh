#!/bin/bash
#
# S.Ventures Theme Deployment Script (Fixed Version)
# Run this script from your Hostinger SSH session
#
# This script properly handles the nested zip structure
#

echo "=========================================="
echo "S.Ventures Theme Deployment"
echo "=========================================="
echo ""

# Configuration
WP_ROOT="/home/u753897407/domains/s.ventures/public_html"
THEME_NAME="s_ventures_market_theme_v4"
BACKUP_DATE=$(date +%Y%m%d_%H%M%S)
ZIP_FILE="s_ventures_theme_v4_update.zip"

# Check if we're in the right place
if [ ! -f "$WP_ROOT/wp-config.php" ]; then
    echo "ERROR: WordPress not found at $WP_ROOT"
    echo "Please update WP_ROOT variable in this script"
    exit 1
fi

cd "$WP_ROOT"
echo "✓ Found WordPress installation"
echo ""

# Check for zip file
if [ ! -f "$ZIP_FILE" ]; then
    echo "ERROR: $ZIP_FILE not found in $WP_ROOT"
    echo "Please upload the zip file first"
    exit 1
fi

# Create backup
echo "Creating backup..."
if [ -d "wp-content/themes/$THEME_NAME" ]; then
    BACKUP_DIR="wp-content/themes/backups"
    mkdir -p "$BACKUP_DIR"
    BACKUP_FILE="${BACKUP_DIR}/${THEME_NAME}_backup_${BACKUP_DATE}.zip"
    cd wp-content/themes
    zip -rq "../../$BACKUP_FILE" "$THEME_NAME"
    cd "$WP_ROOT"
    echo "✓ Backup created: $BACKUP_FILE"
else
    echo "! Theme directory not found - will create new"
fi
echo ""

# Extract theme files with proper path handling
echo "Extracting theme files..."

# Create a temporary directory for extraction
TEMP_DIR="/tmp/theme_extract_$$"
mkdir -p "$TEMP_DIR"

# Extract to temp directory
unzip -q "$ZIP_FILE" -d "$TEMP_DIR"

# Find where the actual theme files are
THEME_SOURCE=$(find "$TEMP_DIR" -type d -name "$THEME_NAME" | head -1)

if [ -z "$THEME_SOURCE" ]; then
    echo "ERROR: Could not find theme directory in zip file"
    rm -rf "$TEMP_DIR"
    exit 1
fi

# Remove old theme directory
if [ -d "wp-content/themes/$THEME_NAME" ]; then
    rm -rf "wp-content/themes/$THEME_NAME"
fi

# Copy the theme to the correct location
cp -r "$THEME_SOURCE" "wp-content/themes/"

# Clean up temp directory
rm -rf "$TEMP_DIR"

echo "✓ Theme files extracted and deployed"
echo ""

# Set proper permissions
echo "Setting file permissions..."
find wp-content/themes/$THEME_NAME -type f -exec chmod 644 {} \;
find wp-content/themes/$THEME_NAME -type d -exec chmod 755 {} \;
echo "✓ Permissions set"
echo ""

# Clear cache
echo "Clearing WordPress cache..."
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/w3tc-cache -type f -delete 2>/dev/null
find wp-content/uploads/cache -type f -delete 2>/dev/null
find wp-content/litespeed -type f -delete 2>/dev/null
echo "✓ Cache cleared"

echo ""
echo "=========================================="
echo "Deployment Complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Visit https://s.ventures and do a hard refresh (Ctrl+Shift+R)"
echo "2. Check footer styling and navigation"
echo "3. Check header styling"
echo "4. Clear CDN cache if using Cloudflare"
echo ""
echo "Backup saved to: $BACKUP_FILE"
echo ""
