

let pathArray = window.location.pathname.split('/');
let currentUrlStem = pathArray[pathArray.length - 1];


function getNavbarAnchors() {
	let navbarDivColl = document.getElementsByClassName('topnav');
	let navbarDiv = navbarDivColl[0];
	let anchorColl = navbarDiv.getElementsByTagName('a');

	// ES6 spread notation may not be universally supported
	return [...anchorColl];
}


function makeCurrentLinkActive(pageName)
{
	let anchorArr = getNavbarAnchors();
	anchorArr.forEach(anchor => {
		let anchorPage = anchor.getAttribute('href').replace('/', '');
		if (anchorPage == pageName)
		{
			anchor.classList.add('active');
		}
	});
}


function setPageTitle(pageName)
{
	let anchorArr = getNavbarAnchors();
	anchorArr.forEach(anchor => {
		let anchorPage = anchor.getAttribute('href').replace('/', '');
		if (anchorPage == pageName)
		{
			let currPageLabel = anchor.innerHTML;
			document.title = "Ian's Site: " + currPageLabel;
		}
	});
}


makeCurrentLinkActive(currentUrlStem);
setPageTitle(currentUrlStem);
