<?php
include_once "config.php";

    if (isset($_POST['action'])) {
		if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch ($_POST['action']) {
            
            case 'addUser':
                $name=$_POST["name"];
                $lastName=$_POST["lastname"];
                $phone=$_POST["phone_number"];
                $rol=$_POST["role"];
                $email=$_POST["email"];
                $password=$_POST["password"];
                $createdBy= $_POST["created_by"];
                $tmp_name = $_FILES['profile_photo_file']['tmp_name']; 
                $original_name = $_FILES['profile_photo_file']['name']; 
                $mime_type = $_FILES['profile_photo_file']['type']; 
                $imagePath = new CURLFile($tmp_name, $mime_type, $original_name);
                $productController= new users();
                $productController->addUser($name,$rol,$lastName,$email,$phone,$password,$createdBy,$imagePath);
                break;

            case "deleteUser":
                $id=$_POST["id_user"];
                $user= new users();
                $user->deleteUser($id);
                break;
                
            case "updateUser":
                $id=$_POST["id"];
                $name=$_POST["name"];
                $lastName=$_POST["lastname"];
                $phone=$_POST["phone_number"];
                $rol=$_POST["role"];
                $email=$_POST["email"];
                $controller= new users();
                $controller->updateUser($name,$lastName,$phone,$rol,$email,$id);
                break;
        }
    }
    
    class users{


        public function getAllUsers(){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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
            if(isset($response->data)){
                echo "entre";
                return $response->data;
            }else{
                    return [];
                
            }

        }

        public function getUser(){
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                throw new Exception("Slug no proporcionado.");
            }
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_data']->token,
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            // var_dump($response);
            if(isset($response->data)&& is_object($response->data)){
                // if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    $_SESSION['error_message'] = "Error al obtener usuarios";
				    header("Location: ".BASE_PATH."users/");
                    
                
            }
            
            
        }

        public function addUser($name,$rol,$lastName,$email,$phone,$password,$createdBy,$imagePath){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'name' => $name,
                'lastname' => $lastName,
                'email' => $email,
                'phone_number' => $phone,
                'created_by' => $createdBy,
                'role' => $rol,
                'password' => $password,
                'profile_photo_file'=> $imagePath
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
				header("Location: ".BASE_PATH."users/");
			}else{
                $_SESSION['error_message'] = "Error al agregar usuario";
				header("Location: ".BASE_PATH."users/");
			}
        }
        public function deleteUser($id){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
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
            if (isset($response->data)) {
				$_SESSION['success_message'] = "usuario eliminado con éxito";
				header("Location: ".BASE_PATH."users/");
			}else{
                $_SESSION['error_message'] = "Error al eliminar usuario";
				header("Location: ".BASE_PATH."users/");
			}
            
        }

        public function updateUser($name,$lastName,$phone,$rol,$email,$id) {
            $postFields = "name=" . urlencode($name) .
                    "&lastname=" . urlencode($lastName) .
                    "&email=" . urlencode($email) .
                    "&phone_number=" . urlencode($phone) .
                    "&role=" . urlencode($rol) .
                    "&id=" . urlencode($id);
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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
				$_SESSION['success_message'] = "usuario actualizado con éxito";
				header("Location: ".BASE_PATH."users/details/".$id);
			}else{
                $_SESSION['error_message'] = "Error al actualizado usuario";
				header("Location: ".BASE_PATH."users/details/".$id);
			}

            
        }
    }









?>