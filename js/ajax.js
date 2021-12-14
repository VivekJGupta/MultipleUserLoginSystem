let fetchBtn = document.getElementById('data');

fetchBtn.addEventListener('click', buttonClickHandler);



function buttonClickHandler()
{
	console.log("Clicked!");
	const xhr = new XMLHttpRequest();
	xhr.open('GET', 'harry.txt', true);
}