
<?php $this->layout('pagina', ['title' => $title]) ?>
<div class="container">  <!-- text-center-->
    <h1 style="color: #249C94;">Reserved Area</h1>
    <h2>Hello <?= $this->escape($name);?></h2>
    <div>
    <?php
        if($_SESSION["User-ID"] === "admin@mupin.it"){
            echo "<button type='button' class='btn btn-success' onclick='location.href=\"r-manage_admin.php\"'>Gestore Admin</button>";
        }
    ?>
        <button type='button' class='btn btn-danger' onclick="location.href='backend/logout.php'">Logout</button>
        <hr>
    </div>
    <div class="row">
      <div class="col">
          <?php echo $this->insert('advance_search')?>
      </div>
      <div class="col">
          <?php echo $this->insert('fast_search')?>
      </div>
    </div>
    <div class="row">
      <?php echo $this->insert('cat_insert', ['function' => 'redirect'])?>
    </div>
</div>

