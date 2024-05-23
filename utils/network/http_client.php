<?php
class HttpClient {
    public static function get(string $url){

    }

    public static function post(string $url, $data){
        # ref: https://stackoverflow.com/questions/5647461/how-do-i-send-a-post-request-with-php
        
        // TODO: set header from parameter
        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === false) {
            /* Handle error */
            return null;
        }
        else {
            return $result;
        }
    }
}