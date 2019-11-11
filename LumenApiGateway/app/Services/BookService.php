<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService{
    use ConsumesExternalService;


    /**
     * The base uri to consume the books service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct(){
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }
    /**
     * Obtain the full list of author from the author service
     * @return string
     */
    public function obtainBooks(){
        return $this->performRequest('GET','/books');
    }
    /**
     * create single book 
     */
    public function createBooks($data){
        return $this->performRequest('POST','/books',$data);
    }
    public function obtainBook($book){
        return $this->performRequest('GET',"/books/{$book}");
    }
    public function editBook($data,$book){
        return $this->performRequest('PUT',"/books/{$book}",$data);
    }
    public function deleteBook($book){
        return $this->performRequest('DELETE',"/books/{$book}");
    }

}