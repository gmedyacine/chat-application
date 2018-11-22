<h1>Connexion</h1>

<?php
if (isset($loginError) && $loginError !== ''):
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $loginError;
        ?>
    </div>
<?php
endif
?>

<form method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" required
               placeholder="Entrez votre nom d'utilisateur">
    </div>
    <div class="form-group">
        <label for="password">Mots de passe</label>
        <input type="password" class="form-control" name="password" required id="password"
               placeholder="Votre mots de passe">
    </div>
    <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
</form>

<h2>S'enregistrer</h2>
<?php if (isset($registrationError)  && $registrationError !== ''): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $registrationError;
        ?>
    </div>

<?php
endif
?>
<form method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" required aria-describedby="usernameHelp"
               placeholder="Entrez votre nom d'utilisateur">
        <small id="usernameHelp" class="form-text text-muted">Veuillez choisir un nom d'utilisateur respectueux</small>
    </div>
    <div class="form-group">
        <label for="password">Mots de passe</label>
        <input type="password" class="form-control" name="password" required id="password"
               placeholder="Votre mots de passe">
    </div>
    <div class="form-group">
        <label for="password">Confirmation du mots de passe</label>
        <input type="password" class="form-control" name="password2" required id="password2"
               placeholder="Réentrez votre mots de passe">
    </div>
    <button type="submit" name="register" class="btn btn-primary">Inscription</button>
</form>