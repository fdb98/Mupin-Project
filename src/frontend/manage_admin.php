<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => $title]);
    use Classidb\Classlogin;
      $cn = new Classlogin;
      $pdo = $cn->superadmin();
      $query = "SELECT user from logindb WHERE user!='admin@mupin.it'";
      $sth = $pdo->prepare($query);
      $sth->execute();

      ?>
  <h1 style="color: #249C94;">
     MODIFICA ADMIN
  </h1>

    <div>
      <fieldset>
          <table class="table thead-dark">
            <thead>
                <th>User</th>
                <th>Permessi</th>
                <th>Password</th>
                <th>Elimina</th>
            </thead>
            <tbody>
              <?php
                
                for($i=0; $i<$sth->rowCount(); $i++){
                  echo "<tr id='$i'>";
                  $user_admin = $sth->fetch();
                  $user_admin = $user_admin[0];
                  echo "<td><p id='user_$i'>$user_admin</p></td>";
                  echo "<td><input type='checkbox' value='".false."'/></td>";
                  echo "<td><button type='button' class='btn btn-warning' data-bs-toggle=\"modal\" data-bs-target=\"#changePswModal\" onclick=\"newPswClick('".$user_admin."')\">Cambia Password</button></td>";
                  echo "<td><button class='btn btn-danger' type='button' onclick='elimina_admin($i)'>Elimina</button></td>";
                  echo "</tr>";
                }
                
              ?>
              </tbody>
          </table>                         

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">
                  Nuovo Admin
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi Nuovo Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
                      </div>
                      <div class="modal-body">
                      <form id="mioform">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                              <label class="form-label" for="email2">Email</label>    
                              <input type="email" name="email" id="email2" class="form-control" required>
                            </div>
                      
                            <!-- password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password2">Password</label>
                                <input type="password" id="password2" name="password" class="form-control" required>
                            </div>
                      
                            <!-- Submit button -->
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="button" class="btn btn-primary btn-block" onclick="signup()">Sign up</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload()">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                
            <?php /******* MODAL NEW PASSWORD***** */ ?>
                <!-- Modal -->
                <div class="modal fade" id="changePswModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambia Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
                      </div>
                      <div class="modal-body">
                        <?= $this->insert('form-change-psw')?>
                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload()">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

        </form>
      </fieldset>
    </div>
    <script src="scripts/elimina.js"></script>
    <script src="scripts/newpsw.js"></script>

    <script>
      function signup(params) {
        if(validateEmail(document.getElementById("email2").value) && document.getElementById("password2").value!=""){  
        $.post('backend/signup.php', $("#mioform").serialize()
        )
        .done(function(msg){
          if(msg==1){
            alert("Admin Aggiunto con successo!");
          }
          else{
            if(msg==0) alert("Già presente! Cambia user o riprova!");
            else  alert("Errore nella comunicazione con il server. Riprovare!");
          }
        })
      }
      else{
        if(document.getElementById("email2")=="") alert("La mail immessa, non è una mail valida");
        else alert("Completa il form!");
      }
    }

    function validateEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }

      
    </script>