<?php
// +----------------------------------------------------------
// | Registreren
// +----------------------------------------------------------
?>

<?php echo javascript("validator.js"); ?>

<div id="userNieuw" class="col-sm-6 col-sm-offset-3" style="padding-top: 3%;margin-left: 23%">
    <?php
    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form');

    echo form_open('user/registreer', $dataOpen);

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon"><i class="fa fa-user" style="width:25px" aria-hidden="true"></i></span>';
    echo form_input(array(
            'name' => 'naam',
            'id' => 'naam',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Gebruikersnaam',
//            'readonly' => 'readonly',
//            'onfocus' => "if (this.hasAttribute('readonly')) {
//            this.removeAttribute('readonly');    this.blur();    this.focus();    this.placeholder = '' }",            'onblur' => "this.placeholder = 'Gebruikersnaam'",
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Gebruikersnaam'",
            'required' => 'required',
            'data-error' => 'Vul uw naam in')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

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

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon"><i class="fa fa-lock" style="width:25px" aria-hidden="true">  </i></span>';
    echo form_password(array(
            'name' => 'password',
            'id' => 'password',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Wachtwoord',
//            'readonly' => 'readonly',
//            'onfocus' => "if (this.hasAttribute('readonly')) {
//            this.removeAttribute('readonly');    this.blur();    this.focus();    this.placeholder = '' }", 'onblur' => "this.placeholder = 'Wachtwoord'",
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Wachtwoord'",
            'autocomplete' => 'new-password',
            'required' => 'required',
            'data-error' => 'Vul een wachtwoord in')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon"><i class="fa fa-lock" style="width:25px" aria-hidden="true">  </i></span>';
    echo form_password(array(
            'name' => 'password2',
            'id' => 'password2',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Wachtwoord herhalen',
//            'readonly' => 'readonly',
//            'onfocus' => "if (this.hasAttribute('readonly')) {
//            this.removeAttribute('readonly');    this.blur();    this.focus();    this.placeholder = '' }", 'onblur' => "this.placeholder = 'Wachtwoord herhalen'",
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Wachtwoord herhalen'",
            'autocomplete' => 'new-password',
            'required' => 'required',
            'data-error' => 'Herhaal het wachtwoord')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo div();
    echo '<div class="input-group customInputGroup">';
    echo '<span class="input-group-addon"><i class="fa fa-key" style="width:25px" aria-hidden="true"></i></span>';
    echo form_input(array(
            'name' => 'Rcode',
            'id' => 'Rcode',
            'size' => '30',
            'class' => 'form-control customInput grayline',
            'placeholder' => 'Registration Key',
//            'readonly' => 'readonly',
//            'onfocus' => "if (this.hasAttribute('readonly')) {
//            this.removeAttribute('readonly');    this.blur();    this.focus();    this.placeholder = '' }", 'onblur' => "this.placeholder = 'Registration Key'",
            'onfocus' => "this.placeholder = ''",
            'onblur' => "this.placeholder = 'Registration Key'",
            'autocomplete' => 'off',
            'required' => 'required',
            'data-error' => 'Vul de registratiecode in')) . "\n";
    echo '</div>';
    echo divError();
    echo divClose();

    echo '<div class="form-group registreerButton">';
    $dataSubmit = array(
        'type' => 'submit',
        'name' => 'mysubmit',
        'value' => 'REGISTREER',
        'class' => 'btn btn-primary size customInputSubmit',
        'style' => 'margin-left:20px');

    echo form_submit($dataSubmit) . "\n";
    echo form_close();
    echo divClose();
    ?>
    <p hidden id="passwordsDontMatchMessage" style="text-align: center;padding-left: 23px;padding-top:5px;color:var(--colorDanger)">Paswoorden komen niet overeen</p>
</div>

<script>
    function showMessage() {
        console.log("showMessage");
        $('p#passwordsDontMatchMessage').show();
    }

    function hideMessage() {
        console.log("hideMessage");
        $('p#passwordsDontMatchMessage').hide();

    }

    var readyToSubmit = false;
    $(document).ready(function () {
        $('input.customInputSubmit').click(function (e) {
            if (!readyToSubmit) {
                e.preventDefault();
                if ($('input#password').val() == $('input#password2').val()) {
                    readyToSubmit = true;
                    hideMessage();
                    $('#myform').submit();
                }else{
                    showMessage();
                }
            } else {
                $('#myform').submit();
            }
        });

    });
</script>