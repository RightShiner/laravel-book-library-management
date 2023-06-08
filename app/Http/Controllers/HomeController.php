<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;
        // $books =  Book::sortable()->where('books.user_id', '=', $userId)->paginate(5);
        $books =  Book::sortable()->paginate(5);
        // dd(compact('books'));
        return view('home',
            compact('books'));
    }
}
