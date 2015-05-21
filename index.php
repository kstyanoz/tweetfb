<!DOCTYPE html>
	<head>
	</head>	
	<body>

<?php
if($_REQUEST["msj"]){

	if($_REQUEST['tweet']==true){

		$consumerKey    = 'DWUXSI1l4posXOBkTJXTeC8Vt';
		$consumerSecret = 'I5TLlFeKTOqBrEoy9xvNu60IoIq7OdwITowuUc5RD7gSYn7soM';
		$oAuthToken     = '778752343-wP6EirICwRZiv755s2schp2b5WN4KEEmWTfja69w';
		$oAuthSecret    = 'gNeGXCIpSQMn8CjGi3TffSvDC3B4saarCbDxmkvEvE7rP';

		# API OAuth
		require_once('twitteroauth.php');

		$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

		# your code to retrieve data goes here, you can fetch your data from a rss feed or database

		//$tweet->post('statuses/update', array('status' => $_REQUEST["msj"]));
		$respuesta=$tweet->post('statuses/update', array('status' => $_REQUEST["msj"]));
		echo "Enviando a Twitter: ".$_REQUEST["msj"]."<br/>".$respuesta;

		
		//******************************	Upload media
		/*$tweet = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
		$media1 = $tweet->upload('media/upload', array('media' => 'img/Koala.jpg'));
		$parameters = array(
			'status' => $_REQUEST["msj"],
			'media_ids' => implode(',', array($media1->media_id_string)),
		);
		$respuesta = $tweet->post('statuses/update', $parameters);
		echo "Enviando a Twitter: ".$_REQUEST["msj"]."<br/>".$respuesta;*/
	}


	if($_REQUEST['fb']==true){
	echo "enviando A FACEBOOK: ".$_REQUEST["msj"]."<br/>".$respuesta;
	}

}
?>

	<form action="" method="post">
	
		<label>Mensaje:</label><br>
		<textarea id="msj" name="msj"></textarea><br>
		
		<!--input type="file" name="imagen" id="imagen" /><br-->
		
		<input type='checkbox' name="tweet"/>tweet<br>
		<input type='checkbox' name="fb"/>fb<br>
		<button type="submit">Enviar</button>
	</form>
    </body>
	
</html>