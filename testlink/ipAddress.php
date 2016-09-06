<?php
 include('header.php');	
if($_POST)
{
	$url = "http://".$_SERVER['SERVER_NAME']."/api/ipAddressapi.php";
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
	
	echo "Json : <textarea col='5'>".$rawdata."</textarea><br><br><pre>";
	print_r($arrayResult);
	echo "</pre>";
	
	
}

?>
<div class="content">
<form action='' method="post" enctype='multipart/form-data'>
 
 Ip Address Details (Webservice API)
 <br/><input type="text" name="ipAddress" value=""/>
 <br/><input type="submit"/>
</form>

</div>
<?php
 include('footer.php');	
 ?>