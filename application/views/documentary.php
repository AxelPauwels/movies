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

	function haalDocumentariesOpNaam(naam) {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxDocumentariesOpNaam",
			data: {view: view, zoekstring: naam},
			success: function (result) {
				$("#resultaat").html(result);
				laatsteActie = "haalDocumentariesOpNaam";
				laatsteVar = naam;
			},
			error: function (xhr, status, error) {
				alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
			}
		});
	}

	function haalDocumentariesOpJaar(jaar) {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxDocumentariesOpJaar",
			data: {view: view, zoekstring: jaar},
			success: function (result) {
				$("#resultaat").html(result);
				laatsteActie = "haalDocumentariesOpJaar";
				laatsteVar = jaar;
			},
			error: function (xhr, status, error) {
				alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
			}
		});
	}

	function haalDocumentariesOpLaatstToegevoegd(aantal) {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxDocumentariesOpLaatstToegevoegd",
			data: {view: view, zoekstring: aantal},
			success: function (result) {
				$("#resultaat").html(result);
				laatsteActie = "haalDocumentariesOpLaatstToegevoegd";
				laatsteVar = aantal;
			},
			error: function (xhr, status, error) {
				alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
			}
		});
	}

	function haalAlleDocumentaries() {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxAlleDocumentaries",
			data: {view: view},
			success: function (result) {
				$("#resultaat").html(result);
				laatsteActie = "haalAlleDocumentaries";
				laatsteVar = "";
			},
			error: function (xhr, status, error) {
				alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
			}
		});
	}

	function haalGesorteerdeDocumentaries(taal, type, duurVan, duurTot, grootteVan, grootteTot, jaarVan, jaarTot) {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxGesorteerdeDocumentaries",
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
				laatsteActie = "haalGesorteerdeDocumentaries";
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

	function haalDocumentaryInfo(id, seizoenId) {
		$.ajax({
			type: "GET",
			url: site_url + "/documentary/ajaxDocumentaryInfo",
			data: {view: view, zoekid: id, zoekSeizoenId: seizoenId},
			success: function (result) {
				$("#resultaatModal").html(result);
				$('#myModal').modal('show');
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
				haalDocumentariesOpNaam($(this).val());
			}
		});
		inputJaar.keyup(function () {
			if ($(this).val() === "") {
				$("#resultaat").html("");
			} else {
				haalDocumentariesOpJaar($(this).val());
			}
		});
		$("#toonRecente").click(function () {
			var aantal = 48;
			haalDocumentariesOpLaatstToegevoegd(aantal);
		});
		$("#toonAlles").click(function () {
			inputJaar.val("");
			inputNaam.val("");
			haalAlleDocumentaries();
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
			haalGesorteerdeDocumentaries(taal, type, duurVan, duurTot, grootteVan, grootteTot, jaarVan, jaarTot);
		});
	});

	$(document).ajaxComplete(function () {
		$(".coverlink").click(function (e) {
			e.preventDefault();
			var id = $(this).data('id');
			var seizoenId = $(this).data('seizoen-id');
			haalDocumentaryInfo(id, seizoenId);
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
			<span class="textShadowSmall">DOCUMENTARY</span>
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
			<span class="textShadowSmall">DOCUMENTARY</span>
			<span id="switchSearchMenuAdvanced">
                <i id="geavanceerdZoekenAdvanced" class="fa fa-search-plus fa-lg switchAdvancedSearch"
				   aria-hidden="true"></i>
                <i id="zoekenAdvanced" class="fa fa-search fa-lg switchBasicSearch" aria-hidden="true"></i>
            </span>
		</div>
		<div class="panel-body">
			<div style="color:darkgray;margin:7px 0 8px 0">De geavanceerde search is momenteel niet beschikbaar voor
				documentary
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
