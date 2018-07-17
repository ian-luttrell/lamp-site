#!/usr/bin/python3

from math import floor, sqrt
import sys


def BinaryTree(r):
    return [r, [], []]

def insertLeft(root,newBranch):
    t = root.pop(1)
    if len(t) > 1:
        root.insert(1,[newBranch,t,[]])
    else:
        root.insert(1,[newBranch, [], []])
    return root

def insertRight(root,newBranch):
    t = root.pop(2)
    if len(t) > 1:
        root.insert(2,[newBranch,[],t])
    else:
        root.insert(2,[newBranch,[],[]])
    return root

def getLeftChild(root):
    return root[1]

def getRightChild(root):
    return root[2]

def print_leaves(root):
	if root[1] == [] and root[2] == []:
		print('    ' + str(root[0]))
	else:
		print_leaves(root[1])
		print_leaves(root[2])



def is_prime(num):
    print('    checking whether prime: ' + str(num))
    if num % 2 == 0:
        candidate_divisor = 2
    else:
        candidate_divisor = 3
    is_prime = True
    while candidate_divisor <= floor(sqrt(num)):
        if num % candidate_divisor == 0:
            is_prime = False
            break
        if num % 2 == 0:
            candidate_divisor += 1
        else:
            candidate_divisor += 2
    return is_prime


def get_smallest_divisor(num):
    candidate_divisor = 2
    while candidate_divisor <= num:
        if num % candidate_divisor == 0:
            smallest_divisor = candidate_divisor
            return smallest_divisor
        candidate_divisor += 1
    

def get_prime_factors(num, root, list_of_factors):
    if is_prime(num):
        list_of_factors.append(num)
    else:
        divisor = get_smallest_divisor(num)
        quotient = num//divisor
        insertLeft(root, divisor)
        insertRight(root, quotient)
        print(str(root[0]))
        print_leaves(root)

        left_root = getLeftChild(root)
        right_root = getRightChild(root)      
        get_prime_factors(divisor, left_root, list_of_factors)
        get_prime_factors(quotient, right_root, list_of_factors)






def main():
	user_name = sys.argv[1]
	integer_to_factor = sys.argv[2]
	output_file = '/var/www/html/UserFiles/' + user_name + '/' +\
					integer_to_factor + '.txt'
	sys.stdout = open(output_file, 'a')

	num = int(integer_to_factor)
	my_tree = BinaryTree(num)
	list_of_fac = []
	get_prime_factors(num, my_tree, list_of_fac)	

	print('\n')
	print_leaves(my_tree)


main()
