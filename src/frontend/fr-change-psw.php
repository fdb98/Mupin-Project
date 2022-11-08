<?php 
    $this->layout('pagina', ['title' => $title]);
    echo $this->insert("form-change-psw");
?>
<script src="scripts/newpsw.js"></script>
<script>
    const usr = <?="'".$_SESSION["User-ID"]."'";?>;
    newPswClick(usr);
</script>