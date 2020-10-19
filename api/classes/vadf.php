<?php

date_default_timezone_set('America/Sao_Paulo');

class VaDFAPI{
    
    public $api_url = "";
    private $token;
    
    function __construct($apiurl, $token = '') {
        $this->api_url = $apiurl;
        $this->token = $token;    
    }
    
    public function POST($endpoint, $arrayDados) {
        $ch = curl_init($this->api_url.$endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(                
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token        
            ),
            CURLOPT_POSTFIELDS => json_encode($arrayDados)
        ));
        
        curl_setopt($ch, CURLOPT_ENCODING, "");

        // Send the request
        $response = curl_exec($ch);
        
        // Check for errors
        if ($response === FALSE) {
            $error = array(
                "sucesso" => false,
                "error" => "Não foi possível estabelecer comunicação com o servidor. (".curl_error($ch).")");

            echo json_encode($error);
            exit;
        }else{
           $response = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);
        }
      
        // Decode the response
        $retorno = json_decode($response, true);               
        
        if (is_null($retorno) || ($retorno === false)){
            $retorno = array(
                "sucesso" => false,
                "error" => $response);
        }
        
        return $retorno;
    }
    
    
 public function GET($endpoint) {        
       $ch = curl_init($this->api_url.$endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(                
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token        
            )
        ));             

        curl_setopt($ch, CURLOPT_ENCODING, "");

        // Send the request
        $response = curl_exec($ch);
        
        // Check for errors
        if ($response === FALSE) {
            $error = array(
                "sucesso" => false,
                "error" => "Não foi possível estabelecer comunicação com o servidor. (".curl_error($ch).")");
            
            return $error;
            
        }else{
           $response = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);           
        }     
              
        // Decode the response
        $retorno = json_decode($response, true);               
        
        return $retorno;
    }
    
}