document.getElementById('updateButton').addEventListener('click', function() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'index.php', true);
	xhr.onload = function() {
		if (xhr.status == 200) {
			document.getElementById('content').innerHTML = xhr.responseText;
		}
	};
	xhr.send();
});
