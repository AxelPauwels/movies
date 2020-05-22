<div class="infoModal viewList">
	<?php
	$logoTaal = image('logos/' . $seizoen->taal . ".png",
		'width="40px" height="22px" style="border:0.15px solid black;border-radius:2px"');

	$logoIMDB = image('logos/logoIMDB.png',
		'width="40px" height="22px" style="border:0.15px solid black;border-radius:4px"');
	$linkIMDB = '<a target="_blank" href="' . $seizoen->imdb . '">' . $logoIMDB . '</a>';

	echo '<h3>' . $seizoen->naam . '</h3><br />' . PHP_EOL;

	$template = array('table_open' => '<table class="table noHoverAllowed" border="0" cellpadding="4" cellspacing="0">');
	$this->table->set_template($template);
	$this->table->add_row();
	$this->table->add_row("Jaar", "Duur", "Grootte", "Kwaliteit", "Taal", "Info");
	$this->table->add_row($seizoen->jaar, toDubbelePunt($seizoen->totaleDuur) . ' u', $seizoen->totaleGrootte . ' GB',
		$seizoen->type, $logoTaal, $linkIMDB);
	echo $this->table->generate();

	echo '<br/><br/>';

	echo "<h4>EPISODES</h4>";
	$template2 = array('table_open' => '<table class="table table-condensed " id="episodesTable" border="0" cellpadding="4" cellspacing="0">');
	$this->table->set_template($template2);
	$this->table->set_heading('', '', '', '');

	$nr = 1;
	foreach ($seizoen->episodes as $episode) {
		$this->table->add_row($nr, $episode->naam, $episode->duur . 'u', $episode->grootte . 'GB');
		$nr++;
	}
	echo $this->table->generate();
	?>
</div>
