<?php

date_default_timezone_set('America/Sao_Paulo');

class ServicosAPI{        
    
    private $api_url;
    private $api_token;

    function __construct($siteURL, $tokenUsuario) {        
        $this->api_url = $siteURL."api/";
        $this->api_token = $tokenUsuario;
    }
    
    public function POST($endpoint, $arrayDados) {

        $ch = curl_init($this->api_url.$endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(                
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->api_token        
            ),
            CURLOPT_POSTFIELDS => json_encode($arrayDados)
        ));

        curl_setopt($ch, CURLOPT_ENCODING, "");
        $response = curl_exec($ch);
        
        if ($response === FALSE) {
            json_encode( array( "sucesso" => false, "mensagem" => "Não foi possível estabelecer comunicação com o servidor. (".curl_error($ch).")") );            
            exit;
        }else{                       
            return $this->ConverterJSON($response);
        }               
    }
    
    public function POSTWithFiles($endpoint, $json, $arquivo) {
        $ch = curl_init($this->api_url.$endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(                
                'Content-Type: multipart/form-data',
                'Authorization: Bearer ' . $this->api_token        
            )
        ));
        if (function_exists('curl_file_create')) { // php 5.5+
            $cFile = curl_file_create($arquivo['arquivo']);
        } else { // 
            $cFile = '@' . realpath($arquivo['arquivo']);
        }
        $json['fileupload'] = $cFile;
        $json['name'] = $arquivo['arquivooriginal'];
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        // Send the request
        $response = curl_exec($ch);
                
        if ($response === FALSE) {
            json_encode(array( "sucesso" => false, "mensagem" => "Não foi possível estabelecer comunicação com o servidor. (".curl_error($ch).")") );
            exit;
        }else{                       
            return $this->ConverterJSON($response);
        }  
    }
    
    
    public function GET($endpoint) {
        $ch = curl_init($this->api_url.$endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(                
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->api_token        
            )
        ));

        curl_setopt($ch, CURLOPT_ENCODING, "");
        
        $response = curl_exec($ch);
        
        if ($response === FALSE) {
            json_encode(array( "sucesso" => false, "mensagem" => "Não foi possível estabelecer comunicação com o servidor. (".curl_error($ch).")") );
            exit;
        }else{                       
            return $this->ConverterJSON($response);
        }  
    }

    private function ConverterJSON($string)
    {
        // decode the JSON data
        $result = json_decode($string, true);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
           return array("sucesso" => false, "mensagem" => $error, "dados" => $string);
        }
        // everything is OK
        return $result;
    }
    
    
}