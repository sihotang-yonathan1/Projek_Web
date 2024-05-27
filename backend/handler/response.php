<?php

function json_response(mixed $data){
    header('Content-Type: application/json');
    print_r(json_encode($data));
}