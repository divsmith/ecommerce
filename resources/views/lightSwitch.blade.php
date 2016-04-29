<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
	<script type="text/javascript" src="//cdn.jsdelivr.net/particle-api-js/5/particle.min.js">
	</script>
	<link rel="stylesheet" href="css/lightSwitch.css"/>
</head>
<body>

<div class="container">
	<div class="row">
		<div id="buttonContainer" class="col-md-2 col-xs-4">
			<button onclick="switchLight()" id="onButton" class="btn btn-success btn-lg btn-block">On</button>
			<button onclick="switchLight()" id="offButton" class="btn btn-danger btn-lg btn-block hidden">Off</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	var particle = new Particle();
	var token = '6f36d54a3b4573c88bd66f3ff40ed435fe65f44d';
	var id = '390045000b47343432313031'

	particle.getEventStream({ deviceId: id, auth: token }).then(function(stream) {
		stream.on('event', function(data) {
			console.log(data);

			if ( data.name === 'light' ) {
				if ( data.data === '0' ) {
					// make on button visible
					document.getElementById('onButton').className = 'btn btn-success btn-lg btn-block';
					document.getElementById('offButton').className = 'hidden';
					console.log('making the on button visible');
				} else if ( data.data === '1' ) {
					// make the off button visible
					document.getElementById('offButton').className = 'btn btn-danger btn-lg btn-block';
					document.getElementById('onButton').className = 'hidden';
					console.log('making the off button visible');
				}
			}
		});
	});

	function switchLight() {
		console.log('switching the light');

		var fnPr = particle.callFunction({ deviceId: id, name: 'flipSwitch', argument: 'hi', auth: token });

		fnPr.then(
				function(data) {
					console.log('Function called succesfully:', data);
				}, function(err) {
					console.log('An error occurred:', err);
				});
	}

</script>
</body>
</html>