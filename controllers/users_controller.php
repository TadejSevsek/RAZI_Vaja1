<?php
/*
    Controller za uporabnike. Vključuje naslednje standardne akcije:
        create: izpiše obrazec za registracijo
        store: obdela podatke iz obrazca za registracijo in ustvari uporabnika v bazi
        edit: izpiše obrazec za urejanje profila
        update: obdela podatke iz obrazca za urejanje profila in jih shrani v bazo
*/

class users_controller
{
    function create(){
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                case 2: $error = "Gesli se ne ujemata."; break;
                case 3: $error = "Uporabniško ime je že zasedeno."; break;
                default: $error = "Prišlo je do napake med registracijo uporabnika.";
            }
        }
        require_once('views/users/create.php');
    }
    
    function store(){
        //Preveri če so vsi podatki izpolnjeni
        if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
            header("Location: /users/create?error=1"); 
        }
        //Preveri če se gesli ujemata
        else if($_POST["password"] != $_POST["repeat_password"]){
            header("Location: /users/create?error=2"); 
        }
        //Preveri ali uporabniško ime obstaja
        else if(User::is_available($_POST["username"])){
            header("Location: /users/create?error=3"); 
        }
        //Podatki so pravilno izpolnjeni, registriraj uporabnika
        else if(User::create($_POST["username"], $_POST["email"], $_POST["password"])){
            header("Location: /auth/login");
        }
        //Prišlo je do napake pri registraciji
        else{
            header("Location: /users/create?error=4"); 
        }
        die();
    }

    function edit(){
        if(!isset($_SESSION["USER_ID"])){
            header("Location: /pages/error");
            die();
        }
        $user = User::find($_SESSION["USER_ID"]);
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                case 2: $error = "Uporabniško ime je že zasedeno."; break;
                default: $error = "Prišlo je do napake med urejanjem uporabnika.";
            }
        }
        require_once('views/users/edit.php');
    }

    ffunction update(){
        if(!isset($_SESSION["USER_ID"])){
            header("Location: /pages/error");
            die();
        }
        $user = User::find($_SESSION["USER_ID"]);
        //Preveri če so vsi podatki izpolnjeni
        if(empty($_POST["username"]) || empty($_POST["email"])){
            header("Location: /users/edit?error=1"); 
        }
        //Preveri ali uporabniško ime obstaja
        else if($user->username != $_POST["username"] && User::is_available($_POST["username"])){
            header("Location: /users/edit?error=2"); 
        }
        else if (empty($_POST["oldPassword"]) && (empty($_POST["repeat"]) || empty($_POST["newPassword"]))){
            if($user->update($_POST["username"], $_POST["email"])){
                header("Location: /");
            }
        }

        else if(empty($_POST["oldPassword"]) || (empty($_POST["repeat"]) || empty($_POST["newPassword"]))){
            header("Location: /users/edit?error=1"); 
        }
        else if(!empty($_POST["oldPassword"]) && (!empty($_POST["repeat"]) && !empty($_POST["newPassword"]))){
           if($_POST["newPassword"] != $_POST["repeat"]){
               header("Location: /users/edit?error=4"); 
           }
           else if(User::authenticate($user->username, $_POST["oldPassword"]) < 0){
               header("Location: /users/edit?error=3"); 
           }else{
                $user->update($_POST["username"], $_POST["email"], $_POST["newPassword"]);
                header("Location: /");
           }
        }
        
        //Prišlo je do napake pri registraciji
        else{
            header("Location: /users/edit?error=4"); 
        }
        die();
    }
    function profile(){
        if(!isset($_GET["id"])){
            return call('pages', 'error');          
        }else{
            $user = User::find($_GET["id"]);
            $newsCount = count(Article::list($_GET["id"]));
            $commentsCount = Comment::count($_GET["id"]);
            require_once('views/users/profile.php');

        }
    }
}