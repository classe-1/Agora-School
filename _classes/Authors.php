<?php

class Authors {

    public $id;
    public $firstname; 
    public $lastname;

    function __construct($id)
    {
          global $db;

          $id = str_secur($id);
          $reqAuthors = $db->prepare('SELECT $ FROM authors WHERE id = ?');
          $reqAuthors->execute([$id]);
          $data = $reqAuthors->fetch();

          $this->id = $id;
          $this->firstname = $data['firstname'];
          $this->lastname = $data['lastname'];

    }


    static function getAllAuthors(){


        global $db;

        $reqAuthors = $db->prepare('SELECT * FROM authors');
        $reqAuthors->execute([]);
        return  $reqAuthors->fetchAll(PDO::FETCH_ASSOC);


    }
}