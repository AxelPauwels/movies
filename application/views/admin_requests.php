<div id="admin_requests" class="viewList">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $template = array('table_open' => '<table class="table " border="0" cellpadding="4" cellspacing="0">');
        $this->table->set_template($template);

        foreach ($movies as $movie) {
            $this->table->add_row($movie->naam, $movie->id);
        }
        echo $this->table->generate();
        ?>
    </div>
</div>
