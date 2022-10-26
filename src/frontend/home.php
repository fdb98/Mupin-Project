<?=$this->layout('pagina', ['title' => $title]) ?>
<figure>
    <img src="img/logo_mupin.png" alt='logo Mupin' width="100px">
    <figcaption><h1>Mupin</h1></figcaption>
</figure>

<div>
    <p>
        Vi raccontiamo la Storia dell'Informatica
    </p>
    <p>
        La storia dell’Informatica è la storia di buona parte delle cose con cui viviamo quotidianamente. Dal computer a Internet agli smartphone; dai video in streaming, alla formazione online e ai social network. Conoscendo e comprendendo la storia dell’Informatica siamo in grado di capire come si sviluppa e come cambia il mondo di oggi.
    </p>
</div>
<?php echo $this->insert('fast_search',['title' => $title])?>
<hr>
<h3><button><a href="r-advance_search.php">Ricerca Avanzata</a></button></h3>