<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function list()
    {
        $client = new Client();

        try {
            $response = $client->get('http://localhost:5000/list_provinsi');
            $statusCode = $response->getStatusCode(); // 200
            $body = $response->getBody()->getContents(); // JSON data

            $product = json_decode($body, false); 

            return response()->json(['data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
