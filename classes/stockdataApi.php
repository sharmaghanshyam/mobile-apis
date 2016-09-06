<?php
  /*
  * This class is used for stockdata using ticker code
  */
  class stockdataApi
  {
     
   var $symble;
   var $newsurl;
   var $summeryurl;
   function getsymble($val)
    {
       $this->symble=$val;
       $this->newsurl="http://finance.yahoo.com/rss/headline?s=$val";
       $this->summeryurl="http://finance.yahoo.com/q/pr?s=$val";
    }
   
   
   function getnodevalue($root,$element)
   {
       $items=$root->getElementsByTagName($element);
       foreach($items as $item)
       {
           return $item->nodeValue;
       }
   }
   function getsummary()
   {
       
       $needle="<span class=\"yfi-module-title\">Business Summary</span>";
       $str=file_get_contents($this->summeryurl);
       $pos = strripos($str, $needle);
       $pos1= strripos($str, '<b>Key Statistics</b>'); 
       $str1='';
       for($i=($pos+172);$i<($pos1-95);$i++)
       {
           $str1.=$str[$i];
       }
             
       return  $str1;
       
   }
   
   function getnews(&$len)
   {
       $dom = new DOMDocument();
       $dom->load($this->newsurl);
       $news=array();
       $i=0;
       $items = $dom->getElementsByTagName('item');
       foreach($items as $item)
       {
            $news[$i]['title']=$this->getnodevalue($item,'title');
            $news[$i]['link']=$this->getnodevalue($item,'link');
            $news[$i]['description']=$this->getnodevalue($item,'description');
            $news[$i]['pubDate']=$this->getnodevalue($item,'pubDate');
            $i++;
       }
       $len=$i;
       return $news; 
   }
   function removes($str)
   {
       $ch='';
       for($i=0;$i<strlen($str);$i++)
       {
           if($str[$i]!=',')
           {
               $ch.=$str[$i];
           }
           
       }
       return $ch;
      
   }
   function seperate($str)
   {
       
       $data=array();
       $k=0;
       
       for($i=0;$i<count($str)-1;$i++)
       {
                      
           $val=$str[$i];
           
           if(strlen($val)==47)
           {
               continue;
                          }
           if((strlen($val)==1)&&($val==','))
           {
               continue;
             
           }
           $data[$k]=$this->removes($val);
           $k++;
           
       }
       return $data;
     }
   
   
   function gettradeval()
    {
            
       $url="http://finance.yahoo.com/d/quotes.csv?s=$this->symble&f=aza2za5zbzb2zb3zb4zb6zczc1zc3zc6zc8zdzd1zd2zeze1ze7ze8ze9zf6zgzhzjzkzg1zg3zg4zg5zg6zizi5zj1zj3zj4zj5zj6zk1zk2zk3zk4zk5zlzl1zl2zl3zmzm2zm3zm4zm5zm6zm7zm8zn4zozpzp1zp2zp5zp6zqzrzr1zr2zr5zr6zr7zszs1zs7zt1zt8zvzv1zv7zwzw1zw4zxzyz";      
       $p=file_get_contents($url);
       $prr=explode('"',$p); 
       $arr=$this->seperate($prr);
       $data=array();
       $data['Ask']=$arr[0];
       $data['Average Daily Volume']=$arr[1];  
       $data['Ask Size']=$arr[2];
       $data['Bid']=$arr[3];
       $data['Ask (Real-time)']=$arr[4];
       $data['Bid (Real-time)']=$arr[5];
       $data['Book Value']=$arr[6];
       $data['Bid Size']=$arr[7];
       $data['Change & Percent Change']=$this->removes($arr[8]);
       $data['Change']=$arr[9];
       $data['Commission']=$arr[10];
       $data['Change (Real-time)']=$this->removes($arr[11]);
       $data['After Hours Change (Real-time)']=$this->removes($arr[12]);      
       $data['Dividend/Share']=$arr[13];
       $data['Last Trade Date']=$this->removes($arr[14]);
       $data['Trade Date']=$arr[15];
       $data['Earnings/Share']=$arr[16];
       $data['Error Indication (returned for symbol changed / invalid)']=$this->removes($arr[17]);
       $data['EPS Estimate Current Year']=$arr[18];
       $data['EPS Estimate Next Year']=$arr[19];
       $data['EPS Estimate Next Quarter']=$arr[20];
       $data['Float Shares']=$arr[21];
       $data['Days Low']=$arr[22];
       $data['Days High']=$arr[23];
       $data['52-week Low']=$arr[24];
       $data['52-week High']=$arr[25];
       $data['Holdings Gain Percent']=$arr[26];
       $data['Annualized Gain']=$arr[27];
       $data['Holdings Gain']=$this->removes($arr[28]);
       $data['Holdings Gain Percent (Real-time)']=$this->removes($arr[29]);
       $data['Holdings Gain (Real-time)']=$this->removes($arr[30]);
       $data['More Info']=$this->removes($arr[31]);
       $data['Order Book (Real-time)']=$this->removes($arr[32]);
       $data['Market Capitalization']=$this->removes($arr[33]);
       $data['Market Cap (Real-time)']=$arr[34];
       $data['EBITDA']=$arr[35];
       $data['Change From 52-week Low']=$arr[36];
       $data['Percent Change From 52-week Low']=$arr[37];
       $data['Last Trade (Real-time) With Time']=$this->removes($arr[38]);
       $data['Change Percent (Real-time)']=$this->removes($arr[40]);
       $data['Last Trade Size']=$this->removes($arr[39]);
       $data['Change From 52-week High']=$arr[41];
       $data['Percebt Change From 52-week High']=$arr[42];
       $data['Last Trade (With Time)']=$this->removes($arr[43]);
       $data['Last Trade (Price Only)']=$this->removes($arr[44]);
       $data['High Limit']=$arr[45];
       $data['Low Limit']=$arr[46];
       $data['Days Range']=$this->removes($arr[47]);
       $data['Days Range (Real-time)']=$this->removes($arr[48]);
       $data['50-day Moving Average']=$this->removes($arr[49]);
       $data['200-day Moving Average']=$arr[50];
       $data['Change From 200-day Moving Average']=$arr[51];
       $data['Percent Change From 200-day Moving Average']=$arr[52];
       $data['Change From 50-day Moving Average']=$arr[53];
       $data['Percent Change From 50-day Moving Average']=$arr[54];
       $data['Notes']=$arr[55];
       $data['Open']=$this->removes($arr[56]);
       $data['Previous Close']=$arr[57];
       $data['Price Paid']=$arr[58];
       $data['Change in Percent']=$arr[59];
       $data['Price/Sales']=$this->removes($arr[60]);
       $data['Price/Book']=$arr[61];
       $data['Ex-Dividend Date']=$arr[62];
       $data['P/E Ratio']=$this->removes($arr[63]);
       $data['Dividend Pay Date']=$arr[64];
       $data['P/E Ratio (Real-time)']=$this->removes($arr[65]);  
       $data['PEG Ratio']=$arr[66];  
       $data['Price/EPS Estimate Current Year']=$arr[67];  
       
       $data['Price/EPS Estimate Next Year']=$arr[68];  
       
       $data['Symbol']=$this->removes($arr[69]);  
       
       $data['Shares Owned']=$arr[70];  
       $data['Short Ratio']=$arr[71];  
       $data['Last Trade Time']=$this->removes($arr[72]);  
       
       //$data['Trade Links']=$this->removes($arr[73]);  
       //$data['Ticker Trend']=$this->removes($arr[74]);  
       $data['1 yr Target Price']=$this->removes($arr[73]);  
       $data['Volume']=$arr[74];  
       $data['Holdings Value']=$arr[75];  
       $data['Holdings Value (Real-time)']=$arr[76];  
       $data['52-week Range']=$this->removes($arr[77]);  
       $data['Days Value Change']=$this->removes($arr[78]);  
       $data['Days Value Change (Real-time)']=$this->removes($arr[79]);  
       $data['Stock Exchange']=$this->removes($arr[80]);  
       $data['Dividend Yield']=$this->removes($arr[81]);  
       $url="http://finance.yahoo.com/d/quotes.csv?s=$this->symble&f=n";
       $p=file_get_contents($url); 
       $data['Name']=str_replace("\"",' ',$p);
       return $data; 
    } 

	
	function imageChange($ticker)
	{
		 $val=$ticker;
		 $flag=TRUE;
		 $chart="http://ichart.finance.yahoo.com/b?s=";
		 if(!isset($val)){$flag=FALSE;}
		 if($flag)
		{ $chart.=$val; }
		 return $chart; 
	}
	
	
	function stockData($ticker)
	{
		$this->getsymble($ticker);
		$newslen=0;
		$data['imageticker'] = $this->imageChange($ticker);
		$data['gettradeval'] = $this->gettradeval();
		$data['getnews'] = $this->getnews($newslen);
		$data['summary'] = $this->getsummary();
		$status =SUCCESS;
		$message = MESSAGE;
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result" =>$data
						);

		return $response;
	}
	
  }
?>
