<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// +----------------------------------------------------------
// | Custom Helper
// +----------------------------------------------------------


function getFlashMessageHTML($setting){



    $dataOpen = array(
        'id' => 'myform',
        'name' => 'myform',
        'data-toggle' => 'validator',
        'role' => 'form',
        'method' => 'POST');

    echo form_open('admin/updateSettings', $dataOpen);
    echo div();
    echo form_hidden('id', $setting->id);

    echo '<div class="innerFormBlock" style="margin-bottom: 10px">';

    echo div();
    echo '<h3 style="color:whitesmoke">' . $setting->config_name . '</h3>';
    echo '</div>';
    echo divClose();

    echo div();
    echo '<div class="input-group" style="width:100%; margin-bottom: 5px;">';
    echo '<textarea name="flash_message" cols="40" rows="3" id="flash_message" size="30" class="form-control">';
    echo $setting->flash_message;
    echo '</textarea>';
    echo '</div>';
    echo divClose();

    echo div();
    echo '<div class="input-group" style="width:100%; margin-bottom: 5px;">';
    echo '<label class="switch"><input name="flash_message_is_active" id="flash_message_is_active" type="checkbox"';
    echo ($setting->flash_message_is_active=='1') ? 'checked' : '';
    echo '><span class="slider round"></span></label>';
    echo '<label style="line-height: 34px;color: whitesmoke;vertical-align: top;padding-left:10px">Show flashMessage</label>';
    echo '</div>';
    echo divClose();

    echo '</div>'; //innerFormBlock

echo div();
$dataSubmit = array(
    'type' => 'submit',
    'name' => 'mysubmit',
    'value' => 'Save ' . $setting->config_name,
    'class' => 'btn btn-success',
    'style' => 'width: 100%; margin-bottom: 50px;',
    );
echo form_submit($dataSubmit) . PHP_EOL;

echo form_close();
echo divClose();
echo divClose();
//formclose





}
