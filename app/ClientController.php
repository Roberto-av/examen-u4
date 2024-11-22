<?php
include_once "config.php";

if (isset($_POST['action'])) {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "Error: El token no es válido.";
        exit;
    }
    switch ($_POST['action']) {
        case 'addClient':
            $name=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $phone_number=$_POST["phone_number"];
            $suscribed=$_POST["suscribed"];
            $level_id=$_POST["level_id"];
            $controller = new client;
            $controller->createClient($name,$email,$password,$phone_number,$suscribed,$level_id);
            break;

        case "deleteClient":
            $id=$_POST["id_client"];
            $user= new client();
            $user->deleteClient($id);
            break;
            
        case "updateClient":
            $id = $_POST['id'];
            $name=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $phone_number=$_POST["phone_number"];
            $suscribed=$_POST["suscribed"];
            $level_id=$_POST["level_id"];

            $controller= new client;
            $controller->updateClient($name,$email,$password,$phone_number,$suscribed,$level_id,$id);
            

            break;
    }
}

    class client {


        public function getAllClients(){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
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

            if (isset($response->data)) {
				
				return $response->data;
			}else{
				$_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients");
			}


        }

        public function getSpecificClient(){
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                throw new Exception("Slug no proporcionado.");
            }


            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'.$id,
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

            if (isset($response->data)) {
				
				return $response->data;
			}else{
				$_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients");
			}

        }

        public function createClient($name,$email,$password,$phone_number,$suscribed,$level_id){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => $name,
                'email' => $email,
                'password' => $password,
                'phone_number' => $phone_number,
                'is_suscribed' => $suscribed,
                'level_id' => $level_id),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$_SESSION['user_data']->token
                ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $response=json_decode($response);

            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario agregado con éxito";
				header("Location: ".BASE_PATH."clients");
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients");
			}
        }

        public function updateClient($name,$email,$password,$phone_number,$suscribed,$level_id,$id) {

            $curl = curl_init();

            $postFields = "name=" . urlencode($name) .
            "&email=" . urlencode($email) .
            "&password=" . urlencode($password) .
            "&phone_number=" . urlencode($phone_number) .
            "&is_suscribed=" . urlencode($suscribed) .
            "&level_id=" . urlencode($level_id) .
            "&id=" . urlencode($id);;
            curl_setopt_array($curl, array(

            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
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
				header("Location: ".BASE_PATH."clients/details/".$id);
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients/details/".$id);
			}

            
        }

        public function deleteClient($id) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'.$id,
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
            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario agregado con éxito";
				header("Location: ".BASE_PATH."clients");
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."clients");
			}
            
        }
    }
?>