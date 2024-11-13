<?php 
include_once "config.php";
var_dump($_POST);
    if(isset($_POST["action"])){
        // if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        //     echo "Error: El token no es válido.";
        //     exit;
        // }
        switch($_POST["action"]){
            case "add_categories":{
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $productController= new categoriesController();
                $productController->createCategory($name,$slug,$description);
                break;
                
            }
            case "update_category":{
                
                $id=$_POST["id"];
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $productController= new categoriesController();
                $productController->updateCategory($id,$name,$slug,$description);
                break;
            }
            case "delete_category":{
                $id=$_POST["id"];
                
                $productController= new categoriesController();
                $productController->deleteCategory($id);
                break;
            }

        }
    };
class categoriesController {
	
	public function getAllCategories()
	{
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
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

	public function getSpecificCategory(){
		if (isset($_GET["id"])){
			$id=$_GET["id"];
		};
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories/'.$id,
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

	public function createCategory($name,$slug,$description){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
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
		if (isset($response->data)) {
            $_SESSION['success_message'] = "categoria agregada con éxito";
            header("Location: ".BASE_PATH."categories/");
        }else{
            $_SESSION['error_message'] = "Error al agregar categoria";
            header("Location: ".BASE_PATH."categories/");
        }
	}

	public function updateCategory($id,$name,$slug,$description){
		$postFields ="&id=" . urlencode($id).
                    "&name=" . urlencode($name) .
                    "&slug=" . urlencode($slug) .
                    "&description=" . urlencode($description);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
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
        
        var_dump($response);
        curl_close($curl);
		$response = json_decode($response);
		if (isset($response->data)) {
            $_SESSION['success_message'] = "categoria actualizada con éxito";
            header("Location: ".BASE_PATH."categories/");
        }else{
            $_SESSION['error_message'] = "Error al actualizar categoria";
            header("Location: ".BASE_PATH."categories/");
        }
		
	}

	public function deleteCategory($id){
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories/'.$id,
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
            $_SESSION['success_message'] = "categoria eliminada con éxito";
            header("Location: ".BASE_PATH."categories/");
        }else{
            $_SESSION['error_message'] = "Error al eliminar categoria";
            header("Location: ".BASE_PATH."categories/");
        }
	}
}

?>