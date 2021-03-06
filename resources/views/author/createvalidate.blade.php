@extends('layouts.app')

@section('content')
<div class="errors">
    <pre>
    {{-- {{print_r($errors)}}; --}}
    </pre>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>    
                @endforeach
            </ul>
        </div>
    @endif    

</div>  
<!-- va viskas turetu veikt, tiesiog mygtukas neturejo id, del to kodas neveike, -->
    <div class="container">
        <div class="addFields">
            <button id="addfields" class="btn btn-primary">Add Field</button>
        </div>
        <form method="GET" action="{{route('author.createvalidate')}}">
            @csrf
            <input type="number" name="authorsCount" value='{{$authorsCount}}'>
            <button type="submit">Create</button>
        </form>    

        <form method="POST" action="{{route('author.storevalidate')}}">
            @csrf
            <div class="authors">
                @for ($i = 0; $i< $authorsCount; $i++)
                    <div class="row author">
                        <div class="form-group col-md-3">
                            <label for="author_name">Name</label>
                            <input class="form-control @error('authorName'.$i.'name') is-invalid @enderror " type='text' name='authorName[][name]' value="{{old("authorName".$i."name") }}" />
                            @error("authorName".$i."name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="author_surname">Surname</label>
                            <input class="form-control @error('authorSurname'. $i.'surname') is-invalid @enderror" type='text' name='authorSurname[][surname]' value="{{ old("authorSurname".$i."surname") }}" />
                            @error("authorSurname".$i."surname")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="author_username">Username</label>
                            <input class="form-control @error('authorUsername'.$i.'username') is-invalid @enderror" type='text' name='authorUsername[][username]' value="{{ old("authorUsername".$i."username") }}"  />
                            @error("authorUsername".$i."username")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="author_description">Description</label>
                            <textarea class="form-control @error('authorDescription'.$i.'description') is-invalid @enderror" name='authorDescription[][description]'>
                                {{ old("authorDescription".$i."description") }}
                            </textarea>
                            @error("authorDescription".$i."description")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endfor
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>   
        </form>   
        
        <div class="input-template d-none">
            <div class="row author">
                <div class="form-group col-md-3">
                    <label for="author_name">Name</label>
                    <input class="form-control" type='text' name='authorName[][name]' />
                </div>

                <div class="form-group col-md-3">
                    <label for="author_surname">Surname</label>
                    <input class="form-control " type='text' name='authorSurname[][surname]' />
                </div>

                <div class="form-group col-md-3">
                    <label for="author_username">Username</label>
                    <input class="form-control" type='text' name='authorUsername[][username]' />
                </div>

                <div class="form-group col-md-3">
                    <label for="author_description">Description</label>
                    <textarea class="form-control" name='authorDescription[][description]'>
                    </textarea>
                </div>
            </div>
        </div>
    </div>   
<script>
    $(document).ready(function() {
        console.log("jquery veikia");
        $("#addfields").click(function(){
            $(".authors").append($(".input-template").html());
        });
    })
</script> 
@endsection