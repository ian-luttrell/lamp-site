

var pathArray = window.location.pathname.split('/');
var currentUrlStem = pathArray[pathArray.length - 1];


function makeCurrentLinkActive(pageName)
{
	var navbarDivColl = document.getElementsByClassName('topnav');
	var navbarDiv = navbarDivColl[0];
	var anchorColl = navbarDiv.getElementsByTagName('a');
	// ES6 spread notation may not be universally supported
	var anchorArr = [...anchorColl];
	anchorArr.forEach(anchor => {
		var anchorPage = anchor.getAttribute('href').replace('/', '');
		if (anchorPage == pageName)
		{
			anchor.classList.add('active');
		}
	});
}

function setPageTitle(pageName)
{
	var navbarDivColl = document.getElementsByClassName('topnav');
	var navbarDiv = navbarDivColl[0];
	var anchorColl = navbarDiv.getElementsByTagName('a');
	// ES6 spread notation may not be universally supported
	var anchorArr = [...anchorColl];
	anchorArr.forEach(anchor => {
		var anchorPage = anchor.getAttribute('href').replace('/', '');
		if (anchorPage == pageName)
		{
			var currPageLabel = anchor.innerHTML;
			document.title = "Ian's Site: " + currPageLabel;
		}
	});
}

makeCurrentLinkActive(currentUrlStem);
setPageTitle(currentUrlStem);
