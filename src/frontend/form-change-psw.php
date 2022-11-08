<form id="form-newPsw">
    <!-- First Psw Input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="user-chpsw">User</label>    
    <input type="text" name="user-chpsw" id="user-chpsw" class="form-control" disabled readonly>
  </div>
  <!-- First Psw Input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="newPsw">Nuova Password</label>    
    <input type="password" name="newPsw" id="newPsw" class="form-control" required>
  </div>
  <!-- password input -->
  <div class="form-outline mb-4">
      <label class="form-label" for="confirmPsw">Conferma Password</label>
      <input type="password" id="confirmPsw" name="confirmPsw" class="form-control" onkeyup="confirmPass()" required>
  </div>
  <div class="form-outline mb-4" id="error" hidden>
    <div class="alert alert-danger" role="alert">
      Le due password non coincidono!
    </div>
  </div>
  <!-- Buttons -->
  <button type="reset" class="btn btn-warning">Reset</button>
  <button type="button" id="btn-change-psw" class="btn btn-primary btn-block" onclick="postnewPsw()" disabled>Cambia Password</button>
</form>