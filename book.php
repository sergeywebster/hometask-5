<?php


class Book
{
    //Ваши методы для работы с данными, а так же конструктор где вы сделаете подключение к БД

    private $connection; 
   
    public function __construct() 
    {

        $servername = "localhost";
        $database = "book_catalog";
        $username = "root";
        $password = "root";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$servername;dbname=$database;charset=$charset";

        $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, $username, $password, $opt);
            
        }

        catch (PDOException $e)
        {
            echo $e->getMessage();

        }
        
    }


    public function saveBook($data)
    {
      
    //Здесь должно идти сохранение ваших книг
        try {
            if (!empty($this->data)) {
                $this->data = $this->connection->prepare("INSERT INTO books (title, author, isbn)
                    VALUES('".$_POST["title"]."','".$_POST["author"]."','".$_POST["isbn"]."')")->execute();
                } else {
                    echo 'Поля обязательны для заполнения!';
                }

            }

        catch (PDOException $e)
        {
            echo $e->getMessage();

        }
    }

    public function getAllBooks()
    {
   
        // Здесть нужно создать запрос и вернуть данных о книгах
        try {
        $books = $this->connection->query("SELECT * FROM books")->fetchAll();

        return $books;
        
        catch (PDOException $e)
        {
            echo $e->getMessage();

        }

    }

}    
