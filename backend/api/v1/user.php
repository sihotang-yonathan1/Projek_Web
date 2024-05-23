<?php

$PROJECT_DIRECTORY = dirname(__FILE__, 4);

require_once($PROJECT_DIRECTORY . "/backend/connect.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/request.php");
require_once( $PROJECT_DIRECTORY . "/backend/handler/response.php");

require_once($PROJECT_DIRECTORY . "/backend/api/v1/_lib/user.php");


$handler = new UserHandler($_SERVER, $connection);
$response = handle_request($handler);


json_response($response);