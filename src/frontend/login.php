<?php

    $this->layout('pagina', ['title' => $title]) ?>
    <h1>Login</h2>

    <form action="backend/session.php"  method="post">
        <fieldset>
            <legend>Informazioni Personali</legend>
            <p>        
                <label for="email">E-mail:*</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:*</label>
                <input type="password" name="password" id="password" required>
                <?php //<br>Non sei ancora registrato? <a href="signup.html">Registrati qui!</a> ?>
            </p>
            <?php
                $sessione = $_SESSION["logged"] ?? 0;
                if($sessione===false){ 
                    echo "<h4 style='color: red;'>Email o password sbagliati!";
                    session_unset();
                    session_destroy();
                }
                
            ?>
        </fieldset>
        <p>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </p>
    </form>