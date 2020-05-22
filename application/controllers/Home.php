<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
	}

    public function index()
    {
		$data['title'] = '';
        $data['footer'] = '';
        $data['message'] = $this->getFlashMessageData();
		$data['user'] = $this->authex->getUserInfo();

        $partials = array('header' => 'main_header', 'content' => 'main_menu');
        $this->template->load('main_master', $partials, $data);
    }

    public function profile()
    {
        $data['title'] = '';
        $data['footer'] = '';
        $data['message'] = $this->getFlashMessageData();
		$data['user'] = $this->authex->getUserInfo();

		$partials = array('header' => 'main_header', 'content' => 'profile');
        $this->template->load('main_master', $partials, $data);
    }

    public function login()
    {
        $data['title'] = '';
        $data['footer'] = '';
        $data['message'] = $this->getFlashMessageData();

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'home_login');
        $this->template->load('main_master', $partials, $data);
    }

    public function fout()
    {
        $data['title'] = '';
        $data['footer'] = '';
        $data['message'] = $this->getFlashMessageData();


        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'home_fout');
        $this->template->load('main_master', $partials, $data);
    }

    public function aanmelden()
    {
//        $email = $this->input->post('email');
        $email = "info.movieserver@gmail.com"; // currently only this user can login
        $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->authex->login($email, $password)) {
            redirect('admin/getUsers');
        } else {
            redirect('home/fout');
        }
    }

    public function afmelden()
    {
        $this->authex->logout();
        redirect('home/index');
    }

    public function app()
    {
        $data['title'] = '';
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'content' => 'movieserverApp');
        $this->template->load('main_master', $partials, $data);
    }

    public function info()
    {
        $this->load->model('films_model');
        $this->load->model('episodesSeizoen_model');
        $this->load->model('comedy_model');
        $this->load->model('documentary_model');
        $this->load->model('documentarySeizoen_model');

        $data['title'] = '';
        $data['footer'] = '';
        $data['infoMovies'] = $this->films_model->getCountMovies();
        $data['infoEpisodes'] = $this->episodesSeizoen_model->getCountEpisodes();
        $data['infoComedies'] = $this->comedy_model->getCountComedies();
        $data['infoDocumentaries'] = $this->documentarySeizoen_model->getCountDocumentaries();
        $data['message'] = $this->getFlashMessageData();

        $partials = array('header' => 'main_header', 'content' => 'info');
        $this->template->load('main_master', $partials, $data);
    }

    public function siteProgress()
    {
        $data['title'] = '';
        $data['footer'] = '';
        $data['message'] = $this->getFlashMessageData();

        $partials = array('header' => 'main_header', 'content' => 'siteProgress');
        $this->template->load('main_master', $partials, $data);
    }

	public function subscription()
	{
		$data['title'] = '';
		$data['footer'] = '';
		$data['message'] = $this->getFlashMessageData();

		$partials = array('header' => 'main_header', 'content' => 'subscription');
		$this->template->load('main_master', $partials, $data);
	}

	public function subscriptionInvalid()
	{
		$data['title'] = '';
		$data['footer'] = '';
		$partials = array('header' => 'main_header', 'content' => 'discontinued');
		$this->template->load('main_master', $partials, $data);
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
