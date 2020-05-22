<?php echo javascript("validator.js"); ?>

<div>
    <?php
    if (isset($settings)) {
        if ($settings != null) {
            foreach ($settings as $setting) {

                switch ($setting->config_name) {
                    case CONFIG_FLASHMESSAGE:
                        getFlashMessageHTML($setting);
                        break;
                }

            }
        }
    }

    ?>
</div>
<div style="color:white;">
	html for donation link (has maxlenght, todo: enlarge in database):<br>
	Oops ! Looks like this website is going offline. Do you use this site? You can read about a donation <a style="color:white" href="http://movies.sepagon.be/home/donation"><strong style="text-decoration:underline;">here</strong></a>.
</div>
