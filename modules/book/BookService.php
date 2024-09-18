<?php

namespace app\modules\book;

use app\api\ExternalApiClient;
use app\modules\book\models\Book;

class BookService
{   
    private $externalApiClient;

    public function __construct(ExternalApiClient $externalApiClient)
    {
        $this->externalApiClient = $externalApiClient;
    }

    public function create($data)
    {
        $book = new Book();
        $book->load($data, '');

        $isIsbnValid = $this->externalApiClient->validateIsbn($book->isbn);

        if (!$isIsbnValid) {
            throw new \Exception('ISBN inválido');
        }

        if ($book->validate()) {
            $bookSaved = $book->save();
            
            if (!$bookSaved) {
                return ['status' => 500, 'error' => 'Failed to save the book'];
            }

            return ['status' => 201, 'message' => 'Livro cadastrado com sucesso', 'book' => $book];
        }

        return ['status' => 400, 'errors' => $book->errors];
    }

    public function findAll($limit = 10, $offset = 0)
    {
        $books = Book::find()
            ->limit($limit)
            ->offset($offset)
            ->all();

        return $books;
    } 
}