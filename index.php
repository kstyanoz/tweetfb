<?php
include 'configfb.php';
//Namespace
				use Facebook\FacebookSession;
				use Facebook\FacebookRedirectLoginHelper;
				use Facebook\FacebookRequest;
				use Facebook\FacebookResponse;
				use Facebook\FacebookSDKException;
				use Facebook\FacebookRequestException;
				use Facebook\FacebookAuthorizationException;
				use Facebook\GraphObject;
				use Facebook\GraphUser;
				use Facebook\GraphSessionInfo;
				use Facebook\FacebookHttpable;
				use Facebook\FacebookCurlHttpClient;
				use Facebook\FacebookCurl;


?>
<!DOCTYPE html>
	<head>
	</head>	
	<body>
	
	
	
<?php


//if(isset($_REQUEST["msj"])){


		if(isset($_REQUEST["msj"]) AND isset($_REQUEST["tweet"]) AND $_REQUEST['tweet']==true){

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


		if(isset($_REQUEST["fb"]) AND $_REQUEST['fb']==true){
		
				$_REQUEST["msj"] = "MSJ PRUEBA SDK";
				/* USE NAMESPACES */
				//echo "enviando A FACEBOOK: ".$_REQUEST["msj"]."<br/>".$respuesta;
				
				/***************************************/
				 session_start();
					//2.Use app id,secret and redirect url
					 $app_id = '1845802585645056';
					 $app_secret = 'd8f279f49a61ca1c900fc7babc51e41d';
					 $redirect_url='http://localhost/tweetfb/index.php?fb=1';
					 
					 //3.Initialize application, create helper object and get fb sess
					 FacebookSession::setDefaultApplication($app_id,$app_secret);
					 $helper = new FacebookRedirectLoginHelper($redirect_url);
					 $sess = $helper->getSessionFromRedirect();

					//4. if fb sess exists echo name 
					if(isset($sess)){
							//create request object,execute and capture response
							
						$request = new FacebookRequest($sess, 'GET', '/me');
						// from response get graph object
						$response = $request->execute();
						$graph = $response->getGraphObject(GraphUser::className());
						// use graph object methods to get user details
						$name= $graph->getName();
						echo "hi $name";
						
						/*************Envia mensaje de texto***************/
						try {
							$response = (new FacebookRequest(
								$sess, 'POST', '/me/feed', array(
									'link' => '',
									'message' => $_REQUEST['msj']
								)
							))->execute()->getGraphObject();
							echo "Posteado con id: " . $response->getProperty('id');
						} catch(FacebookRequestException $e) {
							echo "Exception occured, code: " . $e->getCode();
							echo " with message: " . $e->getMessage();
						}   
						
						/***********Envia fotografia*****************/
						
									/*		try {

										// Upload to a user's profile. The photo will be in the
										// first album in the profile. You can also upload to
										// a specific album by using /ALBUM_ID as the path     
										$response = (new FacebookRequest(
										  $sess, 'POST', '/me/photos', array(
											'source' => new CURLFile('', 'image/jpg'),
											'message' => 'Prueba con imagenes'
										  )
										))->execute()->getGraphObject();

										// If you're not using PHP 5.5 or later, change the file reference to:
										// 'source' => '@/path/to/file.name'

										echo "Posted with id: " . $response->getProperty('id');

									  } catch(FacebookRequestException $e) {

										echo "Exception occured, code: " . $e->getCode();
										echo " with message: " . $e->getMessage();

									  }  */ 
						/**************************************/
					
						
					}else{
					
						//else echo login
						
						
						echo '<a href='.$helper->getLoginUrl().'>Login with facebook</a>';
					}
								/***************************************/
						
						
								
			
			}
			
						/*echo "<form action='".$helper->getLoginUrl()."'  method='post'>
							<label>Mensaje:</label><br>
							<textarea id='msj' name='msj'></textarea><br>		
							<input type='checkbox' name='tweet'/>tweet<br>
							<input type='checkbox' name='fb'/>fb<br>
							<button type='submit'>Enviar</button>
							<input type='button' value='Postear en Face' />
						</form>";*/

//}
?>

					<form action=''  method='post'>
							<label>Mensaje:</label><br>
							<textarea id='msj' name='msj'  onkeyup='alertar();'></textarea><br>		
							<input type='checkbox' name='tweet'/>tweet<br>
							<input type='checkbox' name='fb' id='fb' />fb<br>
							<button type='submit'>Enviar</button>
							<input type='button' value='Postear en Face' />
						</form>


    </body>
	
</html>