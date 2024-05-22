<?php

class RequestHandler {
    public $request;
    public $connection;
    public string $body = "";

    function __construct($request, mysqli | PDO | null $connection = null){
        # ref: https://stackoverflow.com/questions/8945879/how-to-get-body-of-a-post-in-php
        $this->body = file_get_contents("php://input");
        
        $this->request = $request;
        $this->connection = $connection;
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

}

function handle_request(RequestHandler &$handler){
    $http_method = $handler->request['REQUEST_METHOD'];

    $response = null;
    match ($http_method) {
        "GET" => ($response = $handler->GET()),
        "POST" => ($response = $handler->POST()),
        "PATCH" => ($response = $handler->PATCH()),
        "DELETE" => ($response = $handler->DELETE())
    };
    return $response;
}
