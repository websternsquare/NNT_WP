#!/bin/bash
#
export DIST_DIRECTORY_NAME="dist"

# Get to proper working directory (root of project)
cd "${0%/*}"
cd ../

echo "Make sure all dependencies are installed before starting."
composer install

echo "Create dist folder"
rm -rf "$DIST_DIRECTORY_NAME"
mkdir -p -- "$DIST_DIRECTORY_NAME"

echo "Copy from /web/wp to dist"
cp -a web/wp/. "$DIST_DIRECTORY_NAME"

echo "Delete dist/wp-content directory and creat new one"
rm -rf "$DIST_DIRECTORY_NAME/wp-content"

echo "Copy from /web/app to dist/wp-content (override)"
cp -a web/app/. "$DIST_DIRECTORY_NAME/wp-content"


echo "if there are plugins which has composer.json then run Composer Install"
cd "$DIST_DIRECTORY_NAME/wp-content/"

if [ -d "plugins" ]; then
  cd plugins

  for plugin_dir in */
  do
    cd $plugin_dir

    if [ -e "composer.json" ]; then
      composer install --quiet
    fi

    cd ..
  done
    
  cd ..
fi

if [ -d "mu-plugins" ]; then
  cd mu-plugins

  for plugin_dir in */
  do
    cd $plugin_dir

    if [ -e "composer.json" ]; then
      composer install --quiet
    fi

    cd ..
  done
    
  cd ..
fi

# Get to proper working directory
cd "${0%/*}"
cd ../../

echo "Export the current db to dist folder"
wp db export dist/database.sql

#bash "wp db export dist/database.sql"

echo "Zip the dist folder"
zip -r dist.zip dist/*
