<?php

$PROJECT_DIRECTORY = dirname(__FILE__, 4);

require_once($PROJECT_DIRECTORY . "/backend/connect.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/request.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/response.php");

$http_method = $_SERVER['REQUEST_METHOD'];

class UserHandler extends RequestHandler {
    function POST(){
        // get the request body
        $req = json_decode(file_get_contents('php://input'), true);
        
        # ref: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $prepared_statement = $this->connection->prepare("
            INSERT INTO user_form (nama, email, password, user_type)
            VALUE (?, ?, ?, ?)
        ");
        
        $prepared_statement->bind_param('ssss', ...[
            $req['nama'], $req['email'], $req['password'], $req['user_type']
        ]);
        
        $prepared_statement->execute();
        return $req;
    }
}


$handler = new UserHandler($_SERVER, $connection);
$response = handle_request($handler);


json_response($response);