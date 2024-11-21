<?php
include_once "config.php";

    if (isset($_POST['action'])) {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Error: El token no es válido.";
            exit;
        }
        switch ($_POST['action']) {

            case 'add_order':
                $folio=$_POST["folio"];
                $total=$_POST["total"];
                $id_paid=$_POST["is_paid"];
                $client_id=$_POST["client_id"];
                $address_id=$_POST["address_id"];
                $order_status_id=$_POST["order_status_id"];
                $payment_type_id= $_POST["payment_type_id"];
                $cupon_id= $_POST["cupon_id"];
                $presentations = [];
                if (isset($_POST['presentations'])) {
                    foreach ($_POST['presentations'] as $key => $presentation) {
                        $presentations[] = $presentation;
                    }
                }

                $productController= new ordersController();
                $productController->addOrder($folio,$total,$id_paid,$client_id,$address_id,$order_status_id,$payment_type_id,$cupon_id,$presentations);
                break;

            case "delete_order":

                $id=$_POST["id_order"];
                $user= new ordersController();
                $user->deleteOrders($id);
                break;

            case "update_order":

                $id=$_POST["id"];
                $order_status_id=$_POST["order_status_id"];

                $controller= new ordersController();
                $controller->updateOrder($id,$order_status_id);
                break;
        }
    }

    class ordersController{

        public function getAllOrders(){
            //aqui se manda el id del cliente al momento de invocarlo

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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
                // if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    $_SESSION['error_message'] = "Error al obtener usuarios";
				    header("Location: ".BASE_PATH."users/");


            }


        }
        public function getOrderBetweenDates(){
            //aqui se manda el id del cliente al momento de invocarlo
            if (isset($_GET['firs_date'])&& isset($_GET['second_date'])) {
                $first_date = $_GET['firs_date'];
                $second_date = $_GET['second_date'];
            } else {
                throw new Exception("Slug no proporcionado.");
            }
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'.$first_date.'/'.$second_date,
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
                // if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    $_SESSION['error_message'] = "Error al obtener usuarios";
				    header("Location: ".BASE_PATH."users/");


            }
        }

        public function getSpecificOrder(){
            //aqui se manda el id del cliente al momento de invocarlo
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                throw new Exception("Slug no proporcionado.");
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/details/'.$id,
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
                // if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    $_SESSION['error_message'] = "Error al obtener usuarios";
				    header("Location: ".BASE_PATH."users/");


            }
        }
        public function addOrder($folio,$total,$id_paid,$client_id,$address_id,$order_status_id,$payment_type_id,$cupon_id,$presentations){
            $postfields = array(
                'folio' => $folio,
                'total' => $total,
                'is_paid' => $id_paid,
                'client_id' => $client_id,
                'address_id' => $address_id,
                'order_status_id' => $order_status_id,
                'payment_type_id' => $payment_type_id,
                'coupon_id' => $cupon_id
            );
            foreach ($presentations as $key => $presentation) {
                $postfields["presentations[$key][id]"] = $presentation['id'];
                $postfields["presentations[$key][quantity]"] = $presentation['quantity'];
            }
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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

            $response = curl_exec($curl);
            curl_close($curl);
            $response=json_decode($response);

            if (isset($response->data)) {
				$_SESSION['success_message'] = "ornden agregado con éxito";
				header("Location: ".BASE_PATH."orders");
			}else{
                $_SESSION['error_message'] = "Error al eliminar orden";
				header("Location: ".BASE_PATH."orders");
			}
        }
        public function deleteOrders($id){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'.$id,
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
				$_SESSION['success_message'] = "ornden eliminado con éxito";
				header("Location: ".BASE_PATH."orders");
			}else{
                $_SESSION['error_message'] = "Error al eliminar la  orden";
				header("Location: ".BASE_PATH."orders");
			}

        }

        public function updateOrder($id,$order_status_id) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => 'id='.$id.'&order_status_id='.$order_status_id,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$_SESSION['user_data']->token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response);
            if (isset($response->data)) {
				$_SESSION['success_message'] = "ornden actualizada con éxito";
				header("Location: ".BASE_PATH."orders/details/".$id);
			}else{
                $_SESSION['error_message'] = "Error al actualizada la orden";
				header("Location: ".BASE_PATH."orders/details/".$id);
			}


        }
    }
?>