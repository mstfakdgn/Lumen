<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Author;
USE Illuminate\Http\Response;
class AuthorController extends Controller
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
     * return list of authors
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return $this->successResponse($authors);

    }
    /**
     * create author
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request,$rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);

    }
    /**
     * show author
     *
     * @return Illuminate\Http\Response
     */
    public function show($author)
    {
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }
    /**
     * update author
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request ,$author)
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        $this->validate($request,$rules);
        
        $author = Author::findOrFail($author);

        $author->fill($request->all());
        if($author->isClean()){
            return $this->errorResponse('At least one valur must change',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $author->save();

        return $this -> successResponse($author);
    }
    /**
     * remove author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($author)
    {
        $author= Author::findOrFail($author);

        $author->delete();

        return $this->successResponse($author);
    }
    
}
