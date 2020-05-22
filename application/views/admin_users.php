<div id="admin_requests" class="viewList responsive">
    <?php
    $template = array('table_open' => '<table id="usersTable" class="table tablesorter" border="0" cellpadding="4" cellspacing="0">');
    $this->table->set_template($template);
    $this->table->set_heading('<i class="fa fa-sort" aria-hidden="true"> Naam</i>', '<i class="fa fa-sort" aria-hidden="true"> Id</i>', '<i class="fa fa-sort" aria-hidden="true"> Email</i>', '<i class="fa fa-sort" aria-hidden="true"> Aangemeld</i>', '<i class="fa fa-sort" aria-hidden="true"> Downloads</i>', '<i class="fa fa-sort" aria-hidden="true"> Actief</i>', '<i class="fa fa-sort" aria-hidden="true"> Sinds</i>','');

    foreach ($users as $user) {
        $actief = '';
        if ($user->geactiveerd == 1) {
            $actief = 'Ja';
        }
        else {
            $actief = 'nee';
        }

		$geaboneerdIconClass = 'fa-times fa-red fa-admin';
        if (subscriptionIsValid($user->geabonneerd)) {
        	$geaboneerdIconClass = 'fa-check fa-limegreen fa-admin';
		}

        $this->table->add_row($user->naam,
			$user->id,
			$user->email,
			toDDMMYYYY($user->laatstAangemeld),
			$user->gedownload,
			$actief,
			toDDMMYYYY($user->creatie),
			'<i class="fa '. $geaboneerdIconClass. '" aria-hidden="true"></i>',
			anchor('admin/updateSubscription/'. $user->id, '<i class="fa fa-plus-square" aria-hidden="true"></i>')
		);
    }
    echo $this->table->generate();
    ?>
</div>
<script>
    $(function () {
        $("#usersTable").tablesorter();
    });
</script>
