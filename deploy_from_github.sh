#!/bin/bash

# Hostinger Deployment Script - Pull from GitHub
# This script pulls the latest changes from GitHub and deploys them

echo "=========================================="
echo "S.Ventures - Deploy from GitHub"
echo "=========================================="
echo ""

# Configuration
SITE_PATH="/home/u753897407/domains/s.ventures/public_html"
GITHUB_REPO="https://github.com/codyhendrix91-oss/ventures.git"
BRANCH="claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN"

# Navigate to site directory
echo "📁 Navigating to site directory..."
cd "$SITE_PATH" || exit 1

# Check if this is a git repository
if [ ! -d ".git" ]; then
    echo "⚠️  Not a git repository. Initializing..."
    echo ""
    echo "Run these commands to set up git:"
    echo "  git init"
    echo "  git remote add origin $GITHUB_REPO"
    echo "  git fetch origin"
    echo "  git checkout -b $BRANCH origin/$BRANCH"
    exit 1
fi

# Create backup of current theme
echo "💾 Creating backup..."
BACKUP_DIR="wp-content/themes/backups"
mkdir -p "$BACKUP_DIR"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
cd wp-content/themes
zip -rq "backups/s_ventures_market_theme_v4_backup_$TIMESTAMP.zip" s_ventures_market_theme_v4
cd "$SITE_PATH"
echo "✓ Backup created: backups/s_ventures_market_theme_v4_backup_$TIMESTAMP.zip"

# Fetch latest changes
echo ""
echo "🔄 Fetching latest changes from GitHub..."
git fetch origin "$BRANCH"

# Show what will change
echo ""
echo "📋 Changes to be applied:"
git log HEAD..origin/"$BRANCH" --oneline --pretty=format:"%h - %s" | head -5

# Pull the changes
echo ""
echo "⬇️  Pulling latest changes..."
git pull origin "$BRANCH"

if [ $? -ne 0 ]; then
    echo "❌ Error pulling changes!"
    echo "You may need to resolve conflicts or check your git configuration."
    exit 1
fi

# Set proper permissions
echo ""
echo "🔒 Setting proper permissions..."
find wp-content/themes/s_ventures_market_theme_v4 -type f -exec chmod 644 {} \; 2>/dev/null
find wp-content/themes/s_ventures_market_theme_v4 -type d -exec chmod 755 {} \; 2>/dev/null

# Clear WordPress cache
echo ""
echo "🧹 Clearing caches..."
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/litespeed -type f -delete 2>/dev/null
find wp-content/w3tc-cache -type f -delete 2>/dev/null
find wp-content/uploads/cache -type f -delete 2>/dev/null

echo ""
echo "=========================================="
echo "✅ Deployment Complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Visit https://s.ventures"
echo "2. Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)"
echo "3. If you have LiteSpeed Cache, go to:"
echo "   WordPress Admin > LiteSpeed Cache > Toolbox > Purge All"
echo ""
echo "Last deployed: $(date)"
echo ""
