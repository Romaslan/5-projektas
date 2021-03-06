@extends('layouts.app')

@section('content')

<div class= "container">

<form method="GET" action="{{route('book.indexpagination')}}">
        @csrf
      
        <select name="sortCollum">
         
            @foreach ($select_array as $key=>$item)
              
                @if($item == $sortCollum ||($key == 0 && empty($sortCollum)) )
                    <option value= "{{$item}}" selected>{{$item}}</option>
                @else
                    <option value= "{{$item}}">{{$item}}</option>
                @endif
            @endforeach
        </select>
     
        <select name="sortOrder">
            @if ($sortOrder == 'asc' || empty($sortOrder))
                <option value="asc" selected>Ascending</option>
                <option value="desc">Descending</option>
            @else
                <option value="asc" >Ascending</option>
                <option value="desc" selected>Descending</option>
            @endif
        </select>
        <button type="submit">Rikiuok</button>
</form>

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Author id</th>
    </tr>

  
        @foreach ($books as $book)
        <tr>
            <td>{{$book->id}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book->description}}</td>
            <td>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</td>
        </tr> 
        @endforeach

    </table>
    <!-- {{$books->links () }} -->
    {!! $books->appends(Request::except('page'))->render() !!}

</div>
@endsection