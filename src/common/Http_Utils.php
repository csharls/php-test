<?php

namespace TestPhp\Common;

class Http_Utils
{

    public  static function response(int $code, array $data): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
