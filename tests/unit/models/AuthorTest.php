<?php

namespace tests\unit\models;

use app\models\Author;
use app\models\Book;
use Codeception\PHPUnit\TestCase;

class AuthorTest extends TestCase
{
    public function testAuthorCreate()
    {
        $author = new Author();

        $author->attributes = [
            'name' => 'Test Author',
        ];

        $this->assertTrue($author->save(), 'Невозможно сохранить автора');
    }

    public function testAuthorNameIsRequired()
    {
        $author = new Author();

        $this->assertFalse($author->validate(['name']), 'Имя автора не является обязательным');
    }

    public function testAuthorBooksRelation()
    {
        $author = Author::findOne(1);
        $this->assertTrue(is_array($author->books), 'Отношение "Автор-Книги" не работает');

        foreach ($author->books as $book) {
            $this->assertInstanceOf(Book::class, $book, 'Отношение "Автор-Книги" не возвращает экземпляры "Книга"');
        }
    }
}