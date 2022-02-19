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

        <button class="btn btn-primary add_field">Add</button>
      
        <form method="POST" action="{{route('rating.storejavascript')}}">
            @csrf
            
                <input type="text" name="rating_title[]" value="test"/>
                <input type="number" name="rating_rating[]" value="1"/>
           
          
            <button type="submit">Save</button>
        </form>
    </div>
    <script>
        $(document).ready(function()){
            console.log('dokumentas uzsikrove');
        }
        console.log('scriptas veikia');
    </script>

@endsection