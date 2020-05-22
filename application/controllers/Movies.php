<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Movies extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('films_model');
    }

    public function index()
    {
        $data['title'] = '';
        $data['footer'] = "";
        $data['message'] = $this->getFlashMessageData();

        $partials = array('header' => 'main_header_movies', 'content' => 'movies');
        $this->template->load('main_master', $partials, $data);
    }

    public function ajaxMoviesOpNaam()
    {
        $zoekstring = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->films_model->getFilmsOpNaam($zoekstring);

        if ($view == "cover") {
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
        }
    }

    public function ajaxMoviesOpJaar()
    {
        $zoekstring = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->films_model->getFilmsOpJaar($zoekstring);

        if ($view == "cover") {
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
        }
    }

    public function ajaxMoviesOpLaatstToegevoegd()
    {
        $aantal = $this->input->get('zoekstring');
        $view = $this->input->get('view');
        $data['movies'] = $this->films_model->getFilmsOpLaatstToegevoegd($aantal);

        if ($view == "cover") {
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
        }
    }

    public function ajaxAlleMovies()
    {
        $view = $this->input->get('view');
        $data['movies'] = $this->films_model->getAllMovies();

        if ($view == "cover") {
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
        }
    }

    public function ajaxMoviesMeestGedownload()
    {
        $view = $this->input->get('view');
        $data['movies'] = $this->films_model->getMoviesMeestGedownload();

        if ($view == "cover") {
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
        }
    }

    public function ajaxMoviesInfo()
    {
        $zoekid = $this->input->get('zoekid');
        $data['movie'] = $this->films_model->get($zoekid);
        $this->load->view('ajax_moviesInfo', $data);
    }

    public function ajaxGesorteerdeMovies()
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
        $data['movies'] = $this->films_model->getGesorteerdeMovies(
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
            $this->load->view('ajax_movies', $data);
        } else {
            $this->load->view('ajax_moviesList', $data);
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
