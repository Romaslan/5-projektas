@extends('layouts.app')

@section('content')

<div class="container">
        <form method="POST" action="{{route('rating.store')}}">
            @csrf

            @for($i=0; $i<=5; $i++)
                <input type="text" name="rating_title"/>
                <input type="number" name="rating_rating"/>
                <br>
            @endfor
     
            <button type="submit">Save</button>
        </form>
    </div>


@endsection