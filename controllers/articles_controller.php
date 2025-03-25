<?php
/*
    Controller za novice. Vključuje naslednje standardne akcije:
        index: izpiše vse novice
        show: izpiše posamezno novico
        
    TODO:
        list: izpiše novice prijavljenega uporabnika
        create: izpiše obrazec za vstavljanje novice
        store: vstavi novico v bazo
        edit: izpiše vmesnik za urejanje novice
        update: posodobi novico v bazi
        delete: izbriše novico iz baze
*/

class articles_controller
{
    public function index()
    {
        //s pomočjo statične metode modela, dobimo seznam vseh novic
        //$ads bo na voljo v pogledu za vse oglase index.php
        $articles = Article::all();

        //pogled bo oblikoval seznam vseh oglasov v html kodo
        require_once('views/articles/index.php');
    }

    public function show()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        require_once('views/articles/show.php');
    }

    public function create(){
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                default: $error = "Prišlo je do napake.";
            }
        }
        require_once('views/articles/create.php');
    }
    function store(){
        //Preveri če so vsi podatki izpolnjeni
        if(empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])){
            header("Location: /articles/create?error=1"); 
        }
        //Podatki so pravilno izpolnjeni, registriraj uporabnika
        else if(Article::create($_POST["title"], $_POST["abstract"], $_POST["text"])){
            header("Location: /");
        }
        else{
            header("Location: /create/create?error=4"); 
        }
        die();
    }
    public function list()
    {
        if (!isset($_SESSION["USER_ID"])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglase in ga prikažemo
        $articles = Article::list($_SESSION["USER_ID"]);
        require_once('views/articles/list.php');
    }
    function edit(){
        
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                default: $error = "Prišlo je do napake.";
            }
        }
        require_once('views/articles/edit.php');
        
    }

    function update(){
       
        
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_POST['id']);
        
        //Preveri če so vsi podatki izpolnjeni
        if(empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])){
            header("Location: /articles/edit?error=1"); 
        }
    
        //Podatki so pravilno izpolnjeni, registriraj uporabnika
        else if($article->update($_POST["title"], $_POST["abstract"], $_POST["text"], $_POST["id"])){
            header("Location: /");
        }
        //Prišlo je do napake pri registraciji
        else{
            header("Location: /users/edit?error=3"); 
        }
        die();
    }
    public function delete()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::delete($_GET['id']);
        header("Location: /");
    }


}