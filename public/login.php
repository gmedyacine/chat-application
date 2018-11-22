<h1>Connexion</h1>

<?php
    if (isset($loginError)):
?>
<p class="error"><?= $loginError; ?>
<?php
    endif
?>

<form method="post">
    <input type="text" name="username" required="true">
    <input type="password" name="password" required="true">
    <input type="submit" name="login" value="Se connecter">
</form>

<h2>S'enregistrer</h2>
<?php if (isset($registrationError)): ?>
<p class="error">
<?php
        $registrationError;
?>
<?php
    endif
?>
<form method="post">
    <input type="text" name="username" required="true">
    <input type="password" name="password" required="true">
    <input type="password" name="password2" required="true">
    <input type="submit" name="register" value="Inscription">
</form>