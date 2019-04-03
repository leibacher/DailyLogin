<?php
$alert = "";
if(isset($_POST['login-submit']) && isset($_POST['login-username']) && isset($_POST['login-password'])){
    $username = $_POST['login-username'];
    $password = sha1($_POST['login-password']);
/* use a function, to get the user by his username and password */
    $user = UsserSelect::selectUserByLogin($username, $password);
    
/* Login correct -> create a session with the id of the user */
    if(!is_null($user->getId())){
        $_SESSION['connected'] = true;
        $_SESSION['user'] = $user->getId();
        header("location: /");
    }
    else{
        $alert .= "<p style='color: rgb(255, 0, 0);'>Falsche Anmeldedaten</p>";
    }
}
?>
<?php
if(!isset( $_SESSION['user'])){
?>
    <form id="sign-in" class="login-form" action='' method='post' autocomplete="on" accept-charset='UTF-8'>
        <label for='login-username'>Benutzername:</label>
        <input type='text' name='login-username' id='username' maxlength="45" autocomplete="username" required/>
        <label for='login-password'>Passwort:</label>
        <input type='password' name='login-password' id='password' maxlength="45" autocomplete="current-password" required/>
        <button class="button-green" type='submit' name='login-submit'>Anmelden</button>
        <div class="login-alert"><?php echo $alert ?></div>
    </form>

    <p> ODER</p>
    <a href="?p=register">Registrieren</a>
<?php
}
?>