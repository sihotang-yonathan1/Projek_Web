<?php

// TODO: set authentication and authorization check
class UserHandler extends RequestHandler {
    function GET(){
        # ref: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $prepared_statement = $this->connection->prepare("
            SELECT 
                nama, email, user_type
            FROM 
                user_form 
        ");
        
        $prepared_statement->execute();
        
        // Get the result
        $result = $prepared_statement->get_result();

        $response = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();

        // Close the prepared statement
        $prepared_statement->close();

        return [
            "message" => "ok",
            "data" => $response
        ];
    }
    function POST(){
        // get the request body
        $req = json_decode($this->body, true);
        
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

    function PATCH(){
        $req = json_decode($this->body, true);
        
        // TODO: only update the specified field
        $prepared_statement = $this->connection->prepare("
            UPDATE user_form SET nama = ? , password = ?, user_type = ? WHERE id = ?
        ");
        
        $prepared_statement->bind_param('ssss', ...[
            $req['nama'], $req['password'], $req['user_type'], $req['id']
        ]);
        
        $prepared_statement->execute();
        return $req;
    }

    function DELETE(){
        $req = json_decode($this->body, true);

        $prepared_statement = $this->connection->prepare("
            DELETE FROM user_form WHERE email = ?
        ");
        
        $prepared_statement->bind_param('s', $req['email']);
        
        $prepared_statement->execute();
        return $req;

    }

}
