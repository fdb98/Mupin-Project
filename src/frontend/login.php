<?php

    $this->layout('pagina', ['title' => $title]) ?>

    <h1>Login</h1>
    
    <main class="form-signin text-center w-80">
      <form action="backend/session.php" method="post">
        <img class="mb-4" src="./Signin Template · Bootstrap v5.0_files/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Login per accedere all'Area Riservata</h1>
    
        <div class="form-floating">
          <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <?php
                $sessione = $_SESSION["logged"] ?? 0;
                if($sessione===false){ 
                    echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"font-weight: 14px\">Email o password sbagliati!";
                    session_unset();
                    session_destroy();
                    echo "</div>";
                }
                
            ?>
    
        <!--<div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>-->
        <div class="container">
            <div class="row">
                <div class="col">
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button> <!-- w-100 -->
            
                </div>
                <div class="col">
                    <button class="w-100 btn btn-lg btn-warning" type="reset" value="Reset">Reset</button>
                </div>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
      </form>
    </main>
    

<script>
    document.getElementsByTagName("body").item(0).classList.add("text-center");
</script>