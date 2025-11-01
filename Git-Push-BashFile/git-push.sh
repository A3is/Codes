#!/bin/bash
# File: git-push.sh
# Purpose: Commit with message "Update" and push safely (no force)
# Automatically detects the project path and keeps window open after execution

set -e  # Stop the script if any command fails

# Detect project directory (same as this script's location)
PROJECT_DIR="$( cd "$( dirname "$0" )" && pwd )"

cd "$PROJECT_DIR"
echo "📁 Working directory: $PROJECT_DIR"

# Stage all changes
git add .

# Commit with fixed message
git commit -m "Update" || echo "✅ No changes to commit"

# Sync with remote to prevent overwriting
git pull origin master --rebase

# Push to remote
git push origin master

echo "🚀 Push completed successfully!"

# Display message if any error occurs
trap 'echo "❌ An error occurred during push operation."' ERR

echo
echo "------------------------------------------"
echo "Press any key to close this window..."
echo "------------------------------------------"
read -n 1 -s -r -p ""
