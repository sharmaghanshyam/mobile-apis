<?php
include('header.php');	
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
	
	
	if(isset($arrayResult->Result->token) && $arrayResult->Result->token!='')
	{
		$_SESSION['token'] =$arrayResult->Result->token;
		$_SESSION['id'] = $arrayResult->Result->userDetails->id;
		$_SESSION['username'] = $arrayResult->Result->userDetails->UserName;
		$_SESSION['email'] = $arrayResult->Result->userDetails->Email;
	
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/api/testlink/profile.php');
		exit;
	}else
	{
		echo "Json : ".$rawdata."<br><br><pre>";
		print_r($arrayResult);
	}
	
	
	
}

if(isset($_SESSION['token']) && $_SESSION['token']!='')
{

		header('Location: http://'.$_SERVER['SERVER_NAME'].'/api/testlink/profile.php');
		exit;

}

?>
<div class="content">
<form action='' method="post" enctype='multipart/form-data'>
 <table>
 <th colspan="2">
 Login Panel API (Webservice)
 </th>
 <tr>
	<td>Email : </td>
	<td><input type="text" name="email" value=""/></td>
 </tr>	
 <tr>
	<td>Password : </td>
	
	<td><input type="text" name="password" value=""/></td>
</tr>	
 <tr><td colspan="2"><input type="submit"/></td>
 </tr>
 </table>
</form>

</div>
<?php
 include('footer.php');	
 ?>