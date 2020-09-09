<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
	<title>SSE Chat</title>
        <style type="text/css">
		body{
			font-family: tahoma;
			margin: auto;
			padding: 1px;
			width: auto;
		}

		#response, h1{
			margin-top: 10px;
			margin-right: 20px;
			margin-left: 20px;
		}

		.message-area{
			margin: 10px 10px;
			width: auto;
		}
		
		iframe{
			overflow: scroll;
			margin: 1px 1px 10px 20px;
			padding: 1px;
			border: 0px;
			font-size: 15px;
			width: auto;
			height: 50%;
		}

        </style>
	</head>
    <body>
        <h1>SSE Chat:</h1>
        <iframe src="source.php"></iframe>
		
        <div class="message-area">
	        <form method="post">
                <input type="text" name="name" id="name" placeholder="Nama" />
	        	<input type="text" name="message" id="message" placeholder="Pesan"/>
				<input type="submit" id="send" value="Send" />
	    	</form>
	    </div>
		
		<script type="application/javascript">
		const body = document.querySelector('body');
		const form = document.querySelector('form');
		
		this.queue = [];
		this.delay = null;
		
		let name = form.elements['name'];
		let message = form.elements['message'];
		
		body.addEventListener('load', start() );
		
		form.addEventListener('submit', (e) => {
			e.preventDefault();
				queue.push(
					JSON.stringify({
						name: name.value,
						message: message.value
					})
				);
			message.value = null;
		});
		
		function start() {
			stop(); delay = setInterval(post, 1000);
		};
		
		function stop() {
			if ( delay != null ) {
				clearInterval(delay);
				delay = null;
			} 
		};
		
		function post() {
			if (queue.length > 0) {	
			stop();
				while (queue.length > 0) {
					fetch('add.php', {
						method: 'POST',
						headers: { 
							'Content-Type': 'application/json',
							'Access-Control-Allow-Origin': '*'
						},
						body: queue.pop()
					});
				}
			start();
			};
		};
		</script>
    </body>
</html>