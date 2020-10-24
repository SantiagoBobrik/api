<?php

namespace App\Controllers;

use App\Models\Product;
use App\Helper\JsonResponse;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



class ProductController
{

    public function test($request = null, $response = null, array $args = null)
    {

        return JsonResponse::withJson($response, 204);
    }
}
