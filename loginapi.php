<?php

	include_once ("classes/userApi.php");
	

        $obj = new userApi();    

        if(!empty($_POST)){
          
			$input_data = $_POST;
            if(is_array($input_data)){$passData = $input_data;}else{$passData = json_decode($input_data, true);}
            
            if(!empty($passData['email']) && !empty($passData['password']) ){
                
			
				$data = $obj->getLogin($passData);
             

            }else{
                if(empty($passData['email'])){
                    $data["status"] = FAIL;
                    $data["message"] = REQUIREDDATA;
                }
                
                if(empty($passData['password'])){
                    $data["status"] = FAIL;
                    $data["message"] = REQUIREDDATA;
                }
                
            }
            
        }else{
            $data["status"] 	= FAIL;
            $data["message"]	= REQUIREDDATA;
        } 

	
        echo json_encode($data);
        
       
?>