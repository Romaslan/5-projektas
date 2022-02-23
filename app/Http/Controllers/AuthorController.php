<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

use Illuminate\Http\Request;
use Illuminte\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$authors = Author::all();

        //$authors = Author::sort();

        //$authors = Author::all()->sortBy('name',SORT_REGULAR, true);

        // $authors = Author::orderBY('id','DESC')->get();

        $sortCollum = $request->sortCollum;
        $sortOrder = $request->sortOrder;

        if(empty($sortCollum) || empty($sortOrder)) {
            $authors = Author::all();
        }else {
            $authors = Author::orderBy($sortCollum, $sortOrder)->get();
        }

        // $select_array = array('id', 'name', 'surname', 'username', 'description');

        $select_array = array_keys($authors->first()->getAttributes());

        // $select_array = DB::getSchemaBuilder()->getCollumListing('authors');
        // $autorius = $authors->first();

        // $autorius = (array)$autorius;
        // $autorius = array_keys($autorius);

        

        return view('author.index', ['authors' => $authors, 'sortCollum'=> $sortCollum, 'sortOrder'=>  $sortOrder, 'select_array' => $select_array]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author;

        $author->name=$request->author_name;
        $author->surname=$request->author_surname;
        $author->username=$request->author_username;
        $author->description=$request->author_description;
        $author->save();

        if($request->author_newbooks) {
            $books_count = count($request->book_title);
            
            for ($i=0; $i< $books_count; $i++){
                $book = new Book;
                $book->title=$request->book_title[$i];
                $book->description=$request->book_description[$i];
                $book->author_id=$author->id;
                $book->save();
            }
        }

        return redirect()->route('author.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        // 
    }
        public function search(Request $request) {
            // $authors = Author::all();

        //     $tekstas = '34';

        //     $skaicius = 34;

        //   if($tekstas === $skaicius) 
        // {
        //     dd('tiesa');
        // } else {
        //     dd('melas');
        // }

        $search_key = $request->search_key;

            $authors = Author::where('description', 'LIKE', '%'.$search_key.'%')
            ->orWhere('name', 'LIKE', '%'.$search_key.'%')
            ->orWhere('surname', 'LIKE', '%'.$search_key.'%')
            ->orWhere('username', 'LIKE', '%'.$search_key.'%')
            ->orWhere('id', 'LIKE', '%'.$search_key.'%')
            ->get();
            return view('author.search', ['authors' => $authors]);
    }
}
