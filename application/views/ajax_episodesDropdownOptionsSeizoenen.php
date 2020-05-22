<option value="0">Seizoen...</option>
<?php
$options = array();
foreach ($episodesSeizoen as $seizoen) {
    ?>
    <option value="<?php echo $seizoen->id ?>"><?php echo $seizoen->naam ?></option>
    <?php
}
?>