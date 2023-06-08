@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>{{ $book->volumeInfo->title }}</h1>
            </div>
            <div class="col-3">
                <div>
                    Status:
                </div>
                <div>
                    @if ($status)
                        <div><span class="font-weight-bold">{{ $user_name }}</span> checked this out</div>
                    @else
                        <input class="" type="checkbox">
                    @endif
                </div>
            </div>
            <div class="col-3">
                @if (in_array($book->id, $listedbooks))
                    <a class="btn btn-danger m-1" href="remove/{{ $book->id }}">Remove</a>
                @else
                    <a class="btn btn-success m-1" href="add/{{ $book->id }}">Add</a>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="col-3"><img
                    src="{{ isset($book->volumeInfo->imageLinks) ? $book->volumeInfo->imageLinks->thumbnail : '' }}"
                    width="100" /></div>
            <div class="col-9">
                {{-- <h3>Author</h3>
            <ul>
            @foreach ($book->volumeInfo->authors as $author)
                <li>{{ $author }}</li>
            @endforeach
            </ul>
            <hr/>
            <h3>Publisher</h3>
            <span>{{ $book->volumeInfo->publisher }}  - {{ $book->volumeInfo->publishedDate }}</span>
            <hr/>
            <h3>ISBN</h3>
            <ul>
                @foreach ($book->volumeInfo->industryIdentifiers as $isbn)
                    <li>{{ $isbn->type }} : {{ $isbn->identifier }}</li>
                @endforeach
            </ul>
            <hr/> --}}
                <h3>Description</h3>
                <hr />
                <div>{!! $description !!} </div>
            </div>
        </div>

    </div>
@endsection
