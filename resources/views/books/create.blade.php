@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row p-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Book cover</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td><img src="{{ isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : "" }}" width="100" /></td>
                <td><h5>{{ $book->volumeInfo->title }}</h5>
                    @if(isset($book->volumeInfo->description))
                        <p>{{ strlen($book->volumeInfo->description) > 250 ? substr($book->volumeInfo->description,0,250)."..."
                            : $book->volumeInfo->description }}</p>
                    @endif
                </td>
                <td><a class="btn btn-primary m-1" href="view/{{$book->id}}">View</a>
                    @if( in_array($book->id , $listedbooks) )
                        <a class="btn btn-danger m-1" href="remove/{{$book->id}}">Remove</a>

                    @else
                        <a class="btn btn-success m-1" href="add/{{$book->id}}">Add</a>
                    @endif
                    </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection
