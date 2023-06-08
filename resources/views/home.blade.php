@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h1>{{ Auth::user()->name }}'s library</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-9">You have <strong>{{ $books->count() }}</strong> book/s in your library.</div>
            <div class="col-3"><button class="btn btn-primary" data-toggle="modal" data-target="#searchmodal">Add book</button>
            </div>

        </div>
        <div class="row p-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">@sortablelink('userOrder', 'Your order')</th>
                        <th scope="col">Status</th>
                        <th scope="col">Book cover</th>
                        <th scope="col">@sortablelink('title', 'Title')</th>
                        {{-- <th scope="col">@sortablelink('author', 'Author')</th> --}}
                        {{-- <th scope="col">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>


                    @foreach ($books as $book)
                        <tr>
                            <td><strong>{{ $book->userOrder }}</strong>
                                <form action="books/order" method="post">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}" />
                                    {{-- <button class="btn btn-success m-1" type="submit" name="up"
                                        value="up">Up</button>
                                    <button class="btn btn-danger m-1" type="submit" name="down"
                                        value="down">Down</button> --}}
                                </form>
                            </td>
                            <td>
                                <input class="" type="checkbox" {{ $book->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                <a class="" href="book/{{ $book->google_id }}">
                                    <img src="{{ isset($book->image) ? $book->image : '' }}" width="100" />
                                </a>
                            </td>
                            <td>
                                <h5>{{ $book->title }}</h5>
                                {{-- @if (isset($book->description))
                                    <p>{{ strlen($book->description) > 100 ? substr($book->description, 0, 100) . '...' : $book->description }}
                                    </p>
                                @endif --}}
                            </td>
                            {{-- <td>
                                <ul>
                                    @php
                                        $authors = json_decode(stripslashes($book->author));
                                        
                                    @endphp
                                    @foreach ($authors as $author)
                                        <li>{{ $author }}</li>
                                    @endforeach

                                </ul>

                            </td> --}}
                            {{-- <td>
                                <a class="btn btn-primary m-1" href="books/view/{{ $book->google_id }}">View</a>
                                <a class="btn btn-danger m-1" href="books/remove/{{ $book->google_id }}">Remove</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="modal" tabindex="-1" role="dialog" id="searchmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Search Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="book/search" method="get">
                                <input type="text" name="s" placeholder="search books" class="form-control" />
                                <button type="submit" class="btn btn-primary m-2">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
