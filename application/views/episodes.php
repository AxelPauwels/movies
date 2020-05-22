<script>
    var view = "cover";
    var laatsteActie = "";
    var laatsteVar = "";
    var vtaal = "";
    var vtype = "";
    var vcollectie = "";
    var vseizoen = "";
    var vjaarVan = "";
    var vjaarTot = "";
    var emailIsAlreadySend = false;

    function haalEpisodesSeizoenOpNaam(naam) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxEpisodesSeizoenOpNaam",
            data: {view: view, zoekstring: naam},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalEpisodesSeizoenOpNaam";
                laatsteVar = naam;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalEpisodesSeizoenOpNaam --\n\n" + xhr.responseText);
            }
        });
    }

    function haalEpisodesSeizoenOpJaar(jaar) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxEpisodesSeizoenOpJaar",
            data: {view: view, zoekstring: jaar},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalEpisodesSeizoenOpJaar";
                laatsteVar = jaar;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalEpisodesSeizoenOpJaar --\n\n" + xhr.responseText);
            }
        });
    }

    function haalEpisodesSeizoenOpLaatstToegevoegd(aantal) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxEpisodesSeizoenOpLaatstToegevoegd",
            data: {view: view, zoekstring: aantal},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalEpisodesSeizoenOpLaatstToegevoegd";
                laatsteVar = aantal;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalEpisodesSeizoenOpLaatstToegevoegd --\n\n" + xhr.responseText);
            }
        });
    }

    function haalAlleEpisodesSeizoen() {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxAlleEpisodesSeizoen",
            data: {view: view},
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalAlleEpisodesSeizoen";
                laatsteVar = "";
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalAlleEpisodesSeizoen --\n\n" + xhr.responseText);
            }
        });
    }

    function haalCollectie() {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxCollectie",
            success: function (result) {
                $("#collectie").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalCollectie --\n\n" + xhr.responseText);
            }
        });
    }

    function haalAlleEpisodesByCollectie(collectie) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxAlleEpisodesByCollectie",
            data: {
                view: view,
                keuzeCollectie: collectie
            },
            success: function (result) {
                $("#seizoen").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalAlleEpisodesByCollectie --\n\n" + xhr.responseText);
            }
        });
    }

    function haalGesorteerdeEpisodes(taal, type, collectie, seizoen, jaarVan, jaarTot) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxGesorteerdeEpisodes",
            data: {
                view: view,
                taalKeuze: taal,
                typeKeuze: type,
                collectieKeuze: collectie,
                seizoenKeuze: seizoen,
                jaarKeuzeVan: jaarVan,
                jaarKeuzeTot: jaarTot
            },
            success: function (result) {
                $("#resultaat").html(result);
                laatsteActie = "haalGesorteerdeEpisodes";
                laatsteVar = "gesorteerd";
                vtaal = taal;
                vtype = type;
                vcollectie = collectie;
                vseizoen = seizoen;
                vjaarVan = jaarVan;
                vjaarTot = jaarTot;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalGesorteerdeEpisodes --\n\n" + xhr.responseText);
            }
        });
    }

    function haalEpisodesSeizoenInfo(id) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxEpisodesSeizoenInfo",
            data: {view: view, zoekid: id},
            success: function (result) {
                $("#resultaatModal").html(result);
                $('#myModal').modal('show');
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalEpisodesSeizoenInfo --\n\n" + xhr.responseText);
            }
        });
    }

    function haalEpisodeInfo(id) {
        $.ajax({
            type: "GET",
            url: site_url + "/episodes/ajaxEpisodeInfo",
            data: {view: view, zoekid: id},
            success: function (result) {
                $("#resultaatModal").html(result);
                $('#myModal').modal('show');
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN haalEpisodeInfo --\n\n" + xhr.responseText);
            }
        });
    }

    function reloadAjax() {
        if (laatsteVar == "gesorteerd") {
            window[laatsteActie](vtaal, vtype, vcollectie, vseizoen, vjaarVan, vjaarTot);
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
                haalEpisodesSeizoenOpNaam($(this).val());
            }
        });

        inputJaar.keyup(function () {
            if ($(this).val() === "") {
                $("#resultaat").html("");
            } else {
                haalEpisodesSeizoenOpJaar($(this).val());
            }
        });

        $("#toonRecente").click(function () {
            var aantal = 48;
            haalEpisodesSeizoenOpLaatstToegevoegd(aantal);
        });

        $("#toonAlles").click(function () {
            haalAlleEpisodesSeizoen();
        });

        $("#geavanceerdZoeken").click(function () {
            $("#defaultSearch").hide();
            $("#advancedSearch").show();
            $(".switchAdvancedSearch").css({"color": colorBlue, "cursor": "default"});
            $(".switchBasicSearch").css({"color": colorGray, "cursor": "pointer"});
            haalCollectie();
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
            var collectie = $("#collectie option:selected").val();
            var seizoen = $("#seizoen option:selected").val();
            var jaarVan = $("#jaarKeuzeVan").val();
            var jaarTot = $("#jaarKeuzeTot").val();

            if (taal === "0" && type === "0" && collectie === "0" && seizoen === undefined && jaarVan === "" && jaarTot === "") {
//                alert("niks ophalen");
            } else {
                if (seizoen === undefined) { // toegevoegd om op "taal" of "kwaliteit" te kunnen ophalen
                    seizoen = "0";
                }
                haalGesorteerdeEpisodes(taal, type, collectie, seizoen, jaarVan, jaarTot);
            }
        });

        $("#taalKeuze").change(function () {
            var taal = $("#taalKeuze option:selected").val();
            if (taal !== "0") {
                $("#seizoen").val(0);
            }

        });

        $("#typeKeuze").change(function () {
            var type = $("#typeKeuze option:selected").val();
            if (type !== "0") {
                $("#seizoen").val(0);

            }
        });
    });

    $(document).ajaxComplete(function () {
        $(".coverlink").click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            haalEpisodesSeizoenInfo(id);
        });

        $(".coverlinkEpisode").click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            haalEpisodeInfo(id);
        });

        $("#collectie").change(function () {
            haalAlleEpisodesByCollectie($(this).val());
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
            <span class="textShadowSmall">EPISODES</span>
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
<div hidden id="advancedSearch" class="container episodes">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span id="switchViewMenuAdvanced">
                <i id="switchCoverAdvanced" class="fa fa-th fa-lg switchCover" aria-hidden="true"></i>
                <i id="switchListAdvanced" class="fa fa-list fa-lg switchList" aria-hidden="true"></i>
            </span>
            <span class="textShadowSmall">EPISODES</span>
            <span id="switchSearchMenuAdvanced">
                <i id="geavanceerdZoekenAdvanced" class="fa fa-search-plus fa-lg switchAdvancedSearch"
                   aria-hidden="true"></i>
                <i id="zoekenAdvanced" class="fa fa-search fa-lg switchBasicSearch" aria-hidden="true"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="one">
                <div class=" form-group">
                    <?php echo form_dropdown('collectie', array(), '0',
                        ' id="collectie" class="form-control customDropdown"'); ?>
                </div>
                <div class=" form-group">
                    <?php echo form_dropdown('seizoen', array(), '0',
                        'id="seizoen" class="form-control customDropdown"'); ?>
                </div>

                <div class=" form-group episodesJaarLinks">
                    <?php echo form_input(array(
                        'name' => 'jaarKeuzeVan',
                        'id' => 'jaarKeuzeVan',
                        'class' => 'form-control customInput',
                        'placeholder' => 'Jaar: van...',
                        'onfocus' => "this.placeholder = '' ",
                        'onblur' => "this.placeholder = 'Jaar: van...' "
                    )); ?>
                </div>

                <div class=" form-group episodesJaarRechts">
                    <?php echo form_input(array(
                        'name' => 'jaarKeuzeTot',
                        'id' => 'jaarKeuzeTot',
                        'class' => 'form-control customInput',
                        'placeholder' => 'Jaar: tot...',
                        'onfocus' => "this.placeholder = '' ",
                        'onblur' => "this.placeholder = 'Jaar: tot...'"
                    )); ?>
                </div>
            </div>
            <div class="two">
                <div class="dropdown form-group">
                    <?php
                    $options = array(
                        '0' => 'Taal ...',
                        'ENG' => 'Engels',
                        'NL' => 'Nederlands'
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
                        'HD' => 'HD'
                    )
                    ?>
                    <?php echo form_dropdown('typeKeuze', $sorteerOptions, '0',
                        'id="typeKeuze" class="form-control btn btn-default customDropdown" '); ?>
                </div>
                <div class="dropdown form-group hide-on-mobile-custom">
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

<div class="container ">
    <div id="resultaat" class="episodes"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content episodes">
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
