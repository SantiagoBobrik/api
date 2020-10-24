<?php


namespace Helper;

use Psr\Http\Message\ResponseInterface as Response;


class JsonResponse
{

    private static $statusCodesAxon =  [200,201,401,403,404,500,503];

    public static function withJson(
        Response $response,
        int $status = 200,
        $data = null
    ): Response {



        $status = self::validateStatusCode($status);
        $dataResponse =  self::makeResponseMessage($status,$data);
        $response->getBody()->write($dataResponse);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

    private static function makeResponseMessage($status,$data){

        switch ($status) {
            case 200:
                $message = $data ? json_encode($data)  : self::makeObjectSuccess("Success");
                return $message;
                break;
            case 201:
                $message = $data ? json_encode($data) : self::makeObjectSuccess("Created");
                return $message;
                break;
                $message = $data ? $data : "Not Found";
                return  self::makeObjectResponseMessage($message);
                break;
            case 401:
                $message = $data ? $data : "Unauthorized";
                return self::makeObjectResponseMessage($message);
                break;
            case 403:
                $message = $data ? $data : "Forbidden";
                return self::makeObjectResponseMessage($message);
                break;
            case 404:
                $message = $data ? $data : "Not Found";
                return self::makeObjectResponseMessage($message);
                break;
            case 500:
                $message = $data ? $data : "Server Error";
                return self::makeObjectResponseMessage($message);
                break;
            case 503:
                $message = $data ? $data : "Service Unavailable";
                return self::makeObjectResponseMessage($message);
                break;
        }


    }


    private static function makeObjectResponseMessage(string  $message)
    {
        return  json_encode(["error" => $message, "timestamp" => date("h:i:sa")]);
    }


    private static function makeObjectSuccess(string  $message)
    {
        return  json_encode(["message" => $message, "timestamp" => date("h:i:sa")]);
    }

    private static  function validateStatusCode($status){

        if(!in_array($status, self::$statusCodesAxon))
            return 200;

        return $status;
    }
}
