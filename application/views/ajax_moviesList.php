<div class="viewList">
    <?php
    $template = array('table_open' => '<table id="movieListTable" class="table tablesorter" border="0" cellpadding="4" cellspacing="0">');
    $this->table->set_template($template);
    $this->table->set_heading('<i class="fa fa-sort" aria-hidden="true"></i>',
        '<i class="fa fa-sort" aria-hidden="true"></i>', '');

    foreach ($movies as $movie) {
        $detailKnop = "<a href=''" . ' class="coverlink" data-id="' . $movie->id . '">' .
			'<i class="fa fa-info-circle fa-lg" aria-hidden="true" style="text-shadow: 0.5px 0.5px black"></i>' . '</a>' . "\n";
        $this->table->add_row($movie->naam, $movie->jaar, $detailKnop);
    }
    echo $this->table->generate();
    ?>
</div>

<script>
    $(function () {
        $("#movieListTable").tablesorter();
        var td = $("td");
        td.hover(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#428bca", "cursor": "pointer"});
        });
        td.mouseleave(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#999", "cursor": "default"});
        });
    });
</script>
