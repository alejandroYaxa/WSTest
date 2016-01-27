<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test de YaxaWs</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
<?php

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
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,0); 
        curl_setopt($curl, CURLOPT_TIMEOUT, 60); //timeout in seconds
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function getRest($url) {
        $response = file_get_contents($url);
        return $response;
    }

}

/*Casa*///$url = "localhost:8080/YaxaRepositories/yaxaws/API/V1/greenclick/importProducts";
/*Trabajo*/$url = "localhost/YaxaRepositories/yaxaws/API/V1/Yaxaco/getProducts";
$data = array(
    'category' => 6,
    'noSearch' =>array('krono_code','iatai'),
    'patternSearch' => 'video',
    'qty' => 10
    );
$a = new Calls();
$string = $a->CallAPIbyCurl("POST", $url, $data);
//echo "<pre>";
$da = json_decode($string);
$v = json_decode($da);
var_dump ($v);
//echo "</pre>";