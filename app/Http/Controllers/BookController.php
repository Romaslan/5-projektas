<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $sortCollum = $request->sortCollum;
        $sortOrder = $request->sortOrder;

        $tem_book = Book::all();
        $book_collumns = array_keys($tem_book->first()->getAttributes());

        if(empty($sortCollum) || empty($sortOrder)) {
            $books = Book::all();
        }else {

            if($sortCollum == 'author_id'){
                $sortBool = true;

                if($sortOrder == 'asc'){
                    $sortBool = false;
                }
                $books = Book::get()->sortBy(function($query){
                    return $query->bookAuthor->name;
                }, SORT_REGULAR, $sortBool)->all();
    
            }else{
                $books = Book::orderBy($sortCollum, $sortOrder)->get(); 
            }

        }

        

        $select_array = $book_collumns;
        // $select_array = array('author');
        

        return view('book.index', ['books' => $books, 'authors'=> $authors, 'sortCollum'=> $sortCollum, 'sortOrder'=>  $sortOrder, 'select_array' => $select_array]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    public function bookfilter(Request $request){

        // $books = Book::all();
        $author_id = $request->author_id;
        $books = Book::where('author_id', '=', 6)->get();

        return view('book.bookfilter',['books' => $books]);

    }
}