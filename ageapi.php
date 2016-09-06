<?php

	include_once ("classes/userApi.php");
	include_once ("classes/stockdataApi.php");
	
	
        $obj = new userApi();    
	
		/* Code to get state list according to country */
			if(isset($_GET['dob']) && $_GET['dob']!='')
			{	// dd/mm/yyyy change to dd.mm.yyyy
				$dob = explode("/",$_GET['dob']);
				if(sizeof($dob)>=3)
				{
					$dobconvert = $dob[0].".".$dob[1].".".$dob[2];
					$data = $obj->dob($dobconvert);
				}
				else{
					$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
				}				
			}
			else{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}			
			echo json_encode($data);
	    
		
	
?>