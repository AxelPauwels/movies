<?php
// +----------------------------------------------------------
// | ADMIN 
// +----------------------------------------------------------
?>

<?php echo javascript("validator.js"); ?>

<div>
    <?php
    if (isset($movieOfComedyOfDocumentary)) {
        if ($movieOfComedyOfDocumentary == 'movie') {
            echo '<p><a href="' . site_url('admin/ajaxReadFilesMovies/movie') . '"<button class="btn btn-default size">Switch to Reader</button> </a></p>';
        }
        else {
            echo '<p><a href="' . site_url('admin/ajaxReadFilesMovies/comedy') . '"<button class="btn btn-default size">Switch to Reader</button> </a></p>';
        }
    }
    ?>
</div>

<div>
    <?php
    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form');

    if (isset($movieOfComedyOfDocumentary)) {
        if ($movieOfComedyOfDocumentary == 'comedy') {
            echo form_open('admin/insertMovieManueel/comedy', $dataOpen);
        }
        else {
            echo form_open('admin/insertMovieManueel/movie', $dataOpen);
        }
        echo '<div hidden><input hidden id="movieOfComedyOfDocumentary" name="movieOfComedyOfDocumentary" class="" style="width:100%" value="' . $movieOfComedyOfDocumentary . '"></div>';
    }

    echo div();
    //    echo form_label('Naam:', 'naam') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Titel</span>';
    echo form_input(array(
            'name' => 'naam',
            'id' => 'naam',
            'size' => '30',
            'class' => 'form-control',
            'placeholder' => 'Titel')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Jaar:', 'jaar') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Jaar</span>';
    echo form_input(array(
            'name' => 'jaar',
            'id' => 'jaar',
            'size' => '30',
            'value' => 2019,
            'class' => 'form-control',
            'placeholder' => '2019')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Type:', 'type') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Type</span>';
    echo form_input(array(
            'name' => 'type',
            'id' => 'type',
            'size' => '30',
            'value' => 'HD',
            'class' => 'form-control',
            'placeholder' => 'HD')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Taal:', 'taal') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Taal</span>';
    echo form_input(array(
            'name' => 'taal',
            'id' => 'taal',
            'size' => '30',
            'value' => 'ENG',
            'class' => 'form-control',
            'placeholder' => 'ENG')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Grootte:', 'grootte') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Grootte</span>';
    echo form_input(array(
            'name' => 'grootte',
            'id' => 'grootte',
            'size' => '30',
            'class' => 'form-control',
            'placeholder' => '2.56')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Duur:', 'duur') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Duur</span>';
    echo form_input(array(
            'name' => 'duur',
            'id' => 'duur',
            'size' => '30',
            'class' => 'form-control',
            'placeholder' => '2.12')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Toegevoegd:', 'toegevoegd') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Toegevoegd</span>';
    echo form_input(array(
            'name' => 'toegevoegd',
            'id' => 'toegevoegd',
            'size' => '30',
            'value' => $huidigeDatum,
            'class' => 'form-control',
            'placeholder' => '2016-11-25')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('Downloadbaar:', 'download') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Download</span>';
    echo form_input(array(
            'name' => 'download',
            'id' => 'download',
            'size' => '30',
            'value' => 1,
            'class' => 'form-control',
            'placeholder' => '1')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    //    echo form_label('IMDb Link:', 'imdb') . "\n";
    echo '<div class="input-group" style="width:100%">';
    echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">IMDb</span>';
    echo form_input(array(
            'name' => 'imdb',
            'id' => 'imdb',
            'size' => '30',
            'class' => 'form-control',
            'placeholder' => 'http://www.imdb.com/title/tt8375987')) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    $dataSubmit = array(
        'type' => 'submit',
        'name' => 'mysubmit',
        'value' => 'Insert',
        'class' => 'btn btn-success size');
    echo form_submit($dataSubmit) . "\n";

    echo form_close();
    echo divClose();
    ?>
</div>
