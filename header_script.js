
var pathArray = window.location.pathname.split('/');
var currentPageFilename = pathArray[pathArray.length - 1];


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

function setPageTitle(pageFilename)
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
			var currPageLabel = currAnchor.innerHTML;
			document.title = "Ian's Site: " + currPageLabel;
		}
	}
}

makeCurrentLinkActive(currentPageFilename);
setPageTitle(currentPageFilename);
