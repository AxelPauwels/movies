<div class="viewList">
	<?php
	$template = array('table_open' => '<table class="table tablesorter" id="episodesTable" border="0" cellpadding="4" cellspacing="0">');
	$this->table->set_template($template);
	$this->table->set_heading('', '', '', '');
	$nr = 1;
	foreach ($seizoen->episodes as $episode) {
		$this->table->add_row($nr, $episode->naam, $episode->duur . 'u', $episode->grootte . 'GB');
		$nr++;
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
