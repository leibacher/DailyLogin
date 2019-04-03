<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register-submit'])){
    
    $fehler = "";
    if(!isset($_POST['username'])){
       $fehler = "Kein Benutzername gesetzt. ";
    }
    else{
        $letters = strlen($_POST['username']);
        if($letters > 45 OR $letters < 3){
            $fehler = $fehler."Username zu lang oder zu kurz. Maximal 45 Zeichen, minimal 3 Zeichen.";
        }
    }
   
    if(!isset($_POST['password'])){
       $fehler = $fehler."Kein Passwort gesetzt. ";
    }
    else{
        $letters = strlen($_POST['password']);
        if($letters > 45 OR $letters < 6){
            $fehler = $fehler."Passwort zu lang oder zu kurz. Maximal 45 Zeichen, minimal 6 Zeichen.";
        }
        if(preg_match('/[a-z]/', $_POST['password']))
        {}
        else{
            $fehler = $fehler."Das Passwort benötigt einen Kleinbuchstaben. ";
        }
        if(preg_match('/[A-Z]/', $_POST['password']))
        {}
        else{
            $fehler = $fehler."Das Passwort benötigt einen Grossbuchstaben. ";
        }
        if(preg_match('/[0-9]/', $_POST['password']))
        {}
        else{
            $fehler = $fehler."Das Passwort benötigt eine Zahl. ";
        }   
    }
    if(!isset($_POST['password_confirmed'])){
       $fehler = $fehler."Keine Passwort Bestätigung gesetzt. ";
    }
    $name = $_POST['username'];
    $password = sha1($_POST['password']);
    $password_confirmed = sha1($_POST['password_confirmed']);
    $lastonline = new DateTime();
     
    //Prüft ob E-Mail oder Benutezrname bereits vergeben sind
    $sql = "SELECT name FROM user where name='$name';";
    $result = Database::getData($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["name"]==$name){
                $fehler = $fehler."Benutzername bereits vergeben";
            }
        }
    }
    
    //Prüft ob die beiden Passwörter gleich sind
    if($password!=$password_confirmed){
       $fehler = $fehler."Das Passwort ist nicht gleich. ";
    }
    
    if($fehler==""){
        $serie = 0;
        $user = new User();
        $user->setUsername($name)
             ->setPassword($password)
             ->setLastonline($lastonline)
             ->setSerie($serie);
        $user->save(); 
                           }
    
}?>
    <h1>Registrieren</h1>
    <?php
if(isset($_POST['username']) AND $fehler!=""){ ?>

        <p style="color:red;">
            <?php echo $fehler; ?>
        </p>

        <form id='register' action='?p=register' method='post' accept-charset='UTF-8' enctype="multipart/form-data" autocomplete="on">
            <div class="register-form">
                <label for='username'>Benutzername*:</label>
                <input type='text' name='username' id='username' value="<?php echo $_POST['username']; ?>" maxlength="45" autocomplete="username" required/>
                <p id="username-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label for='password'>Passwort*:</label>
                <input type='password' name='password' id='password' maxlength="45" autocomplete="new-password" required/>
                <p id="password-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label for='password'>Passwort bestätigen*:</label>
                <input type='password' name='password_confirmed' id='password_confirmed' maxlength="45" required/>
                <p id="password-confirm-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label></label>
                <button class="button-green" type='submit' name='register-submit'>Registrieren</button>
            </div>
        </form>
        <?php } 
elseif(isset($_POST['register-submit']) AND $fehler==""){
    echo "Erfolgreich registriert!";
}
else{ ?>
        <form id='register' action='?p=register' method='post' accept-charset='UTF-8' enctype="multipart/form-data" autocomplete="on">
            <div class="register-form">
                <label for='username'>Benutzername*:</label>
                <input type='text' value="" name='username' id='username' maxlength="45" autocomplete="username" required/>
                <p id="username-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label for='password'>Passwort*:</label>
                <input type='password' value="" name='password' id='password' class="firstpw" maxlength="45" autocomplete="new-password" required/>
                <p id="password-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label for='password'>Passwort bestätigen*:</label>
                <input type='password' value="" name='password_confirmed' id='password_confirmed' maxlength="45" required/>
                <p id="password-confirm-alert" class="register-alert"></p>
            </div>
            <div class="register-form">
                <label></label>
                <button class="button-green" id="button-green" type='submit' name='register-submit'>Registrieren</button>
            </div>
        </form>
        <?php } ?>




        <script>
            
            






jQuery("#register").on("blur", "input[name=username]", function() {
    
    var username = jQuery(this).val();
    var url = "scripts/valid_username.php";
    jQuery.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: {
            username: username
        },
        success: function(data) {
setTimeout(function() { 
            $("#username-alert").text("");
            if (data != "") {

                $("#username-alert").append(data);
                $("#username-alert").css("color", "red");
                checkusername = false;
            } else {
                $("#username-alert").append("Benutzername noch verfügbar");
                $("#username-alert").css("color", "green");
                checkusername = true;
            }
    }, 2000); 
        },
           
        error: function(xhr, ajaxOptions, thrownError) {
            $('.error').toggleClass("hidden");
            $('.error').text(xhr.responseText);
            alert(xhr.responseText);
            alert(thrownError);
        }
    });
     
});
        </script>
