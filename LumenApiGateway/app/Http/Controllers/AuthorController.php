<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Author;
use Illuminate\Http\Response;
use App\Services\AuthorService;

class AuthorController extends Controller


{
    use ApiResponser;
    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * return list of authors
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
       return $this->successResponse($this->authorService->obtainAuthors());
    }
    /**
     * create author
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthors($request->all(),Response::HTTP_CREATED));
    }
    /**
     * show author
     *
     * @return Illuminate\Http\Response
     */
    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }
    /**
     * update author
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request ,$author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(),$author));
    }
    /**
     * remove author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
    
}
