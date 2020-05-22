<div id="admin_codes" class="viewList">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $template = array('table_open' => '<table id="codes_adminTable" class="table tablesorter" border="0" cellpadding="4" cellspacing="0">');
        $this->table->set_template($template);
        foreach ($codes as $code) {
            $this->table->add_row($code->id, $code->Rcode);
        }
        echo $this->table->generate();
        ?>
    </div>
</div>
<script>
    $(function () {
        $("#codes_adminTable").tablesorter();
        var td = $("td");
        td.hover(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#428bca", "cursor": "pointer"});
        });
        td.mouseleave(function () {
            $(this).closest('tr').find('i.fa-info-circle').css({"color": "#999", "cursor": "default"});
        });
    });
</script>