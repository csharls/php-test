<?php
// use Dotenv\Dotenv;
use TestPhp\Common\Connector;
use TestPhp\Common\Http_Utils;
use TestPhp\Controllers\MessageController;

require_once __DIR__ . '/vendor/autoload.php';

$elements = parse_url($_SERVER['REQUEST_URI']);
$db = new Connector();

if (strpos($elements['path'], '/send')) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = $_POST;

        if ($data['to'] === '' || $data['message'] === '') {
            Http_Utils::response(400, ["error" => 'Bad Request']);
        }

        $MessageController = new MessageController($db);

        try {
            $data = $MessageController->saveMessage($data);
        } catch (\Throwable $th) {
            Http_Utils::response(500, ["error" => $th->getMessage()]);
        }
        Http_Utils::response(201, $data);
    }
}


if (strpos($elements['path'], '/latest')) {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $MessageController = new MessageController($db);
        $sortby = "";
        if (isset($_GET["sort"])) {
            $sortby = htmlspecialchars($_GET["sort"]);
            $direction = htmlspecialchars($_GET["dir"]);
        }

        try {
            $data = $MessageController->getLatestMessages($sortby, $direction);
        } catch (\Throwable $th) {
            Http_Utils::response(500, ["error" => $th->getMessage()]);
        }
        Http_Utils::response(201, $data);
    }
}
