<?php
// +----------------------------------------------------------
// | Aanmelden
// +----------------------------------------------------------
?>

<?php echo javascript("validator.js"); ?>

<div id="userWachtwoord" class="col-sm-6 col-sm-offset-3" style="padding-top: 14%;margin-left: 23%">
    <?php
    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form');

    echo form_open('user/wachtwoordHerstel', $dataOpen);

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon profileMail"><i class="fa fa-envelope" style="width:25px" aria-hidden="true"></i></span>';
    echo form_input(array(
            'name' => 'email',
            'id' => 'email',
            'size' => '30',
            'type' => 'email',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Email',
            'readonly' => 'readonly',
            'onfocus' => "if (this.hasAttribute('readonly')) {
            this.removeAttribute('readonly');    this.blur();    this.focus();    this.placeholder = '' }",
            'onblur' => "this.placeholder = 'Email'",
            'autocomplete' => 'new-email',
            'required' => 'required',
            'data-error' => 'Vul een e-mail adres in')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo '<div class="form-group wachtwoordHerstelButton">';
    $dataSubmit = array(
        'type' => 'submit',
        'name' => 'mysubmit',
        'value' => 'HERSTEL',
        'class' => 'btn btn-primary size customInputSubmit',
        'style' => 'margin-left:20px');
    echo form_submit($dataSubmit) . "\n";

    echo form_close();

    echo divClose();
    ?>
</div>