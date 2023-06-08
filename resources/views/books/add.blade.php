@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>{{ $book->volumeInfo->title ?? "Not Available"}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3"><img src="{{ isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : "" }}" width="100" /></div>
        <div class="col-9">
            @if($error == "")
                <h3 class="text-success">Book Added successfully!</h3>
            @else
                <h3 class="text-danger">{{ $error }} !</h3>
            @endif

            <a href="/home" type="button" class="btn btn-outline-secondary p-2">Back</a>
        </div>
    </div>

</div>
@endsection
