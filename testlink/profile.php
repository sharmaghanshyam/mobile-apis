<?php
include('header.php');

if($_SESSION['username']=='')
{
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/api/testlink/login.php');
	exit;
}

if($_POST)
{
	$url = "http://".$_SERVER['SERVER_NAME']."/api/loginapi.php";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $_POST);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);
	
	$arrayResult = json_decode($rawdata);
	
	//echo "Json : <textarea col='5'>".$rawdata."</textarea><br><br><pre>";
	//print_r($arrayResult);
	
	
	if($arrayResult->Result->token!='')
	{
		//header('Location: http://'.$_SERVER['SERVER_NAME'].'/api/testlink/profile.php');
		//exit;
	}
	

	
}

?>
<div class="content">
 
 Logged In as <?php echo $_SESSION['username']; ?> 

	<a href="logout.php">logout</a>
	</div>