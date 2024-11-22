<?php 
include_once "config.php";
    if(isset($_POST["action"])){
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch($_POST["action"]){
            case "add_brand":{
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $productController= new BrandsController();
                $productController->createBrand($name,$slug,$description);
                break;
                
            }
            case "update_brand":{
                $id=$_POST["id"];
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $productController= new BrandsController();
                $productController->updateBrand($id,$name,$slug,$description);
                break;
            }
            case "delete_brand":{
                $id=$_POST["id"];
                
                $productController= new BrandsController();
                $productController->deleteBrand($id);
                break;
            }

        }
    };
class BrandsController {
	
	public function getAllBrands()
	{
		$curl = curl_init();  

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
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
			return [];
		}

	}

	public function getSpecificBrand(){
		if (isset($_GET["id"])){
			$id=$_GET["id"];
		};
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands/'.$id,
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
			return [];
		}
	}

	public function createBrand($name,$slug,$description){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array(
			'name' =>$name,
			'description' => $description,
			'slug' => $slug
	),
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['user_data']->token
		),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		$response = json_decode($response);
		if (isset($response->data)) {
            $_SESSION['success_message'] = "marca agregada con éxito";
            header("Location: ".BASE_PATH."brands/");
        }else{
            $_SESSION['error_message'] = "Error al agregar la marca";
            header("Location: ".BASE_PATH."brands/");
        }
	}

	public function updateBrand($id,$name,$slug,$description){
		$postFields = "name=" . urlencode($name) .
                    "&slug=" . urlencode($slug) .
                    "&description=" . urlencode($description) .
                    "&id=" . urlencode($id);

					$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
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
		$response = curl_exec($curl);
		
		curl_close($curl);
		$response = json_decode($response);
		if (isset($response->data)) {
            $_SESSION['success_message'] = "marca actualizada con éxito";
            header("Location: ".BASE_PATH."brands/");
        }else{
            $_SESSION['error_message'] = "Error al actualizar la marca";
            header("Location: ".BASE_PATH."brands/");
        }
		
	}

	public function deleteBrand($id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands/'.$id,
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
		if (isset($response->data)) {
            $_SESSION['success_message'] = "marca elimindada con éxito";
            header("Location: ".BASE_PATH."brands/");
        }else{
            $_SESSION['error_message'] = "Error al eliminar la marca";
            header("Location: ".BASE_PATH."brands/");
        }
	}
}

?>