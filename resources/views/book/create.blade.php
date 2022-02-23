@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('book.store')}}">
            @csrf
            <div class="form-group">
                <label for="book_title">Title</label>
                <input class="form-control" type='text' name='book_title' /><br>
            </div>
            <div class="form-group">
                <label for="book_description">Description</label>
                <textarea class="form-control" name='book_description'>
                </textarea><br>
            </div>
            <div class="form-group author_select">
                <label for="book_authorid">Author</label>
                <select class="form-select" name="book_authorid">
                    @foreach($authors as $author)
                        <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="book_newauthor">Add new author?</label>
                <input id="book_newauthor" type="checkbox" name="book_newauthor" />
            </div>
            <div class="author_info d-none">
                <div class="form-group">
                    <label for="author_name">Name</label>
                    <input class="form-control" type='text' name='author_name' /><br>
                </div>
                <div class="form-group">
                    <label for="author_surname">Surname</label>
                    <input class="form-control" type='text' name='author_surname' /><br>
                </div>
                <div class="form-group">
                    <label for="author_username">Username</label>
                    <input class="form-control" type='text' name='author_username' /><br>
                </div>
                <div class="form-group">
                    <label for="author_description">Description</label>
                    <textarea class="form-control" name='author_description'>
                    </textarea><br>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#book_newauthor').click(function() {
                $(".author_info").toggleClass('d-none');
                $(".author_select").toggleClass('d-none');

            })
        })
    </script>

@endsection
