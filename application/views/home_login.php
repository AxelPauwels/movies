<?php echo javascript("validator.js"); ?>

<div id="loginPage">
	<div>
	<h3 style="text-align: center;margin-left: 50px;margin-bottom:100px">Administrators only</h3>
	</div>
    <?php
    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form');

    echo form_open('home/aanmelden', $dataOpen);

//    echo div();
//    echo '<div class="input-group customInputGroup">';
//    echo '<span class="input-group-addon" ><i class="fa fa-user" style="width:25px" aria-hidden="true"></i></span>';
//    echo form_input(array(
//            'name' => 'email',
//            'id' => 'email',
//            'size' => '30',
//            'type' => 'email',
//            'class' => 'form-control customInput graylineCenter',
//            'placeholder' => 'Email',
//            'onfocus' => "this.placeholder = ''",
//            'onblur' => "this.placeholder = 'Email'",
//            'required' => 'required',
//            'data-error' => 'Vul een e-mail adres in')) . "\n";
//    echo '</div>';
//    echo divError();
//    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon "><i class="fa fa-unlock" style="width:25px" aria-hidden="true"></i></span>';
    echo form_password(array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control customInput graylineCenter',
            'placeholder' => 'Wachtwoord',
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Wachtwoord'",
            'required' => 'required',
            'data-error' => 'Vul een paswoord in')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo '<div class="form-group loginButton">';
    $dataSubmit = array(
        'id' => 'loginSubmit',
        'type' => 'submit',
        'name' => 'mysubmit',
        'value' => 'LOGIN',
        'class' => 'btn btn-primary size customInputSubmit');
    echo form_submit($dataSubmit) . "\n";
    echo form_close();
    echo divClose();

//    echo '<div id="loginVergeten">';
//    echo '<p>';
//    echo anchor('user/nieuw', 'Registreren');
//    echo '<span style="color:#999;padding-left: 7px;padding-right: 5px">|</span> ';
//    echo anchor('user/wachtwoord', 'Wachtwoord vergeten');
//    echo '</p>';
//    echo '</div>';

    ?>
</div>
