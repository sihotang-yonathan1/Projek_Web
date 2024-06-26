<?php

class RequestHandler {
    public $request;
    public $connection;
    public string $body = "";
    public string $content_type;
    public array $query;

    function __construct($request, mysqli | PDO | null $connection = null){
        # ref: https://stackoverflow.com/questions/8945879/how-to-get-body-of-a-post-in-php        
        $this->request = $request;
        $this->connection = $connection;
        $this->content_type = array_key_exists('CONTENT_TYPE', $this->request) ? $this->request['CONTENT_TYPE'] : "www-form-urlencode";
        $this->body = file_get_contents("php://input");

        if ($_SERVER['QUERY_STRING'] != ""){
            $this->query = convert_form_data_to_array($_SERVER['QUERY_STRING'], true);
        }
    }

    public function GET(){
        return null;
    }

    public function POST(){
        return null;
    }

    function PATCH(){
        return null;
    }

    function DELETE(){
        return null;
    }

    function __destruct(){
        $this->connection->close();
    }

}

function convert_form_data_to_array(string $formData, bool $convert_type = false){
    $ampersand_split = explode("&", $formData);
    $result_array = array();
    foreach ($ampersand_split as $first_split){
        $second_split = explode("=", $first_split);
        $key = $second_split[0];
        $value = $second_split[1];

        if ($convert_type){
            if (is_numeric($value)){
                $value = (int) $value;
            }
        }

        $result_array[$key] = $value;
    };
    
    return $result_array;
}

function handle_request(RequestHandler &$handler){
    $http_method = $handler->request['REQUEST_METHOD'];
    // Convert the form data into json if content-type is application/x-www-form-urlencoded
    if (preg_match('/application\/x-www-form-urlencoded/', $handler->content_type)){
        $handler->body = json_encode(
            convert_form_data_to_array(
                urldecode($handler->body))
        );
    }
    $response = null;
    match ($http_method) {
        "GET" => ($response = $handler->GET()),
        "POST" => ($response = $handler->POST()),
        "PATCH" => ($response = $handler->PATCH()),
        "DELETE" => ($response = $handler->DELETE())
    };
    return $response;
}
