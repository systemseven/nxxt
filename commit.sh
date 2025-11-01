#!/usr/bin/env bash

# Exit immediately if any command fails
set -e

# Check for commit message
if [ -z "$1" ]; then
  echo "Please provide a commit message."
  echo "Usage: ./commit.sh \"Your commit message\""
  exit 1
fi

MESSAGE="$1"

echo "Running Pint..."
./vendor/bin/pint

echo "Adding files..."
git add .

echo "Committing..."
git commit -m "$MESSAGE"

