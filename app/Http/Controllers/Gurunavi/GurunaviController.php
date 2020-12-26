<?php

namespace App\Http\Controllers\Gurunavi;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Pagination\Paginator;

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
        $budgetCode = $_POST['budgetCode'];

        $client = new GuzzleHttp\Client([
            'base_uri' => $url,
        ]);
        $responses = $client->get($url, [
            'query' => [
                'key' => 'e132db6c8499f12d',
                'format' => 'json',
                'large_area' => 'Z011',
                'keyword' => $freeWord,
                'type' => 'credit_card',
                'count' => 100,
                'card' => $card,
                'wifi' => $wifi,
                "budget" => $budgetCode,
            ]
        ])->getBody()->getContents();


        return $responses;
    }

    public function index()
    {
        return view('gurunavi.index');
    }

}
