<table>
 <tbody id="response">
 </tbody>
</table>
<script type="application/javascript">
if ( typeof(EventSource) !== "undefined" ) {
	
		const stream = new EventSource('event.php');
		const newsList = document.getElementById('response');
		
		stream.addEventListener('chat', (e) => {
			let data = JSON.parse(e.data);
			newsList.innerHTML += '<tr><td><strong>' + data.name + '</strong> : ' + data.message + '</td></tr>';
		});
		
		stream.addEventListener('open', (e) => {
			newsList.innerHTML = '<tr><td><strong>' + e.data + '</strong></td></tr>';
		});		
		
		stream.addEventListener('message', (e) => {
			newsList.innerHTML += '<tr><td><strong>' + e.data + '</strong></td></tr>';
		});

		stream.addEventListener('error', (e) => {
			switch (e.target.readyState) {
				case 0:
					newsList.innerHTML = '<tr><td><strong> Stream Connecting.. </strong></td></tr>';
					break;
					
				case 2:
					newsList.innerHTML += '<tr><td><strong> Stream Close.. </strong></td></tr>';
					break;							
			};
		});
	
}	else	{
	newsList.innerHTML = "Sorry, your browser does not support server-sent events...";
};
</script>