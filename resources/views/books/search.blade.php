@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <h1>Search results for "{{ $search }}"</h1>
        </div>
    </div>
        <form method="get" action="search">
            <div class="row">
                <div class="col-9"><input class="form-control" name="s" value="{{ $search }}" /></div>
                <div class="col-3"><button class="btn btn-primary" type="submit">Search</button></div>
            </div>
        </form>
    <div class="row p-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Book cover</th>
                <th scope="col">Title</th>
                <th scope="col">Author/s</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

                @foreach($books->items as $book)
            <tr>

                <td><img src="{{ isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : "" }}" width="100" /></td>
                <td><h5>{{ $book->volumeInfo->title }}</h5>
                    @if(isset($book->volumeInfo->description))
                        <p>{{ strlen($book->volumeInfo->description) > 250 ? substr($book->volumeInfo->description,0,250)."..."
                            : $book->volumeInfo->description }}</p>
                    @endif
                </td>
                <td><ul>
                        @foreach($book->volumeInfo->authors as $author)
                            <li>{{ $author }}</li>
                        @endforeach
                    </ul>

                </td>
                <td><a class="btn btn-primary m-1" href="view/{{$book->id}}">View</a>
                    @if( in_array($book->id , $listedbooks) )
                        <a class="btn btn-danger m-1" href="remove/{{$book->id}}">Remove</a>

                    @else
                        <a class="btn btn-success m-1" href="add/{{$book->id}}">Add</a>

                    @endif


                    </td>
            </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
@endsection
