
var pathArray = window.location.pathname.split('/');
var currentPageFilename = pathArray[pathArray.length - 1];


function makeCurrentLinkActive(pageFilename)
{
	var navbarDivColl = document.getElementsByClassName('topnav');
	var navbarDiv = navbarDivColl[0];
	var anchorColl = navbarDiv.getElementsByTagName('a');
	// ES6 spread notation may not be universally supported
	var anchorArr = [...anchorColl];
	anchorArr.forEach(anchor => {
		var anchorPage = anchor.getAttribute('href');
		if (anchorPage == pageFilename)
		{
			anchor.classList.add('active');
		}
	});
}

function setPageTitle(pageFilename)
{
	var navbarDivColl = document.getElementsByClassName('topnav');
	var navbarDiv = navbarDivColl[0];
	var anchorColl = navbarDiv.getElementsByTagName('a');
	// ES6 spread notation may not be universally supported
	var anchorArr = [...anchorColl];
	anchorArr.forEach(anchor => {
		var anchorPage = anchor.getAttribute('href');
		if (anchorPage == pageFilename)
		{
			var currPageLabel = anchor.innerHTML;
			document.title = "Ian's Site: " + currPageLabel;
		}
	});
}

makeCurrentLinkActive(currentPageFilename);
setPageTitle(currentPageFilename);
