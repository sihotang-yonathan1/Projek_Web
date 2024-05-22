<?php
session_start();

$PROJECT_DIRECTORY = dirname(__FILE__, 4);

require_once($PROJECT_DIRECTORY . "/backend/connect.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/request.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/response.php");

class LoginHandler extends RequestHandler {
    function POST(){
        // get the request body
        $req = json_decode($this->body, true);
        
        # ref: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $prepared_statement = $this->connection->prepare("
            SELECT id, nama, user_type FROM user_form WHERE email=? AND password=?
        ");
        
        $prepared_statement->bind_param('ss', ...[
            $req['email'], $req['password']
        ]);
        
        $prepared_statement->execute();

        $result = $prepared_statement->get_result();

        if ($result->num_rows == 1){
            $temp_result = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $temp_result;
        }
        return $req;
    }
}


$handler = new LoginHandler($_SERVER, $connection);
$response = handle_request($handler);


json_response($response);