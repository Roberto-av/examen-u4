<?php 

include_once "config.php";
    if(isset($_POST["action"])){
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch($_POST["action"]){
            case "add_cupon":{
                $name=$_POST["name"];
                $code=$_POST["code"];
                $percentage=$_POST["percentage"];
                $min_amount=$_POST["min_amount"];
                $min_product=$_POST["min_product"];
                $start_date=$_POST["start_date"];
                $end_date=$_POST["end_date"];
                $max_uses=$_POST["max_uses"];
                $count_uses=$_POST["count"];
                $valid_only_first_purchase=$_POST["valid_only_first_purchase"];
                $status="1";
                $controllador= new cuponsController();
                $controllador->createCupon($name,$code,$percentage,$min_amount,
                                            $min_product,$start_date,$end_date,$max_uses,$count_uses,
                                        $valid_only_first_purchase,$status);
                break;

                
            }
            case "update_cupon":{
                $id=$_POST["id"];
                $name=$_POST["name"];
                $code=$_POST["code"];
                $percentage=$_POST["percentage"];
                $min_amount=$_POST["min_amount"];
                $min_product=$_POST["min_product"];
                $start_date=$_POST["start_date"];
                $end_date=$_POST["end_date"];
                $max_uses=$_POST["max_uses"];
                $count_uses=$_POST["count"];
                $controllador= new cuponsController();
                $controllador->updateCupon($id,$name,$code,$percentage,$min_amount,$min_product,$start_date,$end_date,$max_uses,$count_uses);
                break;
            }
            case "delete_cupon":{
                $id=$_POST["id"];
                $controllador= new cuponsController();
                $controllador->deleteCupon($id);
                break;
            }

        }
    };
class cuponsController {
	
	public function getAllCupons()
	{
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['user_data']->token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {
			
			return $response->data;

		}else{
			$_SESSION['error_message'] = "Error al agregar producto";
            header("Location: ".BASE_PATH."coupons/");
		}

	}

	public function getSpecificCupon(){
		if (isset($_GET["id"])){
			$id=$_GET["id"];
		};
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'.$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['user_data']->token
		),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {
			
			return $response->data;

		}else{
			$_SESSION['error_message'] = "Error al agregar producto";
            header("Location: ".BASE_PATH."coupons/");
		}
	}

	public function createCupon($name,$code,$percentage,$min_amount,$min_product,$start_date,$end_date,$max_uses,$count_uses,$valid_only_first_purchase,$status){

		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'name' => $name,
            'code' => $code,
            'percentage_discount' => $percentage,
            'min_amount_required' => $min_amount,
            'min_product_required' => $min_product,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'max_uses' => $max_uses,
            'count_uses' => $count_uses,
            'valid_only_first_purchase' => $valid_only_first_purchase,
            'status' => $status
            ),
        CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['user_data']->token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
		$response = json_decode($response);
		if (isset($response->code) && $response->code > 0) {
            $_SESSION['success_message'] = "producto agregado con éxito";
            header("Location: ".BASE_PATH."coupons/");
        } else {
            $_SESSION['error_message'] = "Error al agregar producto";
            header("Location: ".BASE_PATH."coupons/");
        }
	}

	public function updateCupon($id,$name,$code,$percentage,$min_amount,$min_product,$start_date,$end_date,$max_uses,$count_uses){
		$postFields ="name=" . urlencode($name) .
                    "&code=" . urlencode($code) .
                    "&percentage_discount=" . urlencode($percentage).
                    "&min_amount_required=". urlencode($min_amount) .
                    "&min_product_required=".  urlencode($min_product) .
                    "&start_date=". urlencode($start_date) .
                    "&end_date=". urlencode($end_date) .
                    "&max_uses=". urlencode($max_uses) .
                    "&count_uses=". urlencode($count_uses) .
                    "&id=" . urlencode($id);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Bearer '.$_SESSION['user_data']->token

            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
		if (isset($response->code) && $response->code > 0) {
            $_SESSION['success_message'] = "producto agregado con éxito";
            header("Location: ".BASE_PATH."coupons/details/".$id);
        } else {
            $_SESSION['error_message'] = "Error al agregar producto";
            header("Location: ".BASE_PATH."coupons/details/".$id);
        }
		
	}

	public function deleteCupon($id){
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$_SESSION['user_data']->token

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
		$response = json_decode($response);
		if (isset($response->code) && $response->code > 0) {
            $_SESSION['success_message'] = "producto agregado con éxito";
            header("Location: ".BASE_PATH."coupons");
        } else {
            $_SESSION['error_message'] = "Error al agregar producto";
            header("Location: ".BASE_PATH."coupons");
        }
	}
}

?>