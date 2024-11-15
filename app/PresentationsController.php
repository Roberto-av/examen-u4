<?php
    include_once "config.php";
    var_dump($_POST);
    if(isset($_POST["action"])){
        // if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        //     echo "Error: El token no es válido.";
        //     exit;
        // }
        switch($_POST["action"]){
            case "add_presentation":{
                //ocupa el id del producto mandalos en forma post igual si no 
                //dejara que se puedan recibir por el url

                if (isset($_GET['id'])) {
                    $id_producto = $_GET['id'];
                } else {
                    throw new Exception("Slug no proporcionado.");
                }
                // $id_producto=$_POST["product_id"];
                $description=$_POST["description"];
                $code=$_POST["code"];
                $peso=$_POST["weight"];
                $estado=$_POST["status"];
                $tmp_name = $_FILES['cover']['tmp_name']; 
                $original_name = $_FILES['cover']['name']; 
                $mime_type = $_FILES['cover']['type'];
                $imagePath = new CURLFile($tmp_name, $mime_type, $original_name);
                $stock=$_POST["stock"];
                $stock_min=$_POST["stock_min"];
                $stock_max=$_POST["stock_max"];
                $amount=$_POST["amount"];
                $productController= new controllerPresentations();
                $productController->createPresentation($id_producto,$description,$code,$peso,$estado,$imagePath,$stock,$stock_min,$stock_max,$amount);
                break;
                
            }
            case "update_presentation":{
                //ocupa el id del producto y el id de la presentacion para poder actualizar los datos, mandalos en forma post igual si no 
                //dejara que se puedan recibir por el url
                
                // if (isset($_GET['id'])) {
                //     $id_producto = $_GET['id'];
                // } else {
                //     throw new Exception("Slug no proporcionado.");
                // }
                // if (isset($_GET['id_presentacion'])) {
                //     $id_presentacion = $_GET['id_presentacion'];
                // } else {
                //     throw new Exception("Slug no proporcionado.");
                // }
                $id_producto=$_POST["product_id"];
                $id_presentacion=$_POST["presentation_id"];
                $description=$_POST["description"];
                $code=$_POST["code"];
                $peso=$_POST["weight"];
                $estado=$_POST["status"];
                $stock=$_POST["stock"];
                $stock_min=$_POST["stock_min"];
                $stock_max=$_POST["stock_max"];
                $amount=$_POST["amount"];
                $productController= new controllerPresentations();
                $productController->updatePresentation($id_producto,$description,$code,$peso,$estado,$stock,$stock_min,$stock_max,$amount,$id_presentacion);
                break;
            }
            case "delete_presentation":{
                if (isset($_GET['id'])) {
                    $id_producto = $_GET['id'];
                } else {
                    throw new Exception("Slug no proporcionado.");
                }
                $id=$_POST["id_presentation"];
                
                $productController= new controllerPresentations();
                $productController->delete($id,$id_producto);
                break;
            }
            case "update_only_price":{
                //id de la presentacion para poder actualizar los datos, mandalos en forma post igual si no 
                //dejara que se puedan recibir por el url

                if (isset($_GET['id'])) {
                    $id_producto = $_GET['id'];
                } else {
                    throw new Exception("Slug no proporcionado.");
                }

                if (isset($_GET['id_presentacion'])) {
                    $id_presentacion = $_GET['id_presentacion'];
                } else {
                    throw new Exception("Slug no proporcionado.");
                }
                // $id_presentacion = $_POST['id_presentacion'];
                $amount=$_POST["amount"];

                $presentation=new controllerPresentations();
                $presentation->updatePrice($id_presentacion,$amount,$id_producto);
                break;
            }

        }
    };
    class controllerPresentations{
    public function getPresentationsProducts() {
        // esta funcion trae todas las presentaciones de un solo producto por el id del producto
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            throw new Exception("Slug no proporcionado.");
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/product/'.$id,
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

        if (isset($response->data) && is_array($response->data)) {
            return $response->data;
        }

        return [];


        
    }
    public function getSpecificPresentation() {
        // esta funcion trae una presentacion en especifico por su id de presentacion
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            throw new Exception("Slug no proporcionado.");
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://crud.jonathansoto.mx/api/presentations/".$id,
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

        if (empty($response)) {
            throw new Exception("La respuesta está vacía. Verifica la conexión a la API.");
        }


        if (isset($response->data)) {
            return $response->data; 
        } else {
            if (isset($response->message)) {
                throw new Exception("Error de API: " . $response->message);
            } else {
                throw new Exception("No se encontraron datos para el producto.");
            }
        }

        return [];
        
    }

    public function createPresentation($id_producto,$description,$code,$peso,$estado,$imagePath,$stock,$stock_min,$stock_max,$amount){
        // para crear la presentacion ocupo que mandes por el link el id del producto
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'description' => $description,
            'code' => $code,
            'weight_in_grams' => $peso,
            'status' => $estado,
            'cover'=> $imagePath,
            'stock' => $stock,
            'stock_min' => $stock_min,
            'stock_max' => $stock_max,
            'product_id' => $id_producto,
            'amount' => $amount
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
                header("Location: ".BASE_PATH."products/details/".$id_producto);
            } else {
                $_SESSION['error_message'] = "Error al agregar producto";
                header("Location: ".BASE_PATH."products/details/".$id_producto);
            }
        
    }

    public function updatePresentation($id_producto,$description,$code,$peso,$estado,$stock,$stock_min,$stock_max,$amount,$id_presentacion){
        $postFields = "description=" . urlencode($description) .
                    "&code=" . urlencode($code) .
                    "&weight_in_grams". urldecode($peso).
                    "&status=" . urlencode($estado) .
                    "&stock=" . urlencode($stock) .
                    "&stock_min=" . urlencode($stock_min) .
                    "&stock_max=" . urlencode($stock_max) .
                    "&product_id=" . urlencode($id_producto) .
                    "&id=".urldecode($id_presentacion).
                    "&amount=" . urlencode($amount);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
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
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        } else {
            $_SESSION['error_message'] = "Error al actualizar producto";
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        }
        

    
    }

    public function updatePrice($id_presentacion,$amount,$id_producto){
        $postFields = 
                    "id=".urldecode($id_presentacion).
                    "&amount=" . urlencode($amount);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/set_new_price',
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
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        } else {
            $_SESSION['error_message'] = "Error al actualizar producto";
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        }
        

    
    }

    public function delete($id,$id_producto){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'.$id,
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
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        } else {
            $_SESSION['error_message'] = "Error al eliminar producto";
            header("Location: ".BASE_PATH."products/details/".$id_producto);
        }
    }
}


?>