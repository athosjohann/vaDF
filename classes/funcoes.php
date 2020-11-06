<?php

error_reporting(0);
ini_set('display_errors', 0);

class Funcoes {

    public function ObterURLBase() {
        return 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';
    }

    public function verificaStatusPorta($ip, $porta) {
        $fp = @fsockopen($ip, $porta, $errno, $errstr, 1);

        if (!$fp) {
            return false;
        } else {
            fclose($fp);
            return true;
        }
    }

    public function formatarCnpj($cnpj_cpf) {
        if (strlen(preg_replace("/\D/", '', $cnpj_cpf)) === 11) {
            $response = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        } else {
            $response = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
        }

        return $response;
    }

    public function geraexcel($dados, $nome = 'Planilha') {
        ob_end_clean();
        //Cabecalho
        $columnHeader = implode('"	"', array_keys(current($dados)));
        $columnHeader = '"' . $columnHeader . '"';
        $setData = '';
        foreach ($dados as $linha) {
            $rowData = '';
            foreach ($linha as $value) {
                $value = str_replace('.', ',', $value);
                $value = '"' . $value . '"' . "\t";
                $rowData .= $value;
            }
            $setData .= trim($rowData) . "\n";
        }
        $conteudo = ($columnHeader) . "\n" . $setData . "\n";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream; charset=utf-8');
        header('Content-disposition: attachment; filename=' . $nome . '.xls');
        header('Content-Length: ' . strlen($conteudo));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        header('Pragma: public');
        echo $conteudo;
        exit;
    }

    public function ping($host, $timeout = 10) {
        error_reporting(0);
        ini_set('display_errors', 0);
        /* ICMP ping packet with a pre-calculated checksum */
        $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        $socket = socket_create(AF_INET, SOCK_RAW, 1);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
        socket_connect($socket, $host, null);
        $ts = microtime(true);
        socket_send($socket, $package, strLen($package), 0);
        if (socket_read($socket, 255)) {
            $result = microtime(true) - $ts;
        } else {
            $result = false;
        }
        socket_close($socket);
        return $result;
    }
    
    public function getData($data = ''){
        if($data == ''){
            $retorno = array(
                "completa"  => date('d/m/Y'),
                "dia"       => date('d'),
                "mes"       => date('m'),
                "completa"  => date('Y')
            );
        } else {
            $dataarray = explode('/', $data);
            $retorno = array(
                "completa"  => $data,
                "dia"       => $dataarray[0],
                "mes"       => $dataarray[1],
                "completa"  => $dataarray[2]
            );
        }
        return $retorno;
    }

    public function formatarDataMySQL($data = ''){
        if(!empty($data)){
            $arraydata = explode(' ',$data);
            $data = explode('-', $arraydata[0]);
            return $data[2] . '/' . $data[1] . '/' . $data[0] . ' ' . $arraydata[1];
        }
        return '';
    }

}
?>
    

