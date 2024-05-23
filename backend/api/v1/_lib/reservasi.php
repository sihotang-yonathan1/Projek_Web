<?php

$PROJECT_DIRECTORY = dirname(__FILE__, 5);

require_once($PROJECT_DIRECTORY . "/backend/handler/request.php");

class ReservasiHandler extends RequestHandler {
    function GET(){
        # ref: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $prepared_statement = $this->connection->prepare("
            SELECT 
                nama, tanggal, waktu, jumlah_orang, jenis_meja 
            FROM reservasi_form
        ");
        
        $prepared_statement->execute();

        $result = $prepared_statement->get_result();

        $response = $result->fetch_all(MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $response;
    }
}