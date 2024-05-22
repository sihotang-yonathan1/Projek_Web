<?php

class RequestHandler {
    public $request;
    public $connection;
    
    function __construct($request, mysqli | PDO | null $connection = null){
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
