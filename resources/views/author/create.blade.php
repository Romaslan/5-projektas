@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('author.store')}}">
            @csrf
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
            
            <div class="form-group">
                <label for="author_newbooks">Add new books?</label>
                <input id="author_newbooks" type="checkbox" name="author_newbooks" />
            </div>

            <div class="books-info d-none">
                <button type="button" class="btn btn-secondary add_field">Add</button>
                <button type="button" class="btn btn-danger remove_field">Remove</button>

                <div class="book-info row">
                    <div class="form-group col-md-6">
                        <label for="book_title">Title</label>
                        <input id="book_title" class="form-control" type='text' name='book_title[]' />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="book_description">Description</label>
                        <textarea id="book_description" class="form-control" name='book_description[]'>
                        </textarea>
                    </div>
                </div>
            </div>
            

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#author_newbooks').click(function() {
                $('.books-info').toggleClass('d-none');
                //kol kas sita vieta palik uzkomentuota
                // $('.books-info:not(.book-first)').remove();
                $('#book_title').val('');
                $('#book_description').val('');
            })
            $('.add_field').click(function(){
                $('.books-info').append('<div class="book-info row"><div class="form-group col-md-6"><label for="book_title">Title</label><input class="form-control" type="text" name="book_title[]" /></div><div class="form-group col-md-6"><label for="book_description">Description</label><textarea class="form-control" name="book_description[]"></textarea></div></div>');
            });
            $('.remove_field').click(function(){
                $('.book-info:last-child').remove();
            });
        })
    </script>

@endsection
