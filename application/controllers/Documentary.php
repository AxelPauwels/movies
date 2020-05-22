<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Documentary extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->model('documentary_model');
		$this->load->model('documentarySeizoen_model');
	}

	public function index()
	{
		$data['title'] = '';
		$data['footer'] = "";
		$data['message'] = $this->getFlashMessageData();

		$partials = array('header' => 'main_header_documentary', 'content' => 'documentary');
		$this->template->load('main_master', $partials, $data);
	}

	private function calculateDuurAndGrootte($seizoen)
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

	private function cmpToegevoegd($first, $second)
	{
		return $first->toegevoegd < $second->toegevoegd;
	}

	public function ajaxDocumentariesOpNaam()
	{
		$zoekstring = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$documentaryEpisodes = $this->documentarySeizoen_model->getDocumentarySeizoenenOpNaam($zoekstring);
		$documentariesNonEpisodes = $this->documentary_model->getDocumentariesOpNaam($zoekstring);
		$documentaries = array_merge($documentaryEpisodes, $documentariesNonEpisodes);

		$data['movies'] = $documentaries;

		if ($view == "cover") {
			$this->load->view('ajax_documentary', $data);
		} else {
			$this->load->view('ajax_documentaryList', $data);
		}
	}

	public function ajaxDocumentariesOpJaar()
	{
		$zoekstring = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$documentaryEpisodes = $this->documentarySeizoen_model->getDocumentarySeizoenenOpJaar($zoekstring);
		$documentariesNonEpisodes = $this->documentary_model->getDocumentariesOpJaar($zoekstring);
		$documentaries = array_merge($documentaryEpisodes, $documentariesNonEpisodes);

		$data['movies'] = $documentaries;

		if ($view == "cover") {
			$this->load->view('ajax_documentary', $data);
		} else {
			$this->load->view('ajax_documentaryList', $data);
		}
	}

	public function ajaxDocumentariesOpLaatstToegevoegd()
	{
		$aantal = $this->input->get('zoekstring');
		$view = $this->input->get('view');
		$documentaryEpisodes = $this->documentarySeizoen_model->getDocumentarySeizoenOpLaatstToegevoegd($aantal);
		$documentariesNonEpisodes = $this->documentary_model->getDocumentariesOpLaatstToegevoegd($aantal);
		$documentaries = array_merge($documentaryEpisodes, $documentariesNonEpisodes);

		// sort by date
		usort($documentaries, array($this, "cmpToegevoegd"));

		// limit to 'aantal'
		$data['movies'] = array_slice($documentaries,0,$aantal);

		if ($view == "cover") {
			$this->load->view('ajax_documentary', $data);
		} else {
			$this->load->view('ajax_documentaryList', $data);
		}
	}

	public function ajaxAlleDocumentaries()
	{
		$view = $this->input->get('view');

		$documentaryEpisodes = $this->documentarySeizoen_model->getAlleDocumentarySeizoen();
		$documentariesNonEpisodes = $this->documentary_model->getAlleDocumentaries();
		$documentaries = array_merge($documentaryEpisodes, $documentariesNonEpisodes);

		// sort by date
		usort($documentaries, array($this, "cmpToegevoegd"));

		// limit to 'aantal'
		$data['movies'] = $documentaries;

		if ($view == "cover") {
			$this->load->view('ajax_documentary', $data);
		} else {
			$this->load->view('ajax_documentaryList', $data);
		}
	}

	public function ajaxDocumentaryInfo()
	{
		$zoekid = $this->input->get('zoekid');
		$zoekSeizoenId = $this->input->get('zoekSeizoenId');
		if($zoekid > 0) {
			$data['movie'] = $this->documentary_model->get($zoekid);
		}else{
			$seizoen = $this->documentarySeizoen_model->getDocumentarySeizoenBySeizoenId($zoekSeizoenId);
			$seizoen->episodes = $this->documentary_model->getDocumentaryEpisodesBySeizoenId($zoekSeizoenId);
			$data['movie'] = $this->calculateDuurAndGrootte($seizoen);
		}

		$this->load->view('ajax_documentaryInfo', $data);
	}

	// advanced temporarly disabled : this is old code when documentaries where just like movies
	// should be modified to documnetarySeasons before enabled in the front end egain
	public function ajaxGesorteerdeDocumentaries()
	{
		$view = $this->input->get('view');
		$taal = $this->input->get('taalKeuze');
		$type = $this->input->get('typeKeuze');
		$duurVan = $this->input->get('duurKeuzeVan');
		$duurTot = $this->input->get('duurKeuzeTot');
		$grootteVan = $this->input->get('grootteKeuzeVan');
		$grootteTot = $this->input->get('grootteKeuzeTot');
		$jaarVan = $this->input->get('jaarKeuzeVan');
		$jaarTot = $this->input->get('jaarKeuzeTot');
		$data['movies'] = $this->documentary_model->getGesorteerdeDocumentaries(
			$taal,
			$type,
			$duurVan,
			$duurTot,
			$grootteVan,
			$grootteTot,
			$jaarVan,
			$jaarTot
		);


		if ($view == "cover") {
			$this->load->view('ajax_documentary', $data);
		} else {
			$this->load->view('ajax_documentaryList', $data);
		}
	}

	public function sendMailByPHP($to, $subject, $message, $headers)
	{
		mail($to, $subject, $message, $headers);
	}

	public function sendMailByCodeIgniter($from, $to, $subject, $message)
	{
		$this->email->from($from, 'Movies');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
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
