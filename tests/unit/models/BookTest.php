<?php

namespace tests\unit\models;

use app\models\Author;
use app\models\Book;
use Codeception\PHPUnit\TestCase;

class BookTest extends TestCase
{
    public function testBookCreate()
    {
        $book = new Book();

        $book->attributes = [
            'name'      => 'Test Book',
            'author_id' => 1,
        ];

        $this->assertTrue($book->save(), 'Невозможно сохранить книгу');
    }

    public function testBookNameIsRequired()
    {
        $book = new Book();

        $this->assertFalse($book->validate(['name']), 'Название книги не требуется');
    }

    public function testBookAuthorIdIsRequired()
    {
        $book = new Book();

        $this->assertFalse($book->validate(['author_id']), 'Автор книги не требуется');
    }

    public function testAuthorBooksRelation()
    {
        $author = Author::findOne(1);
        $this->assertTrue(is_array($author->books), 'Отношение "Автор-Книги" не работает');

        foreach ($author->books as $book) {
            $this->assertInstanceOf(Book::class, $book, 'Отношение Author-Books не возвращает экземпляры "Книга"');
        }
    }

    public function testBookAuthorRelation()
    {
        $book = Book::findOne(1);
        $this->assertInstanceOf(Author::class, $book->author, 'Отношение "Книга-Автор" не работает');
    }
}