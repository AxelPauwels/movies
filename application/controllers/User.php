<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('email');
    }

    public function nieuw()
    {
        $data['title'] = '';
        $data['footer'] = '';

        $partials = array(
            'header' => 'main_header',
            'menu' => 'main_menu',
            'content' => 'user_nieuw'
        );
        $this->template->load('main_master', $partials, $data);
    }

    private function sendmail($to, $id, $password = '')
    {
        $this->email->set_mailtype('html');
        $this->email->from('info.movieserver@gmail.com', 'Info Movies');
        $this->email->to($to);

        if ($password == '') {
            $this->email->subject('Account Activeren');
            $this->email->message(
                'U bent geregistreerd, klik ' .
                '<a href="' . site_url('/user/activeer/' . $id . '/' . sha1($id)) . '">hier</a>' .
                ' om je account te activeren '
            );
        } else {
            $this->email->subject('Wachtwoord Herstel');
            $this->email->message(
                '<div> Uw nieuw wachtwoord is:  ' . $password . '</div>' .
                '<div> Klik <a href="' . site_url('/home/login/') . '">hier</a>' . ' om je in te loggen </div>'
            );
        }
        $this->email->send();
    }

    public function registreer()
    {
        $naam = $this->input->post('naam');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        if ($password == $password2) {
            $Rcode = $this->input->post('Rcode');
            $info = $this->authex->register($naam, $email, $password, $Rcode); //info = code of id

            if ($info == 'code_bestaat_niet') {
                redirect('user/rCodeFout');
            } else {
                $id = $info;
                if ($id == 'email_bestaat_al') {
                    redirect('user/bestaat');
                } else {
                    $this->sendmail($email, $id);
                    redirect('user/klaar');
                }
            }
        }
    }

    public function registreerUpdate()
    {
        $id = $this->input->post('id');
        $naam = $this->input->post('naam');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        if ($password == null) {
            $this->authex->registerUpdate($id, $naam, $email);
        } else {
            if ($password == $password2) {
                $this->authex->registerUpdateWithPassword($id, $naam, $email, $password);
            } else {
                redirect('user/profileUpdateMislukt');
            }
        }
        redirect('home/profile');
    }

    public function profileUpdateMislukt()
    {
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array(
            'header' => 'main_header',
            'menu' => 'main_menu',
            'content' => 'profile_updateMislukt'
        );
        $this->template->load('main_master', $partials, $data);
    }

    public function profileDelete()
    {
        $id = $this->authex->getUserId();
        $this->authex->deleteProfile($id);
        redirect('home');
    }

    public function profileDeleteDevestiging()
    {
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'profile_delete_bevestiging');
        $this->template->load('main_master', $partials, $data);
    }

    public function activeer($id, $idHash)
    {
        if (sha1($id) == $idHash) {
            $id = $this->authex->activate($id);
            $data['title'] = 'Geactiveerd';
            $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
            $data['footer'] = '';

            $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'user_geactiveerd');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->redirect('registreer');
        }
    }

    public function bestaat()
    {
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'user_bestaat');
        $this->template->load('main_master', $partials, $data);
    }

    public function klaar()
    {
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'user_klaar');
        $this->template->load('main_master', $partials, $data);
    }

    public function wachtwoord()
    {
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'user_wachtwoord');
        $this->template->load('main_master', $partials, $data);
    }

    public function wachtwoordHerstel()
    {
        $email = $this->input->post('email');
        $newpassword = random_string('alpha', 8);

        if ($this->authex->emailExist($email)) {
            $id = $this->authex->getUserIdByEmail($email);
            $this->authex->updateWachtwoord($email, $newpassword);
            $this->sendmail($email, $id, $newpassword);
            redirect('user/wachtwoordHerstelGelukt');
        } else {
            //redirect('user/wachtwoordHerstelfout'); //niet goed omdat ...
            $this->wachtwoordHerstelfout();
        }
    }

    public function wachtwoordHerstelfout()
    {
//        $data['title'] = 'Deze e-mail bestaat niet';
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array(
            'header' => 'main_header',
            'menu' => 'main_menu',
            'content' => 'user_wachtwoordHerstelMislukt'
        );
        $this->template->load('main_master', $partials, $data);
    }

    public function wachtwoordHerstelGelukt()
    {
//        $data['title'] = 'Wachtwoord hersteld';
        $data['title'] = '';
        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen

        $partials = array(
            'header' => 'main_header',
            'menu' => 'main_menu',
            'content' => 'user_wachtwoordHerstelGelukt'
        );
        $this->template->load('main_master', $partials, $data);
    }

    public function rCodeFout()
    {
//        $data['title'] = 'Registratie Code onbekend';
        $data['title'] = '';

        $data['user'] = $this->authex->getUserInfo(); //nodig voor het menu links te tonen
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'menu' => 'main_menu', 'content' => 'user_RcodeFout');
        $this->template->load('main_master', $partials, $data);
    }
}
