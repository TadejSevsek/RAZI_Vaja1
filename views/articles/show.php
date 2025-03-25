<div class="container">
    <h3>Seznam novic</h3>
    <div class="article">
        <h4><?php echo $article->title;?></h4>
        <p><b>Povzetek:</b> <?php echo $article->abstract;?></p>
        <p><?php echo $article->text; ?></p>
        <p>Objavil: <?php echo $article->user->username; ?>, <?php echo date_format(date_create($article->date), 'd. m. Y \ob H:i:s'); ?></p>
        <a href="/"><button>Nazaj</button></a>
         <?php if(isset($_SESSION["USER_ID"])): ?>

            <br>
            <br>
           <form action="/comments/store" method="post">
           <div class = "mb-3">
            <label for ="text" class = "form-label">Komentar</label>
            <textarea class="form-control" id="text" name="text" ></textarea>
        </div>
        <input type="hidden" name="article_id"  id= "article_id" value="<?php echo $article->id; ?>">
        <button type="submit" class="btn btn-primary" name="submit">Pošji</button>
           </form>
        <?php endif; ?>
        <?php
        if($comments == null){
            echo "<p>Še ni komentarjev</p>";
        }else{
            echo "<p>Komentarji:</p>";
            foreach ($comments as $comment){
                ?>
                <div class="article"> 
                    <p><?php echo $comment->text;?></p>
                    <p>Komentiral: <?php echo $comment->user->username?>, <?php echo date_format(date_create($comment->date), 'd. m. Y \ob H:i:s'); ?></p>
                </div>
                <?php
            }
        }
            ?>
    </div>
</div>