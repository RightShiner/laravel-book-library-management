<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GoogleBooksController extends Controller
{
    private $books;

    public function __construct(){
        $this->middleware('auth');

    }

    public function searchBooks($search){
        $client = new Client();
        $request = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes?q='.$search);
        return json_decode($request->getBody()->read(1024000));

    }

    public function getBook($bookId){
        $client = new Client();
        try {
            $request = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes/'.$bookId);
        } catch (ClientErrorResponseException $exception) {
            $request = $exception->getResponse();
        } catch (\GuzzleHttp\Exception\ServerException $exception){
            $request = $exception->getResponse();
        }
        return json_decode($request->getBody()->read(1024000));

    }


}
