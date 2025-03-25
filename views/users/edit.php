<div class="container">
    <h3 class="mb-3">Uredi Profil</h3>
    <form action="/users/update" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Vzdevek</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-pošta</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>">
        </div>
        <div class="mb-3">
            <label for="oldPassword" class="form-label">Staro Geslo</label>
            <input type="password" class="form-control" id="oldPassword" name="oldPassword" >
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">Novo Geslo</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" >
        </div>
        <div class="mb-3">
            <label for="repeat" class="form-label">Ponovi geslo</label>
            <input type="password" class="form-control" id="repeat" name="repeat" >
        </div>
        <button type="submit" class="btn btn-primary" name="register">Shrani</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>