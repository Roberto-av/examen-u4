<?php
    session_start();
    
    if (isset($_POST['action'])) {
		
        switch ($_POST['action']) {
            
            case 'addUser':
                $name=$_POST["name"];
                $lastName=$_POST["lastname"];
                $phone=$_POST["phone"];
                $rol=$_POST["rol"];
                $email=$_POST["email"];
                $password=$_POST["password"];
                $createdBy="jesus alberto";
                $target_path = "/Applications/MAMP/htdocs/examen-u4/assets/images"; 
                $imagePath = $target_path . basename($_FILES['profile_photo_file']['name']); 
                if (isset($_FILES['profile_photo_file']) && $_FILES['profile_photo_file']['error'] === UPLOAD_ERR_OK) {
                    if (move_uploaded_file($_FILES['profile_photo_file']['tmp_name'], $imagePath)) {
                    } else {
                        echo "Ha ocurrido un error al mover el archivo.";
                    }
                } else {
                    echo "No se ha subido ningún archivo o hubo un error en la subida.";
                }
                $productController= new users();
                $productController->addUser($name,$lastName,$description,$email,$password,$createdBy,$imagePath);
                break;

            case "deleteUser":
                $id=$_POST["id_user"];
                $user= new users();
                $user->deleteUser($id);
                break;
                
            case "updateUser":
                if (isset($_GET["id"])){
                    $id=$_GET["id"];
                };
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
				'Authorization: Bearer 638|0TLiNi0TT1K1BYRJSWUKVBFTLDjvpegYM7Td9B7v'

                // 'Authorization: Bearer '.$_SESSION['user_data']->token

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
                    header("Location: ../views/products?status=corre_incorrecto");
                
            }
            
            
        }

        public function addUser($name,$lastName,$phone,$email,$password,$createdBy,$imagePath){
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
                'profile_photo_file'=> new CURLFILE($imagePath)
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 638|0TLiNi0TT1K1BYRJSWUKVBFTLDjvpegYM7Td9B7v'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            if (isset($response->data)) {
				
				header("Location: index.php");
			}else{
				header("Location: .index.php?status=error");
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
                'Authorization: Bearer 638|0TLiNi0TT1K1BYRJSWUKVBFTLDjvpegYM7Td9B7v'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            if (isset($response->data)) {
				
				header("Location: ../pruebas-back/index.php");
			}else{
				header("Location: ../pruebas-back/index.php?status=error");
			}
            
        }

        public function updateUser($name,$lastName,$phone,$rol,$email,$id) {
            $postFields = "name=" . urlencode($name) .
                    "&lastname=" . urlencode($lastname) .
                    "&email=" . urlencode($email) .
                    "&phone_number=" . urlencode($phone_number) .
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
                'Authorization: Bearer 638|0TLiNi0TT1K1BYRJSWUKVBFTLDjvpegYM7Td9B7v'

            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            var_dump($response);
            if (isset($response->data)) {
				
				header("Location: ../pruebas-back/index.php");
			}else{
				header("Location: ../pruebas-back/index.php?status=error");
			}

            
        }
    }









?>