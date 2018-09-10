import sys

def main():
	username = sys.argv[1]
	integer = sys.argv[2]
	factorization_filename = '/var/www/html/UserFiles/'\
				+ username + '/' + integer + '.txt'	
	
	string_of_factors = ''
	with open(factorization_filename, 'r') as f:
		line = f.readline()
		while line[0] != '\n':
			line = f.readline()
		while line[0] == '\n':
			line = f.readline()

		while line != '':
			string_of_factors += line.rstrip() + ','
			line = f.readline()

	print(string_of_factors)


main()
