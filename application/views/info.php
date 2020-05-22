<div class=" containerStatistieken" style="height:300px">
	<div class="col-sm-6 col-sm-offset-3">
		<h4 style="color:var(--colorSuccess);border-bottom: 1px solid var(--colorSuccess)">
			<?php echo $infoMovies->aantalMovies; ?>
			<?php echo $infoMovies->soortMovies; ?>
		</h4>
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		<h6 style="color:var(--colorSuccess);text-align: left;margin-bottom:20px">Kwaliteit</h6>
		<label class="progress-label">HD</label>
		<div class="progress progressMovies">
			<!--            <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated active"-->
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalHD / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalHD / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">DVD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalDVD / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalDVD / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorSuccess);text-align: left;margin-bottom:20px">Jaar</h6>
		<label class="progress-label">1966-1999</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalJaarTot2000 / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalJaarTot2000 / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2000-2009</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalJaarTot2010 / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalJaarTot2010 / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2010-2019</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:<?php echo round(($infoMovies->aantalJaarTot2020 / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalJaarTot2020 / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorSuccess);text-align: left;margin-bottom:20px">Taal</h6>
		<label class="progress-label">ENG</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalTaalENG / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalTaalENG / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">NL</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoMovies->aantalTaalNL / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalTaalNL / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">ANDERS</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width: <?php echo round(($infoMovies->aantalTaalAnders / $infoMovies->aantalMovies) * 100); ?>%">
				<?php echo round(($infoMovies->aantalTaalAnders / $infoMovies->aantalMovies) * 100); ?>%
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<br/>
	<br/>

	<div class="col-sm-6 col-sm-offset-3">
		<h4 style="color:var(--colorPrimary);border-bottom: 1px solid var(--colorPrimary)">
			<?php echo $infoEpisodes->aantalEpisodes; ?>
			<?php echo $infoEpisodes->soortEpisodes; ?>
			-
			<?php echo $infoEpisodes->aantalSeizoenen; ?>
			<?php echo $infoEpisodes->soortSeizoenen; ?>
		</h4>
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		<h6 style="color:var(--colorPrimary);text-align: left;margin-bottom:20px">Kwaliteit</h6>
		<label class="progress-label">HD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalHD / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalHD / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">DVD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalDVD / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalDVD / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorPrimary);text-align: left;margin-bottom:20px">Jaar</h6>
		<label class="progress-label">1966-1999</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalJaarTot2000 / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalJaarTot2000 / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2000-2009</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalJaarTot2010 / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalJaarTot2010 / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2010-2019</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalJaarTot2020 / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalJaarTot2020 / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorPrimary);text-align: left;margin-bottom:20px">Taal</h6>
		<label class="progress-label">ENG</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalTaalENG / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalTaalENG / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">NL</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalTaalNL / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalTaalNL / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">ANDERS</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoEpisodes->aantalTaalAnders / $infoEpisodes->aantalSeizoenen) * 100); ?>%">
				<?php echo round(($infoEpisodes->aantalTaalAnders / $infoEpisodes->aantalSeizoenen) * 100); ?>%
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<br/>
	<br/>


	<div class="col-sm-6 col-sm-offset-3">
		<h4 style="color:var(--colorWarning);border-bottom: 1px solid var(--colorWarning)">
			<?php echo $infoComedies->aantalComedies; ?>
			<?php echo $infoComedies->soortComedies; ?>
		</h4>
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		<h6 style="color:var(--colorWarning);text-align: left;margin-bottom:20px">Kwaliteit</h6>
		<label class="progress-label">HD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalHD / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalHD / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">DVD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalDVD / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalDVD / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorWarning);text-align: left;margin-bottom:20px">Jaar</h6>
		<label class="progress-label">1966-1999</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalJaarTot2000 / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalJaarTot2000 / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2000-2009</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalJaarTot2010 / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalJaarTot2010 / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">2010-2019</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalJaarTot2020 / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalJaarTot2020 / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<br/><h6 style="color:var(--colorWarning);text-align: left;margin-bottom:20px">Taal</h6>
		<label class="progress-label">ENG</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalTaalENG / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalTaalENG / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">NL</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalTaalNL / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalTaalNL / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>

		<label class="progress-label">ANDERS</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoComedies->aantalTaalAnders / $infoComedies->aantalComedies) * 100); ?>%">
				<?php echo round(($infoComedies->aantalTaalAnders / $infoComedies->aantalComedies) * 100); ?>%
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<br/>
	<br/>

	<div class="col-sm-6 col-sm-offset-3">
		<h4 style="color:var(--colorDanger);border-bottom: 1px solid var(--colorDanger)">
			<?php echo $infoDocumentaries->aantalDocumentaries; ?>
			<?php echo $infoDocumentaries->soortDocumentaries; ?>
			-
			<?php echo $infoDocumentaries->aantalEpisodes; ?>
			<?php echo $infoDocumentaries->soortEpisodes; ?>
			-
			<?php echo $infoDocumentaries->aantalSeizoenen; ?>
			<?php echo $infoDocumentaries->soortSeizoenen; ?>
		</h4>
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		<h6 style="color:var(--colorDanger);text-align: left;margin-bottom:20px">Kwaliteit</h6>
		<label class="progress-label">HD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalHD / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalHD / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<label class="progress-label">DVD</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalDVD / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalDVD / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<br/><h6 style="color:var(--colorDanger);text-align: left;margin-bottom:20px">Jaar</h6>
		<label class="progress-label">1966-1999</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalJaarTot2000 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalJaarTot2000 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<label class="progress-label">2000-2009</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalJaarTot2010 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalJaarTot2010 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<label class="progress-label">2010-2019</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalJaarTot2020 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalJaarTot2020 / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<br/><h6 style="color:var(--colorDanger);text-align: left;margin-bottom:20px">Taal</h6>
		<label class="progress-label">ENG</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalTaalENG / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalTaalENG / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<label class="progress-label">NL</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalTaalNL / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalTaalNL / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>

		<label class="progress-label">ANDERS</label>
		<div class="progress progressMovies">
			<div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated"
				 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
				 style="width:  <?php echo round(($infoDocumentaries->aantalTaalAnders / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>%">
				<?php echo round(($infoDocumentaries->aantalTaalAnders / $infoDocumentaries->totaalAantalDocumentaries) * 100); ?>
				%
			</div>
		</div>
	</div>
</div>
