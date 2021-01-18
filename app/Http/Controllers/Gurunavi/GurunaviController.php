<?php

namespace App\Http\Controllers\Gurunavi;

use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp;

class GurunaviController extends BaseController
{
    public function __construct()
    {
    }

    public function search()
    {

        $url = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        $card = $_POST['card'];
        $wifi = $_POST['wifi'];
        $freeWord = $_POST['freeWord'];
        $budgetCode = $_POST['budgetCode'] == "undefined" ? "" : $_POST['budgetCode'];
        $privateRoom = $_POST['privateRoom'];
        $large_area = $_POST['prefName'] ?? "Z011";

        $client = new GuzzleHttp\Client([
            'base_uri' => $url,
        ]);
        
        try {
            $responses = $client->get($url, [
                'query' => [
                    'key' => 'e132db6c8499f12d',
                    'format' => 'json',
                    'large_area' => $large_area,
                    'keyword' => $freeWord,
                    'type' => 'credit_card',
                    'count' => 100,
                    'card' => $card,
                    'wifi' => $wifi,
                    "budget" => $budgetCode,
                    "private_room" => $privateRoom,
                ]
            ])->getBody()->getContents();
        } catch (\Throwable $e) {
            throw $e;
        }

        return $responses;
    }

    public function index()
    {
        return view('gurunavi.index');
    }

}