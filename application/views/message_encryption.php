<script>
    function convertMessage(convertMethod, key, message) {
        $.ajax({
            type: "POST",
            url: site_url + "/secret/ajaxConvertMessage",
            data: {
                convertMethod: convertMethod,
                key: key,
                message: message
            },
            success: function (result) {
                $("#message").val(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX \n\n 'encryptMessage()' --\n\n" + xhr.responseText);
            }
        });
    }
    function getFromdata() {
        $formdata = [];
        $formIsValid = false;
        $message = "";
        $key = "";

        //formdata opalen
        $message = $("#message").val();
        $key = $("#key").val();

        //formdata controleren
        if ($key !== "" && $message !== "") {
            $formIsValid = true;

        } else if ($key === "") {
            alert('The encryption key is missing !');
        } else if ($message === "") {
            alert("There's no message !");
        } else {
            // todo: do nothing ... ?
        }

        //formdata returnen
        $formdata['formIsValid'] = $formIsValid;
        $formdata['message'] = $message;
        $formdata['key'] = $key;
        return $formdata;
    }

    $(document).ready(function () {
        $(".convertButton").click(function (e) {
            e.preventDefault();
            $convertMethod = this.id;
            $formdata = getFromdata();

            if ($formdata['formIsValid']) {
                convertMessage($convertMethod, $formdata['key'], $formdata['message'],)
            }
        });
    });
</script>

<div>
    <div style="color:grey;background-color: #0f0f0f;padding:10px">
        <h3 style="margin-top: 5px">Secret Messaging</h3>
        <p>These messages are 5 times encrypted with a double one-way-encryption userkey</p>
    </div>
    <?php
    echo form_open("a/b");

    echo div();
    echo form_textarea(array(
            'name' => 'message',
            'id' => 'message',
            'value' => $message,
            'height' => '75%',
            'class' => 'form-control',
            'placeholder' => 'Write your message...',
        )) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    echo form_input(array(
            'name' => 'key',
            'id' => 'key',
            'size' => '30',
            'value' => '',
            'class' => 'form-control',
            'placeholder' => "Choose a encryption key (for example 'tomatoes')",
        )) . "\n";

    $data_submit_encrypt = array(
        'type' => 'submit',
        'id' => 'encrypt',
        'name' => 'encrypt',
        'value' => 'Encrypt !',
        'class' => 'btn btn-danger size convertButton');
    echo form_submit($data_submit_encrypt) . "\n";

    $data_submit_decrypt = array(
        'type' => 'submit',
        'id' => 'decrypt',
        'name' => 'decrypt',
        'value' => 'Decrypt !',
        'class' => 'btn btn-success size convertButton');
    echo form_submit($data_submit_decrypt) . "\n";
    echo divClose();

    echo form_close();

    ?>
</div>

