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



		if(isset($_REQUEST["fb"]) AND $_REQUEST['fb']==true){
		
				$_REQUEST["msj"] = $_REQUEST["msj"];
				/* USE NAMESPACES */
				//echo "enviando A FACEBOOK: ".$_REQUEST["msj"]."<br/>".$respuesta;
				
				/***************************************/
				 session_start();
					//2.Use app id,secret and redirect url
					 $app_id = '1845802585645056';
					 $app_secret = 'd8f279f49a61ca1c900fc7babc51e41d';
					 $token = 'CAAaOv2dxYAABACTE7pvZAxWRzMnP8uTCvbr2wigTywY6hZBo60VRlAZCRjUjLPzCZCgZAiTtO5cgybPSmun8dwOb13x2b29Ujz7uhVSh3WEtzoXNCRZAcEQvpqzN0DHRcKttuSCvjR1Wd0CVmf8DRYFmZBqmIe6PnvK6JApZCRYXm5zBgNP7nu2p';
					 $redirect_url='http://localhost/tweetfb/index.php?fb=1';
					 
					 //3.Initialize application, create helper object and get fb sess
					/* FacebookSession::setDefaultApplication($app_id,$app_secret);
					 $helper = new FacebookRedirectLoginHelper($redirect_url);
					 $sess = $helper->getSessionFromRedirect();*/
					 
					 $message = $_REQUEST["msj"];
$url = '';
$image = '';
					 
					 FacebookSession::setDefaultApplication($app_id,$app_secret);
					$sess = new FacebookSession($token);
					 
											 if($sess) {
							try {
								$response = (new FacebookRequest(
									$sess, 'POST', '/me/feed', array(
										'message'       => $message,
										'link'          => $url,
										'picture'       => $image
									)
								))->execute()->getGraphObject();
								echo "Posted with id: " . $response->getProperty('id');
							} catch(FacebookRequestException $e) {
								echo "Exception occured, code: " . $e->getCode();
								echo " with message: " . $e->getMessage();
							}
						} else {
							echo "No Session available!";
						}
					 

					//4. if fb sess exists echo name 
					/*if(isset($sess)){
							//create request object,execute and capture response
							
						$request = new FacebookRequest($sess, 'GET', '/me');
						// from response get graph object
						$response = $request->execute();
						$graph = $response->getGraphObject(GraphUser::className());
						// use graph object methods to get user details
						$name= $graph->getName();
						echo "hi $name";
						*/
						/*************Envia mensaje de texto***************/
					/*	try {
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
						*/
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
					
						
					/*}else{
					
						//else echo login
						
						
						echo '<a href='.$helper->getLoginUrl().'>Login with facebook</a>';
					}
							
						
				*/		
								
			
			}
					
//}
?>


    </body>
	
</html>