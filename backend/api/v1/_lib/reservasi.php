<?php

$PROJECT_DIRECTORY = dirname(__FILE__, 5);

require_once($PROJECT_DIRECTORY . "/backend/handler/request.php");

class ReservasiHandler extends RequestHandler {
    function GET(){
        $max_items_number = $this->query['max_items_number'] ?? -1;

        if ($max_items_number != -1){
            $prepared_statement = $this->connection->prepare("
                SELECT 
                    id, nama, tanggal, waktu, jumlah_orang, jenis_meja, catatan_khusus, status 
                FROM reservasi_form 
                LIMIT ?
            ");
            $prepared_statement->bind_param("i", $max_items_number);
        } else {
            $prepared_statement = $this->connection->prepare("
                SELECT 
                    id, nama, tanggal, waktu, jumlah_orang, jenis_meja, catatan_khusus, status 
                FROM reservasi_form
            ");
        }

        $prepared_statement->execute();

        $result = $prepared_statement->get_result();

        $response = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $prepared_statement->close();

        return $response;
    }

    function POST(){
        $req = json_decode($this->body, true);
    
        // Set default values
        $catatan_khusus = "Belum Isi";
        $status = "Belum Konfirmasi";
    
        $prepared_statement = $this->connection->prepare("
            INSERT INTO reservasi_form 
                (nama, tanggal, waktu, jumlah_orang, jenis_meja, catatan_khusus, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
    
        $prepared_statement->bind_param(
            "sssisss", 
            $req['nama'], $req['tanggal'], $req['waktu'], $req['jumlah_orang'], $req['jenis_meja'], $catatan_khusus, $status
        );
    
        $prepared_statement->execute();
        $prepared_statement->close();
    
        return $req;
    }
    
}
