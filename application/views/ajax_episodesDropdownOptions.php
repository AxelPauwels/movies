<option value="0">Collectie...</option>
<?php
$options = array();
$vorige = "";
foreach ($episodesSeizoen as $seizoen) {
    if ($seizoen->collectie != $vorige) {
        ?>
        <option value="<?php echo $seizoen->collectie ?>"><?php echo $seizoen->collectie ." [". $seizoen->aantalSeizoenen . "]"  ; ?></option>
        <?php
    }
    $vorige = $seizoen->collectie;
}
?>