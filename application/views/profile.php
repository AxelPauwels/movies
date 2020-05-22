<?php echo javascript("validator.js"); ?>

<div id="profile">
    <?php

    echo '<div class="col-sm-6 col-sm-offset-3">';
    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form'
    );

    echo form_open('user/registreerUpdate', $dataOpen);
    echo form_hidden('id', $user->id);

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon" style="width:50px">
        <i class="fa fa-user-circle" aria-hidden="true"></i></span>';
    echo form_input(array(
            'name' => 'naam',
            'id' => 'naam',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'value' => $user->naam,
            'required' => 'required',
            'data-error' => 'Vul uw naam in'
        )) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon" style="width:50px">
        <i class="fa fa-envelope" aria-hidden="true"></i></span>';
    echo form_input(array(
            'name' => 'email',
            'id' => 'email',
            'size' => '30',
            'type' => 'email',
            'class' => 'form-control customInput grayline',
            'value' => $user->email,
            'required' => 'required',
            'data-error' => 'Vul een e-mail adres in'
        )) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon" style="width:50px">
        <i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>';
    echo form_password(array(
            'name' => 'password',
            'id' => 'password',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Nieuw wachtwoord (optioneel)',
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Nieuw wachtwoord (optioneel)'",
            'autocomplete' => 'new-password',
            'data-error' => 'Vul een wachtwoord in'
        )) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon" style="width:50px">
        <i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>';
    echo form_password(array(
            'name' => 'password2',
            'id' => 'password2',
            'size' => '30',
            'placeholder' => 'Nieuw wachtwoord herhalen',
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Nieuw wachtwoord herhalen'",
            'class' => 'form-control customInput grayline',
            'data-error' => 'Herhaal het wachtwoord'
        )) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo '<div class="form-group updateButton">';
    $dataSubmit = array(
        'type' => 'submit',
        'name' => 'mysubmit',
        'value' => 'UPDATE ACCOUNT',
        'class' => 'btn btn-success size customInputSubmit',
        'style' => 'width:100%;margin-left:5px'
    );
    echo form_submit($dataSubmit) . "\n";
    echo divClose();
    echo form_close();
    echo '</div>';

    echo '<div class="clearfix"></div>';

	$futureDate = date('Y-m-d', strtotime(' + 365 day', strtotime($user->geabonneerd)));

	echo '<div class="col-sm-6 col-sm-offset-3" style="margin-top: 6px">';
    echo '<p class="customTextBlue" style="margin-left: 50px">' .
        'Actief: <span class="customTextGray">Ja</span><br />' . "\n" .
        'Geactiveerd sinds: <span class="customTextGray">' .
        toDDMMYYYY($user->creatie) . '</span><br />' . "\n" .
        'Laatst aangemeld: <span class="customTextGray">' .
        toDDMMYYYY($user->laatstAangemeld) . '</span><br />' . "\n" .
        'Geabonneerd tot: <span class="customTextGray">' .
        toDDMMYYYY($futureDate) . '</span><br />' . "\n" .

        'Aantal downloads: <span class="customTextGray">' .
        $user->gedownload . '</span><br />' . "\n" .
        '</p>';
    echo '<p id="deleteMyAccount" style="margin-left: 50px">';
    echo anchor('user/profileDeleteBevestiging/' . $user->id, 'Delete account');
    echo '</p>';

    ?>
</div>
