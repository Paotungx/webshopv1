<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/db.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function getBackend($prop = null, $pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM `backend` WHERE Settings=?");
        $stmt->execute([$prop]);
        return $stmt->fetch(PDO::FETCH_ASSOC)["value1"];
    }
    $secret = getBackend("secertkey", $pdo);
    $array = null;
    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function buildHeaders($array)
    {
        $headers = array();
        foreach ($array as $key => $value) {
            $headers[] = $key . ": " . $value;
        }
        return $headers;
    }

    function fetch($method = null, $url = null, $headers = array(), $data = null)
    {
        $fetch = curl_init();
        curl_setopt_array($fetch, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROXY => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => buildHeaders($headers),
            CURLOPT_POSTFIELDS => $data
        ]);
        $response = curl_exec($fetch);
        curl_close($fetch);
        return $response;
    }

    function webhook_discord($webhookurl, $ac) {
        $timestamp = date("c", strtotime("now"));
        $json = [
            "username" => "paotung.me",
            "tts" => false,
            "embeds" => [
                [
                    "title" => "paotung.me - logs",
                    "type" => "rich",
                    "url" => "http://paotung.me/",
                    "timestamp" => $timestamp,
                    "color" => hexdec( "3366ff" ),
                    "author" => [
                        "name" => "paotung.me",
                        "url" => "http://paotung.me/"
                    ],
                    "fields" => [
                        [
                            "name" => "HTTP_CLIENT_IP",
                            "value" => get_client_ip(),
                            "inline" => true
                        ],
                        [
                            "name" => "REMOTE_PORT",
                            "value" => $_SERVER["REMOTE_PORT"],
                            "inline" => true
                        ],
                        [
                            "name" => "METHOD",
                            "value" => $_SERVER["REQUEST_METHOD"],
                            "inline" => true
                        ],
                        [
                            "name" => "REQUEST_TIME",
                            "value" => $_SERVER["REQUEST_TIME"],
                            "inline" => true
                        ],
                        [
                            "name" => "REQUEST_URI",
                            "value" => $_SERVER["REQUEST_URI"],
                            "inline" => true
                        ],
                        [
                            "name" => "HTTP_HOST",
                            "value" => $_SERVER["HTTP_HOST"],
                            "inline" => true
                        ]
                    ]
                ]
            ]

        ];
        foreach ($ac as $key => $value) {
            // print_r($value);
            array_push($json["embeds"][0]["fields"], [
                "name" => $value["name"],
                "value" => $value["value"],
                "inline" => false
            ]);
        }
        // return
        $json_data = json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

        $ch = curl_init( $webhookurl );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );
        curl_close( $ch );
    }