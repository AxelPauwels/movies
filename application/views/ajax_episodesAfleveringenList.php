<div class="viewList">
    <?php
    $template = array('table_open' => '<table class="table tablesorter" id="episodesTable" border="0" cellpadding="4" cellspacing="0">');
    $this->table->set_template($template);
    $this->table->set_heading('', '', '', '', '');
    $nr = 1;
    foreach ($seizoen->episodes as $episode) {
        if ($episode->download == 1) {
            $downloadLogo = '<i style="padding-left:10px" class="fa fa-download fa-lg downloadActief textShadowSmall" aria-hidden="true"></i>';
            $downloadLink = '<a class="downloadCountEpisodes" data-id="' . $episode->id . '" href="'. FTP_PATH_TO_EPISODES  . $episode->downloadNaam . '">' . $downloadLogo . '</a>' . "\n";
            $this->table->add_row($nr, $episode->naam, $episode->duur . 'u', $episode->grootte . 'gb', $downloadLink);
        } else {
            $requestLogo = '<a data-id="' . $episode->id . '" value="requestCountEpisodes" class="requestCountEpisodes"><i style="padding-left:10px" class="fa fa-download fa-lg downloadInactief textShadowSmall" aria-hidden="true"></i></a>';
            $this->table->add_row($nr, $episode->naam, $episode->duur . 'u', $episode->grootte . 'gb', $requestLogo);
        }
        $nr ++;
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
