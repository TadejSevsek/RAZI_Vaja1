<?php
class Comment {
    public $id;
    public $text;
    public $date;
    public $user_id;
    public $article_id;
    public $user;
    public $article;
    
    public function __construct($id, $text, $date, $user_id, $article_id, $user, $article) {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->user_id = $user_id;
        $this->article_id = $article_id;
        $this->user = $user;
        $this->article = $article;
    }
    public static function store($article_id, $text) {
        $db = Db::getInstance();
        $text = mysqli_real_escape_string($db, $text);
        $id = $_SESSION["USER_ID"];
        $query = "INSERT INTO comments (text, date, user_id, article_id) VALUES ('$text', NOW(), '$id', '$article_id');";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        } 
    }
    public static function all($article_id) {
        $list = [];
        $db = Db::getInstance();
        $article_id = mysqli_real_escape_string($db, $article_id);
        $query = "SELECT * FROM comments JOIN users ON user_id=users.id WHERE article_id = '$article_id';";
        $res = $db->query($query);
        while ($comment = $res->fetch_object()) {
            $user = User::find($comment->user_id);
            $article = Article::find($comment->article_id);
            array_push($list, new Comment($comment->id, $comment->text, $comment->date, $comment->user_id, $comment->article_id, $user, $article));
        }
        return $list;
    }
    public static function count($id)
    {
        $db = Db::getInstance(); // pridobimo instanco baze
        $id = mysqli_real_escape_string($db, $id);
        $query = "SELECT COUNT(id) FROM comments where user_id = $id;"; // pripravimo query
        $res = $db->query($query); // poženemo query
        
        return $res->fetch_row()[0];
    }
}