<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Book;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * return list of books
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }
    /**
     * create book
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request,$rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);

    }
    /**
     * show book
     *
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }   
    /**
     * update an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request ,$book)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request,$rules);
        
        $book = Book::findOrFail($book);

        $book->fill($request->all());
        if($book->isClean()){
            return $this->errorResponse('At least one valur must change',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->save();

        return $this -> successResponse($book);
    }
    /**
     * remove an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book= Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);
    }
}
