<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('gif');
});


Route::get('/gif',function(){
    $limit = 24;
    $search = 'meme';
    $api = 'BETH2LaEADoBSW9D8JQdhyQO0xrqyyms';
    $url = 'http://api.giphy.com/v1/gifs/search?q=' . $search . '&api_key=' . $api . '&limit=' .$limit;
   

    $client = new Client();
    $result = $client->get($url);

    if($result->getStatusCode() == 200){
        $body = json_decode($result->getBody(),true);

        if($body['data'] && count($body['data'])){
            $data = $body['data'];

            return response()->json([
                'success' => 1,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'No data found'
            ]);
        }
    }else{
        return response()->json([
            'success' => 0,
            'message' => 'Server error'
        ]);
    }
});