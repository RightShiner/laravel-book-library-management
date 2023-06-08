<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search( Request $request )
    {
        $search = $request->input('s');
        $books = new GoogleBooksController();
        $books = $books->searchBooks($search);
        $listedbooks = auth()->user()->books->pluck('google_id')->toArray();
       return view('books/search',
            compact('search','books', 'listedbooks'));
    }

    public function view( $bookId )
    {
        $books = new GoogleBooksController();
        $book = $books->getBook($bookId);
        $listedbooks = auth()->user()->books->pluck('google_id')->toArray();
        return view('books/view',
            compact('book', 'listedbooks'));
    }

    public function add( $bookId )
    {
        $error = "";
        $books = new GoogleBooksController();
        $book = $books->getBook($bookId);
        $listedbooks = auth()->user()->books->pluck('google_id')->toArray();
        if(isset($book->error)){
            $error = "Book Not found";
            return abort(404);
        }else{
            if(in_array($bookId,$listedbooks)){
                $error = "Book is in your list already";
            }else {
                $userOrder = count($listedbooks) + 1;
                $description = strlen($book->volumeInfo->description) > 100 ? substr($book->volumeInfo->description,0,100)
                    : $book->volumeInfo->description;
                auth()->user()->books()->create([
                    'google_id' => $bookId,
                    'description' => $description,
                    'title' => $book->volumeInfo->title,
                    'author' => addslashes(json_encode($book->volumeInfo->authors)),
                    'isbn' => json_encode($book->volumeInfo->industryIdentifiers),
                    'publisher' => $book->volumeInfo->publisher,
                    'image' => isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : "",
                    'userOrder' => $userOrder
                ]);

            }
            return view('books/add',
                compact('book', 'error'));

        }

    }


    public function remove( $bookId )
    {
        $error = "";
        $books = new GoogleBooksController();
        $book = $books->getBook($bookId);
        $listedbooks = auth()->user()->books->pluck('google_id')->toArray();
        if(isset($book->error)){
            $error = "Book Not found";
            return abort(404);
        }else{
            if(!in_array($bookId,$listedbooks)){
                $error = "Book is not in your list";
            }else {
                $userOrder = count($listedbooks) + 1;
                $bookToDelete = auth()->user()->books()->where('google_id', $bookId)->first();


                //reverte back User Order
                $booksToReduce = auth()->user()->books()->where('userOrder', '>', $bookToDelete->userOrder)->get();
                foreach ($booksToReduce as $bookToReduce) {
                    $newUserOrder = $bookToReduce->userOrder - 1;
                    $bookToReduce->update(['userOrder' => $newUserOrder]);
                }
                $booksToReduce = auth()->user()->books()->where('userOrder', '>', ($bookToDelete->userOrder - 1))->get();

                $bookToDelete->delete();

            }
            return view('books/remove',
                compact('book', 'error'));

        }

    }

    public function store()
    {

        $data = request()->validate([
            'book_id' => '',
            'up' => '',
            'down' => '',
        ]);
        //make sure this book belongs to this user
        $book = auth()->user()->books()->find($data['book_id']);
        if(isset($book)){
            $userbookscount = auth()->user()->books()->count();
            if(isset($data['down'])){

                $oldValue = $book->userOrder;
                $newValue = $oldValue + 1;

            }else{
                $oldValue = $book->userOrder;
                $newValue = $oldValue - 1;
            }

            //make sure newer value is still in range
            if($newValue <= $userbookscount && $newValue > 0){

                $bookToUpdate = auth()->user()->books()->where('userOrder', $newValue );
                $bookToUpdate->update(['userOrder'=>$oldValue]);
                $book->update(['userOrder'=>$newValue]);
            }
        }





        return redirect('/home?sort=userOrder&direction=asc');
    }


}
