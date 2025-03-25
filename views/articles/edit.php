<div class="container">
    <h3>Uredi Novico</h3>
    <form action="/vaja1/articles/update" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article->title; ?>">
        </div>
        <div class = "mb-3">
            <label for="abstract" class = "form-label">Povzetek</label>
            <input type="text" class="form-control" id="abstract" name="abstract" value="<?php echo $article->abstract; ?>">
        </div>
        <div class = "mb-3">
            <label for ="text" class = "form-label">Besedilo</label>
            <textarea class="form-control" id="text" name="text" ><?php echo $article->text;?></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $article->id; ?>" id= "id">
        <button type="submit" class="btn btn-primary" name="submit">Objavi</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>