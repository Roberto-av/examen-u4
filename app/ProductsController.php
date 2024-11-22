<?php
    include_once "config.php";
    if(isset($_POST["action"])){
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch($_POST["action"]){
            case "add_product":{
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $features=$_POST["features"];
                $idBrand=$_POST["id_brand"];
                $tmp_name = $_FILES['cover']['tmp_name']; 
                $original_name = $_FILES['cover']['name']; 
                $mime_type = $_FILES['cover']['type'];
                $imagePath = new CURLFile($tmp_name, $mime_type, $original_name);
                $categories = [];
                if (isset($_POST['categories'])) {
                    foreach ($_POST['categories'] as $key => $category) {
                        $categories[] = $category;  
                    }
                }
                $tags = [];
                if (isset($_POST['tags'])) {
                    foreach ($_POST['tags'] as $key => $tag) {
                        $tags[] = $tag; 
                    }
                }

                
                $productController= new controllerProducts();
                $productController->postProduct($name,$slug,$description,$features,$idBrand,$imagePath,$categories,$tags);
                break;
                
            }
            case "update_product":{
                $id=$_POST["id"];
                $name=$_POST["name"];
                $slug=$_POST["slug"];
                $description=$_POST["description"];
                $features=$_POST["features"];
                $tmp_name = $_FILES['cover']['tmp_name']; 
                $original_name = $_FILES['cover']['name']; 
                $mime_type = $_FILES['cover']['type'];
                $imagePath = new CURLFile($tmp_name, $mime_type, $original_name);
                $categories = [];
                if (isset($_POST['categories'])) {
                    foreach ($_POST['categories'] as $key => $category) {
                        $categories[] = $category;  
                    }
                }
                $tags = [];
                if (isset($_POST['tags'])) {
                    foreach ($_POST['tags'] as $key => $tag) {
                        $tags[] = $tag; 
                    }
                }
                $productController= new controllerProducts();
                $productController->updateProduct($id,$name,$slug,$description,$features,$categories,$tags);
                break;
            }
            case "delete_product":{
                $id=$_POST["id_product"];
                
                $productController= new controllerProducts();
                $productController->delete($id);
                break;
            }

        }
    };
    class controllerProducts{
    public function getProducts() {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
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

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            throw new Exception("Error en la solicitud: " . $error_msg);
        }

        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data) && is_array($response->data)) {
            return $response->data;
        }

        return [];


        
    }
    public function getDetailProduct() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            throw new Exception("Slug no proporcionado.");
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://crud.jonathansoto.mx/api/products/$id",
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
        $response=json_decode($response);



        if (isset($response->data)) {
            return $response->data; 
        } else {
            if (isset($response->message)) {
                header("Location: ".BASE_PATH."products/");
            } else {
                header("Location: ".BASE_PATH."products/");
            }
        }

        return [];
        
    }

    public function postProduct($name,$slug,$description,$features,$idBrand,$imagePath,$categories,$tags){

        $postfields = array(
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $idBrand,
            'cover' => $imagePath 
        );
        foreach ($categories as $key => $category) {
            $postfields["categories[$key]"] = $category;
        }
        
        foreach ($tags as $key => $tag) {
            $postfields["tags[$key]"] = $tag;
        }
        $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$_SESSION['user_data']->token
                ),
            ));
            
            // Ejecuta la solicitud cURL
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            if (isset($response->code) && $response->code > 0) {
                $_SESSION['success_message'] = "producto agregado con éxito";
                header("Location: ".BASE_PATH."products/");
            } else {
                $_SESSION['error_message'] = "Error al agregar producto";
                header("Location: ".BASE_PATH."products/");
            }
        
    }

    public function updateProduct($id,$name,$slug,$description,$features,$categories,$tags){
        $postFields = "name=" . urlencode($name) .
                    "&slug=" . urlencode($slug) .
                    "&description=" . urlencode($description) .
                    "&features=" . urlencode($features) .
                    "&id=" . urlencode($id);
        foreach ($categories as $key => $category) {
            $postFields .= "&categories[" . urlencode($key) . "]=" . urlencode($category);
        }
        
        foreach ($tags as $key => $tag) {
            $postFields .= "&tags[" . urlencode($key) . "]=" . urlencode($tag);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
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
            $_SESSION['success_message'] = "producto actualizado con éxito";
            header("Location: ".BASE_PATH."products/");
        } else {
            $_SESSION['error_message'] = "Error al actualizar producto";
            header("Location: ".BASE_PATH."products/");
        }
        

    
    }

    public function delete($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$id,
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
        $response=json_decode($response);
        if (isset($response->code) && $response->code > 0) {
            $_SESSION['success_message'] = "producto eliminado con éxito";
            header("Location: ".BASE_PATH."products/");
        } else {
            $_SESSION['error_message'] = "Error al eliminar producto";
            header("Location: ".BASE_PATH."products/");
        }
    }
}


?>