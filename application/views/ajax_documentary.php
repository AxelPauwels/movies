<div class="viewCovers">
	<?php
	foreach ($movies as $movie):
		$cover = imageUrl($movie->imageUrl,'title="' . $movie->naam . '" alt="' . $movie->naam . '" class="imgCover"');

		echo '<div class="covers" style="position: relative">' . PHP_EOL;

		switch ($movie->type) {
			case "DVD":
				echo '<div class="ribbon ribbonRIGHT DVD"><span>' . $movie->type . '</span></div>';
				break;
			case "HD":
				echo '<div class="ribbon ribbonRIGHT HD"><span>' . $movie->type . '</span></div>';
				break;
			case "3D":
				echo '<div class="ribbon ribbonRIGHT HD3D"><span>' . $movie->type . '</span></div>';
				break;
		}

		if (isset($movie->collectie)) {
			echo "<a href=''" . ' class="coverlink" data-id="0" data-seizoen-id="' . $movie->id . '">' . $cover . '</a>' . PHP_EOL;
		} else {
			echo "<a href=''" . ' class="coverlink" data-id="' . $movie->id . '"data-seizoen-id="0">' . $cover . '</a>' . PHP_EOL;
		}

		echo "</div>";
		?>
	<?php endforeach; ?>
</div>
