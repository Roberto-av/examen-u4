<?php
    session_start();
    class users{

        public function getUser($id){
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
            if(isset($response->data)&& is_object($response->data)){
                if($response->data->email==$_SESSION['user_data']->email){
                    return $response->data;
                }else{
                    header("Location: ../views/products?status=corre_incorrecto");
                }
            }
            
            
        }
    }









?>