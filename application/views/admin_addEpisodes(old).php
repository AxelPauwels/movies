<?php
// +----------------------------------------------------------
// | ADMIN 
// +----------------------------------------------------------
?>

<script>
    function readFiles(imdb, taal, execute, folder) {
        $.ajax({type: "GET",
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
//FOLDER
echo div();
echo '<div class="input-group" style="width:100%">';
echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Folder</span>';
echo form_input(array(
    'name' => 'folder',
    'id' => 'folder',
    'size' => '30',
    'class' => 'form-control',
    'placeholder' => '1')) . "\n";
echo '</div>';
echo divClose();

//TAAL
echo div();
echo '<div class="input-group" style="width:100%">';
echo '<span class="input-group-addon" style="width:110px;background:#428bca;border:1px solid black;color:white">Taal</span>';
echo form_input(array(
    'name' => 'taal',
    'id' => 'taal',
    'size' => '30',
    'class' => 'form-control',
    'placeholder' => 'ENG')) . "\n";
echo '</div>';
echo divClose();

//IMDB
echo div();
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
?>

<div>
    <!--<button id="btnPreview" class="btn btn-default">Preview</button>-->
    <button id="btnExecute" class="btn btn-success size">Execute</button>
</div>

<div class="container ">
    <div id="resultaat"></div> 
</div>



