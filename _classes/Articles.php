<?php

class Articles {


    public $id;
    public $title;
    public $sentence;
    public $content;
    public $date;
    public $author;
    public $category;

    function __construct($id)
    {


        global $db;

        $id = str_secur($id);

        $reqCategory = $db->prepare('
        
         SELECT a.* , au.firstname,au.lastname,c.name AS category
           FROM articles a 
           INNER JOIN authors au ON au.id = a.author_id
           INNER JOIN categories c ON c.id = a.category_id
           WHERE a.id = ?
        ');
        $reqCategory->execute([$id]);
        $data = $reqCategory->fetch();

        $this->id = $id;
        $this->title = $data['title'];
        $this->sentence = $data['sentence'];
        $this->content = $data['content'];
        $this->date = $data['date'];
        $this->author = $data['firstname']. ' '.$data['lastname'];
        $this->category = $data['category'];
       
    
    }

    static function getAllArticles(){

           global $db;
        $reqCategory = $db->prepare('
        
         SELECT a.* , au.firstname,au.lastname,c.name AS category
           FROM articles a 
           INNER JOIN authors au ON au.id = a.author_id
           INNER JOIN categories c ON c.id = a.category_id
        ');
        $reqCategory->execute([]);
        return $reqCategory->fetchAll(PDO::FETCH_ASSOC);

    }

    static function getLastArticles($category = null){

         global $db;

         if($category == null){

            $reqArticle = $db->prepare('
        
         SELECT a.* , au.firstname,au.lastname,c.name AS category
           FROM articles a 
           INNER JOIN authors au ON au.id = a.author_id
           INNER JOIN categories c ON c.id = a.category_id
           ORDER BY id DESC
           LIMIT 1
        ');

            $reqArticle->execute([]);
            


         }else {

            $reqArticle = $db->prepare('
        
           SELECT a.* , au.firstname,au.lastname,c.name AS category
           FROM articles a 
           INNER JOIN authors au ON au.id = a.author_id
           INNER JOIN categories c ON c.id = a.category_id
           WHERE c.id = ?
           ORDER BY id DESC
           LIMIT 1
        ');

            $reqArticle->execute([str_secur($category)]);

         }

         
         return $reqArticle->fetch(PDO::FETCH_ASSOC);

    }
}