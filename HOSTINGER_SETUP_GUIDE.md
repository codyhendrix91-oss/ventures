# Hostinger GitHub Deployment Setup Guide

This guide will help you set up your Hostinger server to pull changes directly from GitHub.

## One-Time Setup (Do This Once)

### Step 1: Connect to Hostinger via SSH (PuTTY)

Open PuTTY and connect to:
- **Host**: s.ventures
- **Username**: u753897407
- **Port**: 22

### Step 2: Navigate to Your Site Directory

```bash
cd /home/u753897407/domains/s.ventures/public_html
```

### Step 3: Set Up Git Repository

If this isn't already a git repository, run:

```bash
# Initialize git
git init

# Add GitHub as remote
git remote add origin https://github.com/codyhendrix91-oss/ventures.git

# Fetch all branches
git fetch origin

# Checkout the working branch
git checkout -b claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN origin/claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN
```

### Step 4: Configure Git (First Time Only)

```bash
git config --global user.email "your-email@example.com"
git config --global user.name "Your Name"
```

---

## Daily Workflow

### When I Make Changes:

1. I'll make changes to your theme files
2. I'll commit and push to GitHub
3. I'll tell you "Changes are pushed - ready to deploy!"

### When You Want to Deploy:

Just run this ONE command via SSH:

```bash
cd /home/u753897407/domains/s.ventures/public_html && git pull origin claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN
```

**Or use the deployment script for automatic backup + cache clearing:**

```bash
cd /home/u753897407/domains/s.ventures/public_html && bash deploy_from_github.sh
```

That's it! The changes will be live immediately.

---

## Quick Commands Reference

### See what's changed before deploying:
```bash
cd /home/u753897407/domains/s.ventures/public_html
git fetch origin claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN
git log HEAD..origin/claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN --oneline
```

### Deploy changes:
```bash
cd /home/u753897407/domains/s.ventures/public_html
git pull origin claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN
```

### Clear cache manually:
```bash
cd /home/u753897407/domains/s.ventures/public_html
find wp-content/cache -type f -delete 2>/dev/null
find wp-content/litespeed -type f -delete 2>/dev/null
```

### Create manual backup:
```bash
cd /home/u753897407/domains/s.ventures/public_html/wp-content/themes
mkdir -p backups
zip -r backups/backup_$(date +%Y%m%d_%H%M%S).zip s_ventures_market_theme_v4
```

---

## Troubleshooting

### "Error: Your local changes would be overwritten"

If you've made changes directly on the server:

```bash
cd /home/u753897407/domains/s.ventures/public_html
git stash
git pull origin claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN
```

### "Permission denied" or "Authentication failed"

If the repository is private, you may need to use a personal access token:

```bash
git remote set-url origin https://YOUR_GITHUB_TOKEN@github.com/codyhendrix91-oss/ventures.git
```

### Check current status:
```bash
cd /home/u753897407/domains/s.ventures/public_html
git status
git branch
```

---

## Benefits of This Workflow

✅ **Fast**: Changes deploy in seconds
✅ **Safe**: Easy to roll back if needed
✅ **Simple**: One command to deploy
✅ **Track Changes**: See exactly what changed
✅ **No Manual Uploads**: No more zipping/unzipping files

---

## Example Session

```bash
# SSH into Hostinger
ssh u753897407@s.ventures

# Navigate to site
cd /home/u753897407/domains/s.ventures/public_html

# Pull latest changes
git pull origin claude/update-theme-styling-011CUWXP2k6jLNWsr1pg6XfN

# Done! Visit your site and hard refresh
```

**That's it!** After the one-time setup, deploying is just one command.
