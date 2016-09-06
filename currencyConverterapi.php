<?php

	include_once ("classes/userApi.php");
	

        $obj = new userApi();    

        if(!empty($_POST)){
          
			$input_data = $_POST;
            if(is_array($input_data)){$passData = $input_data;}else{$passData = json_decode($input_data, true);}
            
            if(!empty($passData['fromCurrency']) && !empty($passData['toCurrency']) && !empty($passData['amount']) ){
        	
				$data = $obj->currencyConverter($passData);
        
            }else{
                    $data["status"] = FAIL;
                    $data["message"] = REQUIREDDATA;
            }
            
        }else{
            $data["status"] 	= FAIL;
            $data["message"]	= REQUIREDDATA;
        } 

	
        echo json_encode($data);
        
       
?>