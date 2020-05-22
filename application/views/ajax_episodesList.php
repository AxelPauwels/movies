<div class="viewList">
    <?php
    $template = array('table_open' => '<table id="episodesListTable" class="table tablesorter" border="0" cellpadding="4" cellspacing="0">');
    $this->table->set_template($template);
    $this->table->set_heading('<i class="fa fa-sort" aria-hidden="true"></i>', '<i class="fa fa-sort" aria-hidden="true"></i>');

    foreach ($episodesSeizoen as $seizoen) {
        $detailKnop = "<a href=''" . ' class="coverlink" data-id="' . $seizoen->id . '">' . '<i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>' . '</a>' . PHP_EOL;
        $this->table->add_row($seizoen->naam, $seizoen->jaar, $detailKnop);
    }

    echo $this->table->generate();
    ?>
</div>

<script>
    $(function () {
        $("#episodesListTable").tablesorter();
        var td = $("td");
        td.hover(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#428bca", "cursor": "pointer"});
        });
        td.mouseleave(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#999", "cursor": "default"});
        });
    });
</script>
