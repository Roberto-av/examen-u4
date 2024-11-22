<?php
include_once "config.php";

    if (isset($_POST['action'])) {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch ($_POST['action']) {
            
            case 'add_address':
                //pasa lo mismo de presentaciones, ocupa del id del cliente,
                //te dejo las dos formas
                $idClient=$_POST["id"];
                $name=$_POST["name"];
                $lastName=$_POST["last_name"];
                $street=$_POST["street_and_use_number"];
                $postal_code=$_POST["postal_code"];
                $city=$_POST["city"];
                $province=$_POST["province"];
                $phone_number= $_POST["phone_number"];
                $billing_address= $_POST["billing_address"];
                
                
                $productController= new addressController();
                $productController->addAddress($idClient,$name,$lastName,$street,$postal_code,$city,$province,$phone_number,$billing_address);
                break;

            case "deleteAddress":
                //mismo que en presentation, solo que aqui mando el del cliente solo para reubicar en los detalles del cliente
                $id=$_POST["id_user"];
                $id_address=$_POST["id_address"];
                $user= new addressController();
                $user->deleteAddress($idClient,$id_address);
                break;
                
            case "updateAddress":
                //pasa lo mismo de presentaciones, ocupa del id del cliente y id del address,
                //te dejo las dos formas
                $idClient = $_POST['id'];
                $id_address = $_POST['id_address'];
                $name=$_POST["name"];
                $lastName=$_POST["last_name"];
                $street=$_POST["street_and_use_number"];
                $postal_code=$_POST["postal_code"];
                $city=$_POST["city"];
                $province=$_POST["province"];
                $phone_number= $_POST["phone_number"];
                $billing_address= $_POST["billing_address"];
                $controller= new addressController();
                $controller->updateAddress($idClient,$id_address,$name,$lastName,$street,$postal_code,$city,$province,$phone_number,$billing_address);
                break;
        }
    }
    
    class addressController{

        public function getAddressByClient(){
            //aqui se manda el id del cliente al momento de invocarlo
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                throw new Exception("Slug no proporcionado.");
            }
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/'.$id,
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
            $response=json_decode($response);
            if(isset($response->data)&& is_object($response->data)){
                // if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    $_SESSION['error_message'] = "Error al obtener usuarios";
				    header("Location: ".BASE_PATH."users/");
                    
                
            }
            
            
        }

        public function addAddress($idClient,$name,$lastName,$street,$postal_code,$city,$province,$phone_number,$billing_address){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'first_name' => $name,
                'last_name' => $lastName,
                'street_and_use_number' => $street,
                'postal_code' => $postal_code,
                'city' => $city,
                'province' => $province,
                'phone_number' => $phone_number,
                'is_billing_address' => $billing_address,
                'client_id' => $idClient
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_data']->token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario agregado con éxito";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}
        }
        public function deleteAddress($idClient,$id_address){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/'.$id_address,
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

            $response=json_decode($response);
            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario agregado con éxito";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}
            
        }

        public function updateAddress($idClient,$id_address,$name,$lastName,$street,$postal_code,$city,$province,$phone_number,$billing_address) {
            $postFields = "first_name=" . urlencode($name) .
                    "&last_name=" . urlencode($lastName) .
                    "&street_and_use_number=" . urlencode($street) .
                    "&postal_code=" . urlencode($postal_code) .
                    "&city=" . urlencode($city) .
                    "&province=" . urlencode($province) .
                    "&phone_number=" . urlencode($phone_number) .
                    "&is_billing_address=" . urlencode($billing_address) .
                    "&client_id=" . urlencode($idClient) .                    
                    "&id=" . urlencode($id_address);
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
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
            $response=json_decode($response);
            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario agregado con éxito";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients/details/".$idClient);
			}

            
        }
    }









?>