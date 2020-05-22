<div id="confirmDeleteMyAccount" style="text-align: center;margin-top: 16%">
    <div>
        <p class="customTextBlue" style="font-size: 18px">Weet je zeker dat je je account wil verwijderen?</p>
    </div>
    <br/>
    <div>
        <?php echo anchor(
            'home/profile',
            '<button class="btn btn-success size customInputSubmit">Nee, ik heb me vergist.</button>'
        ); ?>
        <?php echo anchor(
            'user/profileDelete',
            '<button class="btn btn-danger size customInputSubmit">Ja, verwijder!</button>'
        ); ?>
    </div>
</div>
