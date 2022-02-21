@extends('layouts.app')

<!-- <style>
p {
    color:red;
}
#test {
    color:red;
}
.test {
    color:red;
}

</style> -->

@section('content')
    <div class="container">

        <button id="add_field" class="btn btn-primary">Add</button>
        <button id="remove_field" class="btn btn-primary">Remove</button>

        <input id="input_count" type="text" value="1"/>
        <button id="submit_number">Ok</button>

      
        <form method="POST" action="{{route('rating.storejavascript')}}">
            @csrf
            
            <div class="info">
                <div class="input-rating">
                    <input type="text" name="rating_title[]" value="test"/>
                    <input type="number" name="rating_rating[]" value="1"/>
                </div>
            </div>
            <button type="submit">Save</button>
        </form>
        
    </div>
    <script>
        $(document).ready(function() {
            $('#add_field').click(function(){
                $('.info').append('<div class="input-rating"><input type="text" name="rating_title[]" value="test"/><input type="number" name="rating_rating[]" value="1"/></div>');
            });
            $('#remove_field').click(function(){
                $('.input-rating:last-child').remove();
            });
            $('#submit_number').click(function() {
                let input_count;
                input_count = $('#input_count').val();
                for(let i=0; i<input_count; i++) {
                    $('.info').append('<div class="input-rating"><input type="text" name="rating_title[]" value="test"/><input type="number" name="rating_rating[]" value="1"/></div>');

                }
                console.log(input_count);
            });
        });
        console.log('scriptas veikia');
    </script>

@endsection