#!/bin/bash

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

echo "Switching to Code/ Directory"
cd Code/

echo "Running: cmd: Install Composer"
composer install --quiet

exit 0
