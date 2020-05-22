<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Comedy extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('comedy_model');
    }

    public function index()
    {
        $data['title'] = '';
        $data['footer'] = "";
        $data['message'] = $this->getFlashMessageData();

        $partials = array('header' => 'main_header_comedy', 'content' => 'comedy');
        $this->template->load('main_master', $partials, $data);
    }

    public function ajaxComediesOpNaam()
    {
        $zoekstring = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->comedy_model->getComediesOpNaam($zoekstring);

        if ($view == "cover") {
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function ajaxComediesOpJaar()
    {
        $zoekstring = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->comedy_model->getComediesOpJaar($zoekstring);

        if ($view == "cover") {
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function ajaxComediesOpLaatstToegevoegd()
    {
        $aantal = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->comedy_model->getComediesOpLaatstToegevoegd($aantal);

        if ($view == "cover") {
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function ajaxAlleComedies()
    {
        $view = $this->input->get('view');
        $data['movies'] = $this->comedy_model->getAllComedies();

        if ($view == "cover") {
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function ajaxComediesMeestGedownload()
    {
        $view = $this->input->get('view');
        $data['movies'] = $this->comedy_model->getComediesMeestGedownload();

        if ($view == "cover") {
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function ajaxComediesInfo()
    {
        $zoekid = $this->input->get('zoekid');
        $data['movie'] = $this->comedy_model->get($zoekid);

        $this->load->view('ajax_comedyInfo', $data);
    }

    public function ajaxGesorteerdeComedies()
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
        $data['movies'] = $this->comedy_model->getGesorteerdeComedies(
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
            $this->load->view('ajax_comedy', $data);
        } else {
            $this->load->view('ajax_comedyList', $data);
        }
    }

    public function sendMailByPHP($to, $subject, $message, $headers)
    {
        mail($to, $subject, $message, $headers);
    }

    public function sendMailByCodeIgniter($from, $to, $subject, $message)
    {
//        $this->email->set_mailtype('html');
        $this->email->from($from, 'Movieserver');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    private function getFlashMessageData(){
        $data = $this->getConfigData(CONFIG_FLASHMESSAGE);

        if(!$data || $data == NULL){
            return "";
        }

        if ($data->flash_message_is_active == 1) {
            return $data;
        }
    }

    private function getConfigData($configName){
        $this->load->model('config_model');
        return $this->config_model->getConfigByName($configName);
    }
}
