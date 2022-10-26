
<?php $this->layout('pagina', ['title' => $title]) ?>

<h1>Hello <?= $this->escape($name);?></h1>

<div id="ricerca">
    <div class="fst_ricerca">
        <?php echo $this->insert('fast_search')?>
    </div>
    <div class="adv_ricerca">
        <?php echo $this->insert('advance_search')?>
    </div>
</div><hr>
<?php echo $this->insert('cat_insert', ['function' => 'redirect'])?>
<hr>
<a href="backend/logout.php"><button>Logout</button></a>