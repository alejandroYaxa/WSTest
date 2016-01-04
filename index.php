<?php

$url = "http://localhost/YaxaRepositories/yaxaws/API/V1/test/testobjeto";

class Calls {

    public function CallAPIbyCurl($method, $url, $data = false) {
        $curl = curl_init();
        $query = null;
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    $query = (is_array($data)) ? http_build_query($data, '', '&') : $data;
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
                }

                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function getRest($url) {
        $response = file_get_contents($url);
        return $response;
    }

}

class Prueba {

    private $tipo = "Este es un objeto";

    public function pruebaObjeto() {
        return $this->tipo;
    }

}

$miObjeto = new Prueba();

$miArray = array("name" => $miObjeto->pruebaObjeto(), "age" => 25);
$miClase = new Calls();
$a = $miClase->CallAPIbyCurl("POST", $url, $miArray);
echo "<pre>";
var_dump(json_decode($a));
echo "</pre>";
echo "<pre>";
echo(($miObjeto->pruebaObjeto()));
echo "</pre>";
