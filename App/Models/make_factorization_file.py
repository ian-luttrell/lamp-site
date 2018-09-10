
import os, sys


def main():
	user_name = sys.argv[1]
	integer_to_factor = sys.argv[2]
	file_name = integer_to_factor + '.txt'

	user_folder = '/var/www/html/UserFiles/' + user_name
	if not os.path.exists(user_folder):
		os.makedirs(user_folder)

	f = open(user_folder + '/' + file_name, 'w')
	f.close()

main()
