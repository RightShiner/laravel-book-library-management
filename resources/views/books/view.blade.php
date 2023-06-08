@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 id="book_title">{{ $book->volumeInfo->title }}</h1>
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
                    <button class="btn btn-success" id="save-button" onclick="save()">
                        Save status
                    </button>
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

                <h3>Description</h3>
                <hr />
                <div>{!! $description !!} </div>
            </div>
        </div>

    </div>
    {{-- <script>
        function save() {
            var checkboxes = document.querySelectorAll('input[type=checkbox]');
            var checkboxStatuses = Array.from(checkboxes).map((checkbox) => {
                return checkbox.checked ? '1' : '0';
            });
            var book_title = document.getElementById("book_title").innerHTML;

            // var data = [
            //     username, checkboxStatuses, bookIdStatuses
            // ];
            console.log(book_title);
            // url = window.location.origin + "/book/savestatus";
            // var xhr = new XMLHttpRequest();
            // xhr.open("POST", url);
            // xhr.setRequestHeader("Content-Type", "application/json");
            // xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
            //     .content); // Add this line to set the CSRF token header
            // xhr.onreadystatechange = function() {
            //     if (xhr.readyState === 4) {
            //         console.log(xhr.status);
            //         console.log(xhr.responseText);
            //     }
            // };
            // xhr.send(JSON.stringify(data));
        }
    </script> --}}
@endsection
