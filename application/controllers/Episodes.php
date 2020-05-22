<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Episodes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->model('episodesSeizoen_model');
		$this->load->model('episodes_model');
	}

	public function index()
	{
		$data['title'] = '';
		$data['footer'] = '';
		$data['message'] = $this->getFlashMessageData();

		$partials = array('header' => 'main_header_movies', 'content' => 'episodes');
		$this->template->load('main_master', $partials, $data);
	}

	public function ajaxEpisodesSeizoenOpNaam()
	{
		$zoekstring = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getEpisodesSeizoenOpNaam($zoekstring);

		if ($view == "cover") {
			$this->load->view('ajax_episodes', $data);
		} else {
			$this->load->view('ajax_episodesList', $data);
		}
	}

	public function ajaxEpisodesSeizoenOpJaar()
	{
		$zoekstring = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getEpisodesSeizoenOpJaar($zoekstring);

		if ($view == "cover") {
			$this->load->view('ajax_episodes', $data);
		} else {
			$this->load->view('ajax_episodesList', $data);
		}
	}

	public function ajaxEpisodesSeizoenOpLaatstToegevoegd()
	{
		$aantal = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getEpisodesSeizoenOpLaatstToegevoegd($aantal);

		if ($view == "cover") {
			$this->load->view('ajax_episodes', $data);
		} else {
			$this->load->view('ajax_episodesList', $data);
		}
	}

	public function ajaxAlleEpisodesSeizoen()
	{
		$view = $this->input->get('view');

		$episodesSeizoen = $this->episodesSeizoen_model->getAlleEpisodesSeizoen();
		foreach ($episodesSeizoen as $collectie) {
			$collectie->aantalSeizoenen = $this->episodesSeizoen_model
				->getAantalSeizoenenPerCollectie($collectie->collectie);
		}
		$data['episodesSeizoen'] = $episodesSeizoen;

		if ($view == "cover") {
			$this->load->view('ajax_episodes', $data);
		} else {
			$this->load->view('ajax_episodesList', $data);
		}
	}

	public function ajaxCollectie()
	{
		$episodesSeizoen = $this->episodesSeizoen_model->getAlleEpisodesSeizoen();
		foreach ($episodesSeizoen as $collectie) {
			$collectie->aantalSeizoenen = $this->episodesSeizoen_model
				->getAantalSeizoenenPerCollectie($collectie->collectie);
		}
		$data['episodesSeizoen'] = $episodesSeizoen;

		$this->load->view('ajax_episodesDropdownOptions', $data);
	}

	public function ajaxEpisodesMeestGedownload()
	{
		$view = $this->input->get('view');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getEpisodesMeestGedownload();

		if ($view == "cover") {
			$this->load->view('ajax_episodes', $data);
		} else {
			$this->load->view('ajax_episodesList', $data);
		}
	}

	public function ajaxAlleEpisodesByCollectie()
	{
		//MOET ajaxAlleSeizoenByCollectie zijn
		$view = $this->input->get('view');
		$collectie = $this->input->get('keuzeCollectie');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getAlleEpisodesByCollectie($collectie);

		$this->load->view('ajax_episodesDropdownOptionsSeizoenen', $data);
	}

	public function ajaxEpisodesSeizoenInfo()
	{
		$zoekid = $this->input->get('zoekid');
		$seizoen = $this->episodesSeizoen_model->getEpisodesSeizoen($zoekid);
		$data['seizoen'] = $this->calculateDuurAndGrootte($seizoen);

		$this->load->view('ajax_episodesInfo', $data);
	}

	public function ajaxEpisodeInfo()
	{
		$zoekid = $this->input->get('zoekid');
		$data['episode'] = $this->episodes_model->getEpisode($zoekid);

		$this->load->view('ajax_oneEpisodesInfo', $data);
	}

	public function ajaxGesorteerdeEpisodes()
	{
		$view = $this->input->get('view');
		$taal = $this->input->get('taalKeuze');
		$type = $this->input->get('typeKeuze');
		$collectie = $this->input->get('collectieKeuze');
		$seizoenId = $this->input->get('seizoenKeuze');
		$jaarVan = $this->input->get('jaarKeuzeVan');
		$jaarTot = $this->input->get('jaarKeuzeTot');
		$data['episodesSeizoen'] = $this->episodesSeizoen_model->getGesorteerdeEpisodes(
			$taal,
			$type,
			$collectie,
			$seizoenId,
			$jaarVan,
			$jaarTot
		);

		if ($seizoenId != "0" && $seizoenId != 'undefined') {

			$data['seizoen'] = $this->episodesSeizoen_model->getEpisodesSeizoen($seizoenId);
			if ($view == "cover") {
				$this->load->view('ajax_episodesAfleveringen', $data);
			} else {
				$this->load->view('ajax_episodesAfleveringenList', $data);
			}
		} else {
			if ($view == "cover") {
				$this->load->view('ajax_episodes', $data);
			} else {
				$this->load->view('ajax_episodesList', $data);
			}
		}
	}

	public function sendMailByPHP($to, $subject, $message, $headers)
	{
		mail($to, $subject, $message, $headers);
	}

	public function sendMailByCodeIgniter($from, $to, $subject, $message)
	{
//        $this->email->set_mailtype('html');
		$this->email->from($from, 'Movies');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function calculateDuurAndGrootte($seizoen)
	{
		$totaleGrootte = 0;
		$totaleDuur = 0;

		$rawHours = 0;
		$rawMinutes = 0;
		$rawSeconds = 0;

		foreach ($seizoen->episodes as $episode) {
			$totaleGrootte += $episode->grootte;
			$duurParts = explode(":",$episode->duur);

			if (\count($duurParts) === 2) {
				$rawMinutes += \intval($duurParts[0]);
				$rawSeconds += \intval($duurParts[1]);
			}
			// if there are hours in the string...
			if (\count($duurParts) === 3) {
				$rawHours += \intval($duurParts[0]);
				$rawMinutes += \intval($duurParts[1]);
				$rawSeconds += \intval($duurParts[2]);
			}
		}

		$rawTotaleDuur = date('H:i:s', mktime($rawHours,$rawMinutes,$rawSeconds)); ;

		// remove leading zeros
		$rawTotaleDuurParts = explode(":",$rawTotaleDuur);
		if($rawTotaleDuurParts[0] === "00"){
			$rawTotaleDuur = \substr($rawTotaleDuur,3,\strlen($rawTotaleDuur));
		}

		$seizoen->totaleGrootte = $totaleGrootte;
		$seizoen->totaleDuur = $rawTotaleDuur;
		return $seizoen;
	}

	private function getFlashMessageData()
	{
		$data = $this->getConfigData(CONFIG_FLASHMESSAGE);

		if (!$data || $data == null) {
			return "";
		}

		if ($data->flash_message_is_active == 1) {
			return $data;
		}
	}

	private function getConfigData($configName)
	{
		$this->load->model('config_model');
		return $this->config_model->getConfigByName($configName);
	}
}
