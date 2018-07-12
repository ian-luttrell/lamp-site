#!/bin/bash

# *** must be run with sudo ***

# "ian" needs to be replaced with whichever non-root user is
#     executing the test runner and python test scripts
if [[ $EUID -ne 0 ]]
then
	echo "start_devel_tests.sh: must be run with sudo/root privileges"
	exit
fi


# change project owner and group to www-data so that Apache can serve
#     the site
chown -R www-data:www-data /var/www/html


# copy test runner script, and each python test script, 
#     to the user's home directory
cp /var/www/html/selenium/devel_tests.sh ~
chown ian:ian ~/devel_tests.sh
cp /var/www/html/selenium/e2e*.py ~
chown ian:ian ~/e2e*.py


# start test runner
# NOTE: geckodriver executable must be in root's PATH
cd ~
su -c ./devel_tests.sh -m ian


# clean up user's home directory
rm ~/devel_tests.sh
rm ~/e2e*.py
rm ~/geckodriver.log
