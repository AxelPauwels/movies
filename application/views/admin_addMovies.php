<?php echo javascript("validator.js"); ?>

<div>
    <?php
    echo '<p>';

    if (isset($movieOfComedyOfDocumentary)) {
        if($movieOfComedyOfDocumentary == 'movie'){
            echo '<a href="' . site_url('admin/addMoviesManueel/movie') . '"<button class="btn btn-default size">Switch to Manueel</button> </a>';
        }

        if($movieOfComedyOfDocumentary == 'comedy'){
            echo '<a href="' . site_url('admin/addMoviesManueel/comedy') . '"<button class="btn btn-default size">Switch to Manueel</button> </a>';
        }
        // info: manual is not implemented for documentary
    }

    if (isset($successMessage)) {
        if ($successMessage == "success") {
            echo '<span style="color:var(--colorSuccess);font-size: 20px;padding-left:10px">';
            echo $successMessage;
            echo '</span>';
        }
    }
    '</p>';
    ?>
</div>

<div>
    <?php
    if (isset($movies)) {
        if ($movies != null) {
            $dataOpen = array(
                'id' => 'myform',
                'name' => 'myform',
                'data-toggle' => 'validator',
                'role' => 'form',
                'method' => 'POST',
                'style' => 'margin-bottom:30px');

            echo form_open('admin/insertMovies', $dataOpen);
            echo div();

            $teller = 0;
            echo '<div hidden><input hidden id="aantalFiles" name="aantalFiles" class="" style="width:100%" value="' . $aantalFiles . '"></div>';
            if (isset($movieOfComedyOfDocumentary)) {
                if($movieOfComedyOfDocumentary == 'movie'){
                    echo form_open('admin/insertMovies/movie', $dataOpen);
                }

                if($movieOfComedyOfDocumentary == 'comedy'){
                    echo form_open('admin/insertMovies/comedy', $dataOpen);
                }

                if($movieOfComedyOfDocumentary == 'documentary'){
                    echo form_open('admin/insertMovies/documentary', $dataOpen);
                }

                echo '<div hidden><input hidden id="movieOfComedyOfDocumentary" name="movieOfComedyOfDocumentary" class="" style="width:100%" value="' . $movieOfComedyOfDocumentary . '"></div>';
            }

            foreach ($movies as $movie) {
                echo '<div class="innerFormBlock" style="margin-bottom: 25px">';

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Titel</span>';
                echo form_input(array(
                        'name' => 'naam' . $teller,
                        'id' => 'naam' . $teller,
                        'size' => '30',
                        'value' => $movie->naam,
                        'class' => 'form-control',
                        'placeholder' => 'Titel')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Jaar</span>';
                echo form_input(array(
                        'name' => 'jaar' . $teller,
                        'id' => 'jaar' . $teller,
                        'size' => '30',
                        'value' => $movie->jaar,
                        'class' => 'form-control',
                        'placeholder' => '2019')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Type</span>';
                echo form_input(array(
                        'name' => 'type' . $teller,
                        'id' => 'type' . $teller,
                        'size' => '30',
                        'value' => $movie->type,
                        'class' => 'form-control',
                        'placeholder' => 'HD')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Taal</span>';
                echo form_input(array(
                        'name' => 'taal' . $teller,
                        'id' => 'taal' . $teller,
                        'size' => '30',
                        'value' => $movie->taal,
                        'class' => 'form-control',
                        'placeholder' => 'ENG')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Grootte</span>';
                echo form_input(array(
                        'name' => 'grootte' . $teller,
                        'id' => 'grootte' . $teller,
                        'size' => '30',
                        'value' => $movie->grootte,
                        'class' => 'form-control',
                        'placeholder' => '2.56')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Duur</span>';
                echo form_input(array(
                        'name' => 'duur' . $teller,
                        'id' => 'duur' . $teller,
                        'size' => '30',
                        'value' => $movie->duur,
                        'class' => 'form-control',
                        'placeholder' => '2.12')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Toegevoegd</span>';
                echo form_input(array(
                        'name' => 'toegevoegd' . $teller,
                        'id' => 'toegevoegd' . $teller,
                        'size' => '30',
                        'value' => $movie->toegevoegd,
                        'class' => 'form-control',
                        'placeholder' => '2016-11-25')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Download</span>';
                echo form_input(array(
                        'name' => 'download' . $teller,
                        'id' => 'download' . $teller,
                        'size' => '30',
                        'value' => $movie->download,
                        'class' => 'form-control',
                        'placeholder' => '1')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">IMDb</span>';
                echo form_input(array(
                        'name' => 'imdb' . $teller,
                        'id' => 'imdb' . $teller,
                        'size' => '30',
                        'value' => 'https',
                        'class' => 'form-control',
                        'placeholder' => 'http://www.imdb.com/title/tt8375987')) . PHP_EOL;
                echo '</div>';
                echo divClose();

                $teller++;
                echo '</div>'; //innerFormBlock
            };

            // enkel bij documentary (wanneer het een "seizoen" is)
            if($movieOfComedyOfDocumentary == 'documentary'){
                echo '<div style="color:white;">Optionele afbeelding voor alle bovenstaande documentaries (bij "seizoen-documentaries")</div>';

                echo div();
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Image</span>';
                echo form_input(array(
                        'name' => 'documentary-seizoen-image',
                        'id' => 'documentary-seizoen-image',
                        'size' => '30',
                        'value' => null,
                        'class' => 'form-control',
                        'placeholder' => 'MR ROBOT 3 2010')) . PHP_EOL;
                echo '</div>';
                echo divClose();
            }


            echo div();
            $dataSubmit = array(
                'type' => 'submit',
                'name' => 'mysubmit',
                'value' => 'Read & Save',
                'class' => 'btn btn-success size');
            echo form_submit($dataSubmit) . PHP_EOL;

            echo form_close();
            echo divClose();
            echo divClose(); //formclose
        }
    }

    ?>
</div>
