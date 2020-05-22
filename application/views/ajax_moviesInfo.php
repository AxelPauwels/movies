<div class="infoModal viewList">
	<?php
	echo '<h3>' . $movie->naam . '</h3><br/>' . PHP_EOL;

	$logoTaal = image('logos/' . $movie->taal . ".png",
		'width="40px" height="22px" style="border:0.15px solid black;border-radius:2px" ');
	$logoIMDB = image('logos/logoIMDB.png',
		'width="40px" height="22px" style="border:0.50px solid black;border-radius:4px" ');
	$linkIMDB = '<a target="_blank" href="' . $movie->imdb . '">' . $logoIMDB . '</a>';

	$template = array('table_open' => '<table class="table noHoverAllowed" border="0" cellpadding="4" cellspacing="0">');
	$this->table->set_template($template);
	$this->table->add_row();
	$this->table->add_row("Jaar", "Duur", "Grootte", "Kwaliteit", "Taal", "Info");
	$this->table->add_row($movie->jaar, toDubbelePunt($movie->duur) . ' u', $movie->grootte . ' GB', $movie->type,
		$logoTaal, $linkIMDB);
	echo $this->table->generate();

	//show extra info
	if ($movie->fileFormat !== null) {
		echo '<h4 class="extra-info">Specificaties</h4>';
		echo '<ul class="extra-info__list">';
		echo "<li class='extra-info__title'>File</li>";
		if ($movie->fileFormat !== null) {
			echo "<li class='extra-info__item'>Formaat: $movie->fileFormat</li>";
		}
		if ($movie->mimeType !== null) {
			echo "<li class='extra-info__item'>MimeType: $movie->mimeType</li>";
		}
		if ($movie->encoding !== null) {
			echo "<li class='extra-info__item'>Codering: $movie->encoding</li>";
		}
		if ($movie->bitrate !== null) {
			echo "<li class='extra-info__item'>Bitrate: $movie->bitrate</li>";
		}
		echo '</ul>';

		echo '<ul class="extra-info__list">';
		echo "<li class='extra-info__title'>Video</li>";
		if ($movie->videoDataformat !== null) {
			echo "<li class='extra-info__item'>Dataformaat: $movie->videoDataformat</li>";
		}
		if ($movie->videoResolution !== null) {
			echo "<li class='extra-info__item'>Resolutie: $movie->videoResolution</li>";
		}
		if ($movie->videoPixelAspectRatio !== null) {
			echo "<li class='extra-info__item'>PixelAspectRatio: $movie->videoPixelAspectRatio</li>";
		}
		if ($movie->videoFrameRate !== null) {
			echo "<li class='extra-info__item'>FrameRate: $movie->videoFrameRate</li>";
		}
		echo '</ul>';

		echo '<ul class="extra-info__list">';
		echo "<li class='extra-info__title'>Audio</li>";
		if ($movie->audioCodec !== "") {
			echo "<li class='extra-info__item'>Codec: $movie->audioCodec</li>";
		}
		if ($movie->audioSampleRate !== 0.00) {
			echo "<li class='extra-info__item'>SampleRate: $movie->audioSampleRate</li>";
		}
		if ($movie->audioBitsPerSample !== 0) {
			echo "<li class='extra-info__item'>BitsPerSample: $movie->audioBitsPerSample</li>";
		}
		if ($movie->audioChannelmode !== null) {
			echo "<li class='extra-info__item'>Channelmode: $movie->audioChannelmode</li>";
		}
		if ($movie->audioChannels !== 0) {
			echo "<li class='extra-info__item'>Channels: $movie->audioChannels</li>";
		}
		echo '</ul>';
	}
	?>
</div>
