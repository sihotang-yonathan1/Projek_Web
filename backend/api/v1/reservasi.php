<?php

session_start();

$PROJECT_DIRECTORY = dirname(__FILE__, 4);

require_once($PROJECT_DIRECTORY . "/backend/connect.php");
require_once($PROJECT_DIRECTORY . "/backend/handler/request.php");
require_once($PROJECT_DIRECTORY . "/backend/handler/response.php");
require_once($PROJECT_DIRECTORY . "/backend/api/v1/_lib/reservasi.php");

$handler = new ReservasiHandler($_SERVER, $connection);
$response = handle_request($handler);

json_response($response);