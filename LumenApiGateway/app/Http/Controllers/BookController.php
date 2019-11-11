<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Http\Response;
use App\Services\AuthorService;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * The service to consume the authors microservice
     * @var BookService
     */
    public $bookService;
    public $authorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * return list of books
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }
    /**
     * create book
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBooks($request->all(),Response::HTTP_CREATED));
    }
    /**
     * show book
     *
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }   
    /**
     * update an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request ,$book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(),$book));
    }
    /**
     * remove an existing book
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }

   
}
