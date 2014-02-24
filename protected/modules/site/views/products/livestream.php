<!DOCTYPE HTML>
<html>
	<head>		
		<script src="http://static.opentok.com/v1.1/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			TB.addEventListener("exception", exceptionHandler);
			var session = TB.initSession("<?php echo $tokbox['tokbox_session']?>");
			session.addEventListener("sessionConnected", sessionConnectedHandler);
			session.addEventListener("streamCreated", streamCreatedHandler);
			session.connect(<?php echo Yii::app()->settings->tokbox_api_key?>, "<?php echo $tokbox['tokbox_token']?>"); 

			function sessionConnectedHandler(event) {
				 subscribeToStreams(event.streams);
				 session.publish();
			}

			function streamCreatedHandler(event) {
				subscribeToStreams(event.streams);
			}

			function subscribeToStreams(streams) {
				for (var i = 0; i < streams.length; i++) {
					var stream = streams[i];
					if (stream.connection.connectionId != session.connection.connectionId) {
						session.subscribe(stream);
					}
				}
			}

			function exceptionHandler(event) {
				alert("Exception: " + event.code + "::" + event.message);
			}
		</script>
	</head>
	<body>
	</body>
</html>