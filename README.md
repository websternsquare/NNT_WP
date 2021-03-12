# Wordpress Homestead

## Requirements (Wordpress)
* PHP >= 7.2
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## Installation (Developer)
1. Copy Homestead.yaml.example to Homestead.yaml
    * Change \<folders:map\> to your local directory
    * Add \<ip\> \<sites:map\> (in homestead.yaml) to Hosts file
        * ex) `192.168.10.13 wordpress.test`
1. Setup [WP Config](https://codex.wordpress.org/Editing_wp-config.php)
1. Run `vagrant up` command
    * Note: If server hangs on startup running `vagrant global-status --prune` has been shown to help
1. Run `vagrant ssh` to work on server like a standard linux environment

## Deployment
1. Put the code files on the server
  1. Copy files
    1. Copy the entire directory to the server. Include the .git folder
  1. Use Git
    1. SSH to server and clone the repository
    1. Run `composer install` 
    1. Don't forget to copy the uploads folder to server
1. Upload database
  1. Make sure search and replace is run on database `wp search-replace //<old-url> //<new-url>
1. Setup [WP Config](https://codex.wordpress.org/Editing_wp-config.php)
1. Make sure server settings are right
  1. Preferably server is running php 7.2
  1. Sites should be using SSL

<strong>Note: You can match your local php version to what other servers are running</strong>
 1. Check php version on other server
 1. Run following command based on php version `php65`, `php70`, `php71`, `php72`

