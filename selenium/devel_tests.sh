#!/bin/bash

# note: using mysql commands (without username and password)
#   requires the username and password to be supplied in
#   the file .my.cnf in user's home directory (~). The permissions
#   for .my.cnf should be 600 (only the owner can read or write)


# run account creation and login tests
python3 e2e-create-account-log-in.py
# get python return code
rv=$?
if [[ $rv -ne 0 ]]
then
	echo "Failed account creation and login test: exiting"
	# clean up database
	mysql -e "DELETE FROM test.users WHERE username = 'selenium';"
	exit
fi


# run test to check logged-in vs. logged-out behavior of 
#   prime factorization page
python3 e2e-check-prime-fact-login.py
rv=$?
if [[ $rv -ne 0 ]]
then
	echo "Failed prime factorization logged-in vs. logged-out test: exiting"
	mysql -e "DELETE FROM test.users WHERE username = 'selenium';"
	exit
fi


# run test to check for username code injection vulnerability
python3 e2e-check-username-code-injection.py
rv=$?
if [[ $rv -ne 0 ]]
then
	echo "Failed username code injection test: exiting"
	echo "*** There might be security vulnerabilities ***"

	# clean up database
	mysql -e "DELETE FROM test.users WHERE username = 'selenium';"
	exit
fi


# run test to make sure we can delete our test account
python3 e2e-delete-account.py
rv=$?
if [[ $rv -ne 0 ]]
then
	echo "Failed account deletion test: exiting"

	# clean up database
	mysql -e "DELETE FROM test.users WHERE username = 'selenium';"
	exit
fi


# clean up database
#   (nothing needed here currently, since the last test above already deleted
#    the test account)


# inform tester of success
echo "All tests passed!"
