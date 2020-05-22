<?php

foreach ($seizoen->episodes as $episode) {
    $cover = image('episodes/' . $seizoen->naam . ".png",
        'title="' . $episode->naam . '" alt="' . $seizoen->naam . '" style="opacity: 0.75;" ');
    $downloadLogo = '<i class="fa fa-download fa-lg downloadActief textShadowSmall" aria-hidden="true"></i>';

    echo '<div class="covers episode-advanced-search-result-cover-view">' . PHP_EOL;

    if ($episode->download == 1) {
        $downloadLink = '<a class="downloadCountEpisodes" data-id="' . $episode->id . '" href="'.FTP_PATH_TO_EPISODES . $episode->downloadNaam . '">' . $cover . '</a>' . PHP_EOL;
        echo '<a class="downloadCountEpisodes" data-id="' . $episode->id . '" href="'. FTP_PATH_TO_EPISODES  . $episode->downloadNaam . '">' . $cover . '</a>' . PHP_EOL;
    } else {
        $downloadLogo = '<i class="fa fa-download fa-lg downloadInactief textShadowSmall" aria-hidden="true"></i>';
        echo '<a data-id="' . $episode->id . '" data-naam="' . $episode->naam . '" data-usernaam="' . $user->naam . '" value="requestCountEpisodes" class="requestCountEpisodes">' . $cover . '</a>' . PHP_EOL;
    }

    echo '<div class="additional-layer-episodes-search">' . $downloadLogo . '</div>';
    echo '</div>' . PHP_EOL;
}

