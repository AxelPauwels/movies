<div class="viewCovers">
	<?php
	foreach ($episodesSeizoen as $seizoen) :
		$cover = imageUrl($seizoen->imageUrl,'title="' . $seizoen->naam . '" alt="' . $seizoen->naam . '" class="imgCover"');

		echo '<div class="covers" style="position: relative">' . PHP_EOL;

		switch ($seizoen->type) {
			case "DVD":
				echo '<div class="ribbon ribbonRIGHT DVD"><span>' . $seizoen->type . '</span></div>';
				break;
			case "HD":
				echo '<div class="ribbon ribbonRIGHT HD"><span>' . $seizoen->type . '</span></div>';
				break;
			case "3D":
				echo '<div class="ribbon ribbonRIGHT HD3D"><span>' . $seizoen->type . '</span></div>';
				break;
		}

		echo "<a href=''" . ' class="coverlink" data-id="' . $seizoen->id . '">' . $cover . '</a>' . PHP_EOL;

		echo "</div>";
		?>
	<?php endforeach; ?>
</div>
