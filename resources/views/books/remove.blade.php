@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>{{ $book->volumeInfo->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3"><img src="{{ isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : "" }}" width="100" /></div>
        <div class="col-9">
            <h3>Author</h3>
            <ul>
            @foreach($book->volumeInfo->authors as $author)
                <li>{{ $author }}</li>
            @endforeach
            </ul>
            <hr/>
            @if($error == "")
                <h3 class="text-success">Book removed successfully!</h3>
            @else
                <h3 class="text-danger">{{ $error }} !</h3>
            @endif
            <a href="/home" type="button" class="btn btn-outline-secondary p-2">Back</a>
        </div>
    </div>

</div>
@endsection
