<div class="container">
    <h3>Objavi novico</h3>
    <form action="/articles/store" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" >
        </div>
        <div class = "mb-3">
            <label for="abstract" class = "form-label">Povzetek</label>
            <input type="text" class="form-control" id="abstract" name="abstract">
        </div>
        <div class = "mb-3">
            <label for ="text" class = "form-label">Besedilo</label>
            <textarea class="form-control" id="text" name="text"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Objavi</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>