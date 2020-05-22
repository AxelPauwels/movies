<?php
// +----------------------------------------------------------
// | ADMIN 
// +----------------------------------------------------------
?>

<script>
    function readFiles(imdb, taal, execute, folder) {
        $.ajax({
            type: "GET",
            url: site_url + "/admin/ajaxReadFiles",
            data: {execute: execute, imdb: imdb, taal: taal, folder: folder},
            success: function (result) {
                $("#resultaat").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function () {
        $('#btnPreview').click(function () {
            var imdb = $("#imdb").val();
            var taal = $("#taal").val();
            var folder = $("#folder").val();
            var execute = "";
            readFiles(imdb, taal, execute, folder);
        });
        $('#btnExecute').click(function () {
            var imdb = $("#imdb").val();
            var taal = $("#taal").val();
            var folder = $("#folder").val();
            var execute = "YES";
            readFiles(imdb, taal, execute, folder);
        });
    });
</script>


<?php echo javascript("validator.js"); ?>

<?php
if (isset($successMessage)) {
    if ($successMessage == "success") {
        echo '<span style="color:var(--colorSuccess);font-size: 20px;padding-left:10px">';
        echo $successMessage;
        echo '</span>';
    }
}
?>

<div>
    <?php
    if (isset($episodes)) {
        if ($episodes != null) {
            $dataOpen = array(
                'id' => 'myform',
                'name' => 'myform',
                'data-toggle' => 'validator',
                'role' => 'form',
                'method' => 'POST',
                'style' => 'margin-bottom:30px');

            echo div();

            $teller = 0;
            if (isset($episodeOfDocumentary)) {
                if ($episodeOfDocumentary == 'documentary') {
                    echo form_open('admin/insertEpisodesSeizoen/documentary', $dataOpen);
                }
                elseif ($episodeOfDocumentary == "episode") {
                    echo form_open('admin/insertEpisodesSeizoen/episode', $dataOpen);
                }
                echo '<div hidden><input hidden id="movieOfComedyOfDocumentary" name="movieOfComedyOfDocumentary" class="" style="width:100%" value="' . $episodeOfDocumentary . '"></div>';
                echo '<div hidden><input hidden id="aantalFolders" name="aantalFolders" style="width:100%" value="' . $aantalFolders . '"></div>';
            }

            foreach ($episodes as $seizoen) {
                echo '<div class="innerFormBlock" style="margin-bottom: 25px">';

                echo div();
//    echo form_label('Naam:', 'naam') . "\n";
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Titel</span>';
                echo form_input(array(
                        'name' => 'naam' . $teller,
                        'id' => 'naam' . $teller,
                        'size' => '30',
                        'value' => $seizoen,
                        'class' => 'form-control',
                        'placeholder' => 'Titel')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
//    echo form_label('Taal:', 'taal') . "\n";
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:darkslategray">Taal</span>';
                echo form_input(array(
                        'name' => 'taal' . $teller,
                        'id' => 'taal' . $teller,
                        'size' => '30',
                        'value' => 'ENG',
                        'class' => 'form-control',
                        'placeholder' => 'ENG')) . "\n";
                echo '</div>';
                echo divClose();

                echo div();
//    echo form_label('IMDb Link:', 'imdb') . "\n";
                echo '<div class="input-group" style="width:100%">';
                echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">IMDb</span>';
                echo form_input(array(
                        'name' => 'imdb' . $teller,
                        'id' => 'imdb' . $teller,
                        'size' => '30',
                        'value' => 'https',
                        'class' => 'form-control',
                        'placeholder' => 'https')) . "\n";
                echo '</div>';
                echo divClose();

                $teller++;
                echo '</div>'; //innerFormBlock
            };

            echo div();
            $dataSubmit = array(
                'type' => 'submit',
                'name' => 'mysubmit',
                'value' => 'Read & Save',
                'class' => 'btn btn-success size');
            echo form_submit($dataSubmit) . "\n";

            echo form_close();
            echo divClose();
            echo divClose(); //formclose
        }
    }
    ?>

