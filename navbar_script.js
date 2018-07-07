
var pathArray = window.location.pathname.split('/');
var page = pathArray[pathArray.length - 1];


function makeCurrentLinkActive(pageFilename)
{
	var navbarDivColl = document.getElementsByClassName('topnav');
	var navbarDiv = navbarDivColl[0];
	var anchorColl = navbarDiv.getElementsByTagName('a');
	for (i = 0; i < anchorColl.length; i++)
	{
		var currAnchor = anchorColl[i];
		var anchorPage = currAnchor.getAttribute('href');
		if (anchorPage == pageFilename)
		{
			currAnchor.classList.add('active');
		}
	}
}


switch(page) {
	case 'index.php':
		makeCurrentLinkActive('index.php');
		break;

	case 'login.php':
		makeCurrentLinkActive('login.php');
		break;

	case 'prime_factorization.php':
		makeCurrentLinkActive('prime_factorization.php');
		break;
}
