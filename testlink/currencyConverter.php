<?php
 include('header.php');	
if($_POST)
{
	$url = "http://".$_SERVER['SERVER_NAME']."/api/currencyConverterapi.php";
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
	
	echo "Json : ".$rawdata."<br><br>Array : ";
	print_r($arrayResult);
	
	
}

?>
<div class="content">
<form action='' method="post" enctype='multipart/form-data'>
 <table>
 <th colspan="2">
 Currency Converter API (Webservice)
 </th>
 <tr><td>Amount</td><td> <input type="text" name="amount" value=""/></td></tr>
	<tr>
		<td>From :</td>
		<td> <select name="fromCurrency">
				<option value="USD">USD</option>
				<option value="EUR">EUR</option>
				<option value="INR">INR</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>To :</td><td> <select name="toCurrency">
			<option value="USD">USD</option>
			<option value="EUR">EUR</option>
			<option value="INR">INR</option>
	</select>
	</td></tr>
	<tr><td colspan="2">
	<input type="submit"/>
	</td></tr>
	</table>
</form>
</div>
<?php
 include('footer.php');	
 ?>