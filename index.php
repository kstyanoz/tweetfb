<!DOCTYPE html>
	<head>
	</head>	
	<body>

<?php
if($_REQUEST["msj"]){


if($_REQUEST['tweet']==true){

$consumerKey    = 'yUdZHW0ugeZsjT0VSjat9tmH2';
$consumerSecret = 'zqNZHWaXp19X6VVOL9UQwvHFqY3idmQNeMTx1RvCVE2dhuDjVY';
$oAuthToken     = '778752343-q8NhHOlEM5opFKViXjBb1LRVyCVm587bnCCmD7Lp';
$oAuthSecret    = 'zqNZHWaXp19X6VVOL9UQwvHFqY3idmQNeMTx1RvCVE2dhuDjVY';


# API OAuth
require_once('twitteroauth.php');

$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

# your code to retrieve data goes here, you can fetch your data from a rss feed or database

//$tweet->post('statuses/update', array('status' => $_REQUEST["msj"]));
$respuesta=$tweet->post('statuses/update', array('status' => $_REQUEST["msj"]));
echo "enviando a tweetter: ".$_REQUEST["msj"]."<br/>".$respuesta;
}


if($_REQUEST['fb']==true){
echo "enviando A FACEBOOK: ".$_REQUEST["msj"]."<br/>".$respuesta;
}

}
?>

	<form action="" method="post">
	
		<label>Mensaje:</label><br>
		<textarea id="msj" name="msj"></textarea><br>		
		
		<input type='checkbox' name="tweet"/>tweet<br>
		<input type='checkbox' name="fb"/>fb<br>
		<button type="submit">Enviar</button>
	</form>
    </body>
	
</html>