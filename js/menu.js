var menuButton = document.getElementById("menu_button");
var modal = document.createElement("div");

modal.style.height = "100vh";
modal.style.width = "100%";
modal.style.position = "fixed";
modal.style.top = 0;
modal.style.left = 0;
modal.style.opacity = "0.2";
modal.style.transition = "1s";
modal.style.backgroundColor = "transparent";
modal.style.zIndex = 9;

if(menuButton)
{
	menuButton.menu = document.getElementById("menu");
	menuButton.icon1 = document.getElementById("icon_1");
	menuButton.icon2 = document.getElementById("icon_2");
	menuButton.opened = false;
	menuButton.addEventListener("click", slide);

	window.menuButton = menuButton;
	window.menu = menuButton.menu;
	window.icon1 = menuButton.icon1;
	window.icon2 = menuButton.icon2;

	window.addEventListener("resize", desktopMenu);
}

function slide(event)
{
	let menuButton = event.currentTarget;

	if(menuButton.opened)
	{
		modal.style.backgroundColor = "transparent";
		setTimeout(function() {document.getElementsByTagName("body")[0].removeChild(modal)}, 1000);
		menuButton.menu.style.left = "-80%";
		menuButton.opened = false;
		menuButton.style.width = 0;
		menuButton.style.height = 0;
		setTimeout(function(){menuButton.icon2.style.display = "none"; menuButton.icon1.style.display = "block"; menuButton.style.height = "40px"; menuButton.style.width = "40px";}, 250);
	}
	else
	{
		document.getElementsByTagName("body")[0].appendChild(modal);
		setTimeout(function() {modal.style.backgroundColor = "black"}, 100);
		menuButton.menu.style.left = 0;
		menuButton.opened = true;
		menuButton.style.width = 0;
		menuButton.style.height = 0;
		setTimeout(function(){menuButton.icon1.style.display = "none"; menuButton.icon2.style.display = "block"; menuButton.style.height = "40px"; menuButton.style.width = "40px";}, 250);
	}
}

function desktopMenu(event){
	if(window.innerWidth > 768)
	{
		window.menu.style.left = 0;
		document.getElementsByTagName("body")[0].removeChild(modal);
		window.icon2.style.display = "none";
		window.icon1.style.display = "block";
	}
	else
	{
		window.menu.style.left = "-80%";
		window.menuButton.opened = false;
	}
}