<?php

$PROJECT_DIRECTORY = dirname(__FILE__, 5);

require_once($PROJECT_DIRECTORY . "/backend/handler/request.php");

class ReservasiHandler extends RequestHandler {
    function GET(){
        # ref: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $max_items_number = $this->query['max_items_number'] ?? -1;

        $prepared_statement = $this->connection->prepare("
            SELECT 
                nama, tanggal, waktu, jumlah_orang, jenis_meja 
            FROM reservasi_form
        ");
        
        if ($max_items_number != -1){
            $prepared_statement = $this->connection->prepare("
                SELECT 
                    nama, tanggal, waktu, jumlah_orang, jenis_meja 
                FROM reservasi_form LIMIT ?
            ");
            $prepared_statement->bind_param("i", $max_items_number);
        }

        $prepared_statement->execute();

        $result = $prepared_statement->get_result();

        $response = $result->fetch_all(MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $response;
    }

    function POST(){
        $req = json_decode($this->body, true);

        $prepared_statement = $this->connection->prepare("
            INSERT INTO reservasi_form 
                (nama, tanggal, waktu, jumlah_orang, jenis_meja) 
            VALUES (?, ?, ?, ?, ?)
        ");
        

        $prepared_statement->bind_param(
            "sssis", 
            $req['nama'], $req['tanggal'], $req['waktu'], $req['jumlah_orang'], $req['jenis_meja']);
        
        $prepared_statement->execute();
        return $req;
        }
}