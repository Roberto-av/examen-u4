<?php 
	session_start();


	if (isset($_POST['action'])) {
		
		switch ($_POST['action']) {
			
			case 'login':
				
				$correo =  $_POST['email'];
				$contrasena = $_POST['password'];

				$authController = new AuthController();

				$authController->access($correo,$contrasena);

			break; 
			case "logout":
				$correo= $_SESSION['user_data']->email;
				$authController = new AuthController();

				$authController->logout($correo);
				break;
		}
	}

	class AuthController
	{

		public function access($correo,$contrasena)
		{
			
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'email' => $correo,
				'password' => $contrasena
			),
			));

			$response = curl_exec($curl); 
			curl_close($curl); 
			$response = json_decode($response);


			if (isset($response->data)  && is_object($response->data)) {
				
				$token = $this->token();
				$_SESSION['user_data'] = $response->data;
				$_SESSION['token'] = $token;
				header("Location: ../home");
			}else{
				header("Location: ../index.php");
			}

		}

		public function token ($leng=40) {
            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $token = "";
            
            for($i=0; $i<$leng; $i++){
                $token .= $cadena[rand(0,35)];
            }
            return $token;
        }

		public function logout($correo)
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/logout',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('email' => $_SESSION['user_data']->email),
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '.$_SESSION['user_data']->token
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			$response=json_decode($response);
			if (isset($response)&& $response->code>0) {
				$_SESSION = array();
				if (ini_get("session.use_cookies")) {
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000,
						$params["path"], $params["domain"],
						$params["secure"], $params["httponly"]
					);
				};
				session_destroy();
				header("Location: ../index.php");
			}else{
				header("Location: ../views/home?status=error");
			}



		}


	}










?>