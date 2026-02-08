<?php

class BookRepository
{
    private PDO $pdo;
    private $tableName = 'books';

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function search($title = '', $author = '', $year = '', $price = '') {
        $conditions = [];
        $params = [];

        if ($title !== '') {
            $conditions[] = 'title = :title';
            $params[':title'] = $title;
        }
        if ($author !== '') {
            $conditions[] = 'author = :author';
            $params[':author'] = $author;
        }
        if ($year !== '' && ctype_digit($year)) {
            $conditions[] = 'year_of_publication = :year';
            $params[':year'] = (int)$year;
        }
        if ($price !== '') {
            $conditions[] = 'price = :price';
            $params[':price'] = (float)$price;
        }

        if (count($conditions) === 0) {
            return [];
        }

        $where = implode(' AND ', $conditions);
        $sql = "SELECT id, title, author, year_of_publication, price FROM {$this->tableName} WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = $row;
        }
        return $books;
    }
}
