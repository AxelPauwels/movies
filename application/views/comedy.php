<script>
    var view = "cover";
    var laatsteActie = "";
    var laatsteVar = "";
    var vtaal = "";
    var vtype = "";
    var vduurVan = "";
    var vduurTot = "";
    var vgrootteVan = "";
    var vgrootteTot = "";
    var vjaarVan = "";
    var vjaarTot = "";
    var emailIsAlreadySend = false;

    function haalComediesOpNaam(naam) {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxComediesOpNaam",
            data: {view: view, zoekstring: naam},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalComediesOpNaam";
                laatsteVar = naam;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function haalComediesOpJaar(jaar) {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxComediesOpJaar",
            data: {view: view, zoekstring: jaar},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalComediesOpJaar";
                laatsteVar = jaar;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function haalComediesOpLaatstToegevoegd(aantal) {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxComediesOpLaatstToegevoegd",
            data: {view: view, zoekstring: aantal},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalComediesOpLaatstToegevoegd";
                laatsteVar = aantal;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText + error);
            }
        });
    }

    function haalAlleComedies() {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxAlleComedies",
            data: {view: view},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalAlleComedies";
                laatsteVar = "";
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function haalGesorteerdeComedies(taal, type, duurVan, duurTot, grootteVan, grootteTot, jaarVan, jaarTot) {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxGesorteerdeComedies",
            data: {
                view: view,
                taalKeuze: taal,
                typeKeuze: type,
                duurKeuzeVan: duurVan,
                duurKeuzeTot: duurTot,
                grootteKeuzeVan: grootteVan,
                grootteKeuzeTot: grootteTot,
                jaarKeuzeVan: jaarVan,
                jaarKeuzeTot: jaarTot
            },
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalGesorteerdeComedies";
                laatsteVar = "gesorteerd";
                vtaal = taal;
                vtype = type;
                vduurVan = duurVan;
                vduurTot = duurTot;
                vgrootteVan = grootteVan;
                vgrootteTot = grootteTot;
                vjaarVan = jaarVan;
                vjaarTot = jaarTot;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function haalComediesInfo(id) {
        $.ajax({
            type: "GET",
            url: site_url + "/Comedy/ajaxComediesInfo",
            data: {view: view, zoekid: id},
            success: function (result) {
                $("#resultaatModal").html(result);
                $('#myModal').modal('show');
                // attach_download();
                //attach_request(); // moved to on-ajax-ready
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function reloadAjax() {
        if (laatsteVar == "gesorteerd") {
            window[laatsteActie](vtaal, vtype, vduurVan, vduurTot, vgrootteVan, vgrootteTot, vjaarVan, vjaarTot);
        } else {
            window[laatsteActie](laatsteVar);
        }
    }

    $(document).ready(function () {
        var inputNaam = $("#naam");
        var inputJaar = $("#jaar");
        var colorBlue = "#428bca";
        var colorGray = "#999";

        inputNaam.focus(function () {
            inputJaar.val("");
        });
        inputJaar.focus(function () {
            inputNaam.val("");
        });
        inputNaam.keyup(function () {
            if ($(this).val() === "") {
                $("#resultaat").html("");
            } else {
                haalComediesOpNaam($(this).val());
            }
        });
        inputJaar.keyup(function () {
            if ($(this).val() === "") {
                $("#resultaat").html("");
            } else {
                haalComediesOpJaar($(this).val());
            }
        });
        $("#toonRecente").click(function () {
            var aantal = 48;
            haalComediesOpLaatstToegevoegd(aantal);
        });
        $("#toonAlles").click(function () {
            inputJaar.val("");
            inputNaam.val("");
            haalAlleComedies();
        });
        $("#geavanceerdZoeken").click(function () {
            $("#defaultSearch").hide();
            $("#advancedSearch").show();
            $(".switchAdvancedSearch").css({"color": colorBlue, "cursor": "default"});
            $(".switchBasicSearch").css({"color": colorGray, "cursor": "pointer"});
        });
        $("#zoekenAdvanced").click(function () {
            $("#advancedSearch").hide();
            $("#defaultSearch").show();
            $(".switchAdvancedSearch").css({"color": colorGray, "cursor": "pointer"});
            $(".switchBasicSearch").css({"color": colorBlue, "cursor": "default"});
        });
        $("#switchList").click(function () {
            $(".switchCover").css({"color": colorGray, "cursor": "pointer"});
            $(".switchList").css({"color": colorBlue, "cursor": "default"});
            view = "list";
            reloadAjax();
        });
        $("#switchCover").click(function () {
            $(".switchCover").css({"color": colorBlue, "cursor": "default"});
            $(".switchList").css({"color": colorGray, "cursor": "pointer"});
            view = "cover";
            reloadAjax();
        });
        $("#switchListAdvanced").click(function () {
            $(".switchCover").css({"color": colorGray, "cursor": "pointer"});
            $(".switchList").css({"color": colorBlue, "cursor": "default"});
            view = "list";
            reloadAjax();
        });
        $("#switchCoverAdvanced").click(function () {
            $(".switchCover").css({"color": colorBlue, "cursor": "default"});
            $(".switchList").css({"color": colorGray, "cursor": "pointer"});
            view = "cover";
            reloadAjax();
        });
        $("#toonGesorteerd").click(function () {
            var taal = $("#taalKeuze option:selected").val();
            var type = $("#typeKeuze option:selected").val();
            var duurVan = $("#duurKeuzeVan option:selected").val();
            var duurTot = $("#duurKeuzeTot option:selected").val();
            var grootteVan = $("#grootteKeuzeVan option:selected").val();
            var grootteTot = $("#grootteKeuzeTot option:selected").val();
            var jaarVan = $("#jaarKeuzeVan").val();
            var jaarTot = $("#jaarKeuzeTot").val();
            haalGesorteerdeComedies(taal, type, duurVan, duurTot, grootteVan, grootteTot, jaarVan, jaarTot);
        });
    });

    $(document).ajaxComplete(function () {
        $(".coverlink").click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            haalComediesInfo(id);
        });
    });

</script>

<div id="defaultSearch" class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span id="switchViewMenu">
                <i id="switchCover" class="fa fa-th fa-lg switchCover" aria-hidden="true"></i>
                <i id="switchList" class="fa fa-list fa-lg switchList" aria-hidden="true"></i>
            </span>
            <span class="textShadowSmall">COMEDY</span>
            <span id="swithSearchMenu">
                <i id="geavanceerdZoeken" class="fa fa-search-plus fa-lg switchAdvancedSearch" aria-hidden="true"></i>
                <i id="zoeken" class="fa fa-search fa-lg switchBasicSearch" aria-hidden="true"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo form_input(array(
                    'name' => 'naam',
                    'id' => 'naam',
                    'class' => 'form-control customInput center',
                    'placeholder' => 'Zoek op titel',
                    'onfocus' => "this.placeholder = ''",
                    'onblur' => "this.placeholder = 'Zoek op titel'"
                )); ?>
            </div>
            <div class="form-group">
                <?php echo form_input(array(
                    'name' => 'jaar',
                    'id' => 'jaar',
                    'class' => 'form-control customInput center',
                    'placeholder' => 'Zoek op jaar',
                    'onfocus' => "this.placeholder = ''",
                    'onblur' => "this.placeholder = 'Zoek op jaar'"
                )); ?>
            </div>
			<div class="form-group">
				<?php echo form_button('toonRecente', '<i class="fa fa-refresh" aria-hidden="true"></i> Toon Recente',
					'id="toonRecente" class="form-control btn btn-default customButton"'); ?>
			</div>
			<div class="form-group">
				<?php echo form_button('toonAlles', '<i class="fa fa-video-camera" aria-hidden="true"></i> Toon Alles',
					'id="toonAlles" class="form-control btn btn-primary customButton" '); ?>
			</div>
        </div>
    </div>
</div>

<!-- GEAVANCEERD ZOEKEN-->
<div hidden id="advancedSearch" class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span id="switchViewMenuAdvanced">
                <i id="switchCoverAdvanced" class="fa fa-th fa-lg switchCover" aria-hidden="true"></i>
                <i id="switchListAdvanced" class="fa fa-list fa-lg switchList" aria-hidden="true"></i>
            </span>
            <span class="textShadowSmall">COMEDY</span>
            <span id="switchSearchMenuAdvanced">
                <i id="geavanceerdZoekenAdvanced" class="fa fa-search-plus fa-lg switchAdvancedSearch"
                   aria-hidden="true"></i>
                <i id="zoekenAdvanced" class="fa fa-search fa-lg switchBasicSearch" aria-hidden="true"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="one">
                <div class=" form-group">
                    <?php echo form_input(array(
                        'name' => 'jaarKeuzeVan',
                        'id' => 'jaarKeuzeVan',
                        'class' => 'form-control dropdownZoekGeavanceerdJaar customInput',
                        'placeholder' => 'Jaar: na...',
                        'onfocus' => "this.placeholder = '' ",
                        'onblur' => "this.placeholder = 'Jaar: na...' "
                    )); ?>
                    <?php echo form_input(array(
                        'name' => 'jaarKeuzeTot',
                        'id' => 'jaarKeuzeTot',
                        'class' => 'form-control dropdownZoekGeavanceerdJaar customInput',
                        'placeholder' => 'Jaar: voor...',
                        'onfocus' => "this.placeholder = '' ",
                        'onblur' => "this.placeholder = 'Jaar: voor...' "
                    )); ?>
                </div>

                <div class=" form-group">
                    <?php
                    $sorteerOptions = array(
                        '0' => 'Duur: langer dan ...',
                        '1.00' => 'langer dan 1,0u',
                        '1.50' => 'langer dan 1,5u',
                        '2.00' => 'langer dan 2,0u',
                        '2.50' => 'langer dan 2,5u',
                        '3.00' => 'langer dan 3,0u'
                    )
                    ?>
                    <?php echo form_dropdown('duurKeuzeVan', $sorteerOptions, '0',
                        ' id="duurKeuzeVan" class="form-control customDropdown"'); ?>

                    <?php
                    $sorteerOptions = array(
                        '0' => 'Duur: korter dan ...',
                        '1.00' => 'korter dan 1,0u',
                        '1.50' => 'korter dan 1,5u',
                        '2.00' => 'korter dan 2,0u',
                        '2.50' => 'korter dan 2,5u',
                        '3.00' => 'korter dan 3,0u'
                    )
                    ?>
                    <?php echo form_dropdown('duurKeuzeTot', $sorteerOptions, '0',
                        ' id="duurKeuzeTot" class="form-control customDropdown"'); ?>

                </div>
                <div class=" form-group">
                    <?php
                    $sorteerOptions = array(
                        '0' => 'File: groter dan...',
                        '1.00' => 'groter dan 1,0 GB',
                        '1.50' => 'groter dan 1,5 GB',
                        '2.00' => 'groter dan 2,0 GB',
                        '2.50' => 'groter dan 2,5 GB',
                        '3.00' => 'groter dan 3,0 GB',
                        '3.50' => 'groter dan 3,5 GB',
                        '4.00' => 'groter dan 4,0 GB'
                    )
                    ?>
                    <?php echo form_dropdown('grootteKeuzeVan', $sorteerOptions, '0',
                        'id="grootteKeuzeVan" class="form-control customDropdown"'); ?>
                    <?php
                    $sorteerOptions = array(
                        '0' => 'File: kleiner dan...',
                        '1.00' => 'kleiner dan 1,0 GB',
                        '1.50' => 'kleiner dan 1,5 GB',
                        '2.00' => 'kleiner dan 2,0 GB',
                        '2.50' => 'kleiner dan 2,5 GB',
                        '3.00' => 'kleiner dan 3,0 GB',
                        '3.50' => 'kleiner dan 3,5 GB',
                        '4.00' => 'kleiner dan 4,0 GB'
                    )
                    ?>
                    <?php echo form_dropdown('grootteKeuzeTot', $sorteerOptions, '0',
                        'id="grootteKeuzeTot" class="form-control customDropdown"'); ?>
                </div>
            </div>
            <div class="two">
                <div class="dropdown form-group">
                    <?php
                    $options = array(
                        '0' => 'Taal ...',
                        'AF' => 'Afrikaans',
                        'CH' => 'Chinees',
                        'ENG' => 'Engels',
                        'FR' => 'Frans',
                        'GE' => 'Duits',
                        'IT' => 'Italiaans',
                        'JP' => 'Japans',
                        'KR' => 'Koreaans',
                        'NL' => 'Nederlands',
                        'PO' => 'Portugees',
                        'SP' => 'Spaans',
                        'SW' => 'Zweeds',
                        'TH' => 'Thais'
                    )
                    ?>
                    <?php echo form_dropdown('taalKeuze', $options, '0',
                        'id="taalKeuze" class="form-control btn btn-default customDropdown" '); ?>
                </div>
                <div class="dropdown form-group">
                    <?php
                    $sorteerOptions = array(
                        '0' => 'Kwaliteit ...',
                        'DVD' => 'DVD',
                        'HD' => 'HD',
                        '3D' => 'HD3D'
                    )
                    ?>
                    <?php echo form_dropdown('typeKeuze', $sorteerOptions, '0',
                        'id="typeKeuze" class="form-control btn btn-default customDropdown"'); ?>
                </div>
                <div class="form-group">
                    <button name="toonGesorteed" type="button" id="toonGesorteerd" class="form-control btn btn-primary customInputSubmit" style="font-size:14px">
                        <i class="fa fa-angle-double-right"></i> ZOEK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- EINDE_GEAVANCEERD ZOEKEN-->

<div class="container">
    <div id="resultaat" class="movies"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content movies">
            <div class="modal-header" style="border-bottom: none">
                <button type="button" class="close" data-dismiss="modal"><span style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                <div id="resultaatModal"></div>
                </p>
            </div>
        </div>
    </div>
</div>
