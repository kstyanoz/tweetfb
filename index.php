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
				
				
		require "lib/Twitter/autoload.php";
		use Abraham\TwitterOAuth\TwitterOAuth;


?>
<!DOCTYPE html>
	<head>
	<title>PF Movil </title>
	<meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/examinar.js"></script>
	</head>	
<body>
<?php
//if(isset($_REQUEST["msj"])){

		if(isset($_REQUEST["msj"]) AND isset($_REQUEST["tweet"]) AND $_REQUEST['tweet']==true){
		
			$consumerKey    = 'uzfFO6Rb3rEIsZqiPGddEQtGu';
			$consumerSecret = 'liGm87lUgsKyK87TezyGPbUUXHbkCxok6DZPaFL12x4NrpSGg2';
			$access_token     = '778752343-wP6EirICwRZiv755s2schp2b5WN4KEEmWTfja69w';
			$access_token_secret    = 'gNeGXCIpSQMn8CjGi3TffSvDC3B4saarCbDxmkvEvE7rP';
			# API OAuth
			
			$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token, $access_token_secret);
			$content = $connection->get("account/verify_credentials");
			$image = $_FILES['pic']['tmp_name'];
			
			$media1 = $connection->upload('media/upload', array('media' => $image));
			$parameters = array(
				'status' => $_REQUEST["msj"],
				'media_ids' => implode(',', array($media1->media_id_string)),
			);
			$result = $connection->post('statuses/update', $parameters);
			//echo "Enviando a Twitter: ".$_REQUEST["msj"]."<br/>".$result;
				
		}

		
		if(isset($_REQUEST["fb"]) AND $_REQUEST['fb']==true){
		
				//echo "enviando A FACEBOOK: ".$_REQUEST["msj"]."<br/>".$respuesta;
				
				/***************************************/
				 session_start();
					//2.Use app id,secret and redirect url
					 $app_id = '1845802585645056';
					 $app_secret = 'd8f279f49a61ca1c900fc7babc51e41d';
					 $token = 'CAAaOv2dxYAABACTE7pvZAxWRzMnP8uTCvbr2wigTywY6hZBo60VRlAZCRjUjLPzCZCgZAiTtO5cgybPSmun8dwOb13x2b29Ujz7uhVSh3WEtzoXNCRZAcEQvpqzN0DHRcKttuSCvjR1Wd0CVmf8DRYFmZBqmIe6PnvK6JApZCRYXm5zBgNP7nu2p';
					 $redirect_url='http://localhost/tweetfb/index.php?fb=1';
					 
					$message = $_REQUEST["msj"];
					$url = '';
					 
					FacebookSession::setDefaultApplication($app_id,$app_secret);
				  	$sess = new FacebookSession($token);
					 
					if($sess) {
						
						
						if(isset($_REQUEST["pathpic"]) AND !EMPTY($_REQUEST["pathpic"])){
							/***********Envia fotografia*****************/
							
							$image = $_FILES['pic']['tmp_name'];
						
								try {
											// Upload to a user's profile. The photo will be in the
											// first album in the profile. You can also upload to
											// a specific album by using /ALBUM_ID as the path     
											$response = (new FacebookRequest(
											  $sess, 'POST', '/me/photos', array(
												'source' => new CURLFile($image, 'image/jpg'),
												'message' => $message
											  )
											))->execute()->getGraphObject();

											// If you're not using PHP 5.5 or later, change the file reference to:
											// 'source' => '@/path/to/file.name'

											echo "Posted with id: " . $response->getProperty('id');

										  } catch(FacebookRequestException $e) {

											echo "Exception occured, code: " . $e->getCode();
											echo " with message: " . $e->getMessage();

										  } 
								/**************************************/
			
						}else{
							
							/*************Envia mensaje de texto***************/
							try {
									$response = (new FacebookRequest(
										$sess, 'POST', '/me/feed', array(
											'message'       => $message,
											'link'          => $url
										)
									))->execute()->getGraphObject();
									
									echo "ID-Posted: " . $response->getProperty('id');
								} catch(FacebookRequestException $e) {
										echo "Exception occured, code: " . $e->getCode();
										echo "with message: " . $e->getMessage();
								}
						}
						
					} else {echo "Sesion no disponible o caducada!";}
			}
		
//}
?>

				<div class='divPrin' align='center'>
					<div class='titulo'>Facebook-Twitter</div>
						<div id='divFormat'  class='divFormat' style=''>	
							<form action=''  method='post' id='formid'  enctype="multipart/form-data">
									<label id='etiqueta'>Mensaje:</label><br>
									<textarea id='msj' name='msj' rows="5"></textarea><br/>	<br/>
								
											<div class="divInpFile">
												<span class="spanInpFile" style="background:url(galeria.jpg);background-size: 100px 40px;background-repeat:no-repeat;"></span>
												<input type="file" id="file-input" class="file-input" name="pic"  onchange="doIt()" accept="image/jpeg"/>
											</div>
											<center><canvas id="foto" class="canvasFoto" style='display:none' ></canvas></center>
									<!-- input type='file' class="file" name='pic' id='pic' onchange='empezar(this.value);' value='' accept="image/jpeg" --><br/><br/>
									<input type='hidden' name='pathpic' id='pathpic'><br/>
									<div id='divCheckB' align=left>
										<input type='checkbox' name='tweet' id='tweet'/><label for="tweet">Twitter</label><br/>
										<input type='checkbox' name='fb'    id='fb'/><label for="fb">Facebook</label><br/>
									</div><br/><br/>
									<button type='submit'>Enviar</button><br/>
							</form>
						</div>
					
					
				</div>


    </body>
	
</html>