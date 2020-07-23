<?php
include_once '_config/config.php';
include_once '_config/db.php';
include_once '_functions/functions.php';


include_once '_classes/Categories.php';
include_once '_classes/Authors.php';
include_once '_classes/Articles.php';


// $test = Articles::getAllArticles();
// 
//getlastArticles() => the last article (not $category)
//getLastArticles (2,1,4,5) => the last in this category

// debug($test2);



// $cat = Categories::getAllCategories();
// $getallauthors = Authors::getAllAuthors();



// debug($cat);
// debug($getallauthors);
// exit;
// $var = new Authors(1);
// $var1 = new Categories(1);
// $var3= new Articles(2);
// debug($var);
// debug($var1);
// debug($var3);

// $test = Categories::getAllCategories();
// $testp = Authors::getAllAuthors();
// $testm = Articles::getAllArticles();
// debug($testm);
// exit;

// debug(['hello','world']);
// exit;

// echo '<h1>hello</h1>';
//  echo debug(str_secur('<h1>hello</h1>'));

// debug($_GET);
// //on test sur l'url /contact?action=send
// exit;

//definition de la page courante
if(isset($_GET['page']) AND !empty($_GET['page'])){
   $page = trim(strtolower($_GET['page'])); //HOME
}
else {
$page = 'home';
}

//array contenant toutes les pages
$allpages = scandir('controllers/');
// var_dump($allpages);

if(in_array($page.'_controller.php',$allpages)){
    //inclusion de la page
    include_once 'models/'.$page.'_model.php';
    include_once 'controllers/' . $page . '_controller.php';
    include_once 'views/' . $page . '_view.php';
}else {
    //return error
    echo 'Erreur 404';
}