<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use\App\Models\PaginationSetting;
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
        $books = Book::where('author_id', '=', $author_id)->get();
        return view('book.bookfilter',['books' => $books]);
    }

    public function indexpagination (Request $request) {
        //kad pagination veiktu reikia panaudot pagination funkcija
        //jei nera panaudota ta funkcija visada gausi sita error
        // kad :links does not exist tai jei gauni sita vadinasi paginate nepanaudojai

        // $books = Book::all()->sortBy('id', SORT_REGULAR, true);
        $sortCollum = $request->sortCollum;
        $sortOrder = $request->sortOrder;

        $tem_book = Book::all();
        $book_collumns = array_keys($tem_book->first()->getAttributes());

        if(empty($sortCollum) || empty($sortOrder)) {
            $books = Book::paginate(15);
        }else {
                $books = Book::orderBy($sortCollum, $sortOrder)->paginate(15); 

        }

        $select_array = $book_collumns;
        // $books = Book::orderBy('id', 'DESC')->get();
        // $books = Book::orderBy('title', 'DESC')->paginate(15); //pvz
        // $books = Book::paginate(15);

        return view('book.indexpagination', ['books' => $books, 'sortCollum'=> $sortCollum, 'sortOrder'=>  $sortOrder, 'select_array' => $select_array]);
    }

    private function isPaginateFilter($page_limit, $author_id, $sortCollumn, $sortOrder ) {
        if($page_limit == 1) {
          return $books = Book::where('author_id', '=', $author_id)->orderBy($sortCollumn, $sortOrder)->get();
        }
        return $books = Book::where('author_id', '=', $author_id)->orderBy($sortCollumn, $sortOrder)->paginate($page_limit);
    }

    private function isPaginateSort($page_limit, $sortCollumn, $sortOrder) {
        if($page_limit == 1) {
            if($sortCollumn == 'author_id')
            {
                return $books = Book::select('books.*')->join('authors', 'books.author_id', '=', 'authors.id')->orderBy('authors.name', 'sortOrder')->get();
            }
            return $books = Book::orderBy($sortCollumn, $sortOrder)->get();
            
        } else {
            if($sortCollumn == 'author_id') {
                return $books = Book::select('books.*')->join('authors', 'books.author_id', '=', 'authors.id')->orderBy('authors.name', 'ASC')->paginate($page_limit);
            }
            return $books = Book::orderBy($sortCollumn, $sortOrder)->paginate($page_limit);
        }
        return 0;
    }

    public function indexsortfilter(Request $request) {
        $sortCollumn = $request->sortCollumn;
        $sortOrder = $request->sortOrder;
        $author_id = $request->author_id;

        $paginationSettings = PaginationSetting::where('visible', '=', 1)->get();

        $page_limit = $request->page_limit;
        // $page_limit = 15;

            $tem_book = Book::all();
            $book_collumns = array_keys($tem_book->first()->getAttributes());
            $select_array = $book_collumns;

            if(empty($sortCollumn) || empty($sortOrder) || empty($author_id) )
            {
                $books = Book::paginate($page_limit);
            } else {
                if($author_id == 'all') {
                    // $books = Book::select('*')->join('authors', 'books.author_id', '=', 'authors.id')->orderBy('authors.name', 'ASC')->paginate(5);
                    $books = $this->isPaginateSort($page_limit, $sortCollumn, $sortOrder);
                } else {
                    $books = $this->isPaginateFilter($page_limit, $author_id, $sortCollumn, $sortOrder);
                }
            }

       
        // $books = Book::where('author_id', '=', $author_id)->get();
        // $books = Book::orderBy($sortCollumn, $SortOrder)->get();

        $authors = Author::all();

        return view('book.indexsortfilter', [
            'books'=>$books, 
            'authors'=>$authors, 
            'select_array'=>$select_array, 
            'sortCollumn'=>$sortCollumn, 
            'sortOrder'=>$sortOrder, 
            'author_id'=>$author_id, 
            'paginationSettings'=>$paginationSettings, 
            'page_limit'=>$page_limit]);
    }

    public function indexsortable(Request $request) {

        $author_id = $request->author_id;
        $page_limit = $request->page_limit;

        $sort = $request->sort;
        $direction = $request->direction;

        $authors = Author::all();
        $paginationSettings = PaginationSetting::where('visible', '=', 1)->get();

        if(empty($author_id) || $author_id == 'all') {
            if($page_limit == 1) {
                $books = Book::sortable()->get();
            } else {
                $books = Book::sortable()->paginate($page_limit);
            }
        } else {
            if($page_limit == 1) {
                $books = Book::where('author_id', '=', $author_id)->sortable()->get();
            } else {
                $books = Book::where('author_id', '=', $author_id)->sortable()->paginate($page_limit);
            }
        }

        
        return view('book.indexsortable', [
            'books' => $books,
            'authors' => $authors,
            'paginationSettings'=>$paginationSettings,
            'author_id'=>$author_id,
            'page_limit'=>$page_limit,
            'sort'=>$sort,
            'direction'=>$direction
        ]);
    }

    public function indexadvancedsort() {

        $books = Book::select('*')->join('authors', 'books.author_id', '=', 'authors.id')->orderBy('authors.name', 'ASC')->paginate(5);
        // dd($books->first());

        return view('book.indexadvancedsort', ['books' => $books]);
    }
}
