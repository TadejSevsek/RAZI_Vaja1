<?php

require_once('models/articles.php'); // Include the Article model

class comments_controller {
    function store() {
        // Vsebina obrazca
        $article_id = $_POST['article_id'];
        $text = $_POST['text'];
        $user_id = $_SESSION['USER_ID'];
        $error = "";
        // Preveri, če so podatki pravilni
        if (empty($text)) {
        $error = "Vnesite besedilo komentarja.";
        require_once('views/articles/show.php');
        } else {
        // Vstavi komentar v bazo
        Comment::store($article_id, $text);
        // Prikaz članka
        $article = Article::find($article_id);
        $comments = Comment::all($article_id);
    
        require_once('views/articles/show.php');
    }
  }
}