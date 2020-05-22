<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authex
{

    public function __construct()
    {
        $CI = &get_instance();
        $CI->load->model('user_model');
    }

    public function loggedIn()
    {
        // gebruiker is aangemeld als sessievariabele user_id bestaat
        $CI = &get_instance();
        if ($CI->session->has_userdata('user_id')) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo()
    {
        // geef user-object als gebruiker aangemeld is
        $CI = &get_instance();
        if (!$this->loggedIn()) {
            return null;
        } else {
            $id = $CI->session->userdata('user_id');
            return $CI->user_model->get($id);
        }
    }

    public function getUserId()
    {
        // geef user-id als gebruiker aangemeld is
        $CI = &get_instance();
        if (!$this->loggedIn()) {
            return null;
        } else {
            $userId = $CI->session->userdata('user_id');
            return $userId;
        }
    }

    public function getUserIdByEmail($email)
    {
        // geef user-id als gebruiker aangemeld is
        $CI = &get_instance();
        return $CI->user_model->getUserIdByEmail($email);
    }

    public function login($email, $password)
    {
        // gebruiker aanmelden met opgegeven email en wachtwoord
        $CI = &get_instance();
        $user = $CI->user_model->getAccount($email, $password);
        if ($user == null) {
            return false;
        } else {
            $CI->user_model->updateLaatstAangemeld($user->id);
            $CI->session->set_userdata('user_id', $user->id);
            return true;
        }
    }

    public function logout()
    {
        // uitloggen, dus sessievariabele wegdoen
        $CI = &get_instance();
        $CI->session->unset_userdata('user_id');
    }

    public function register($naam, $email, $password, $Rcode)
    {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = &get_instance();
        if ($CI->user_model->rCodeExist($Rcode)) {
            if ($CI->user_model->emailVrij($email)) {
                $id = $CI->user_model->insert($naam, $email, $password);
                $CI->user_model->deleteRcode($Rcode);
                return $id;
            } else {
                return 'email_bestaat_al';
            }
        } else {
            return 'code_bestaat_niet'; // bestaat niet in db
        }
    }

    public function registerUpdate($id, $naam, $email)
    {
        $CI = &get_instance();
        $CI->user_model->updateUserProfile($id, $naam, $email);
    }

    public function registerUpdateWithPassword($id, $naam, $email, $password)
    {
        $CI = &get_instance();
        $CI->user_model->updateUserProfileWithPassword($id, $naam, $email, $password);
    }

    public function updateWachtwoord($email, $newpassword)
    {
        $CI = &get_instance();
        $CI->user_model->updateWachtwoord($email, $newpassword);
    }

    public function deleteProfile($id)
    {
        $CI = &get_instance();
        $CI->user_model->deleteProfile($id);
    }

    public function activate($id)
    {
        // nieuwe gebruiker activeren
        $CI = &get_instance();
        $CI->user_model->activeer($id);
    }

    public function emailExist($email)
    {
        $CI = &get_instance();
        if (!$CI->user_model->emailVrij($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserGedownload($userId)
    {
        $CI = &get_instance();
        $CI->load->model('user_model');
        $currentCount = $CI->user_model->getUserGedownload($userId);
        $newCount = ($currentCount->gedownload + 1);
        $CI->user_model->updateUserGedownload($userId, $newCount);
    }


// NORMALLY THESE FUNCTIONS ARE UNUSED (MOVED TO CORRECT CONTROLLER)
//    public function updateRequestCount($id)
//    {
//        $CI = &get_instance();
//        $CI->load->model('films_model');
//        $currentCount = $CI->films_model->getRequestCount($id);
//        $newCount = ($currentCount->aantalRequests + 1);
//        $CI->films_model->updateRequestCount($id, $newCount);
//    }
//
//    public function getEpisodesSeizoenCollectie()
//    {
//        $CI = &get_instance();
//        $CI->load->model('episodesSeizoen_model');
//        $data['episodesSeizoen'] = $CI->episodesSeizoen_model->getEpisodesSeizoenCollectie();
//        return $data;
//    }
//
//    public function updateRequestCountEpisodesSeizoen($id)
//    {
//        $CI = &get_instance();
//        $CI->load->model('episodesSeizoen_model');
//        $currentCount = $CI->episodesSeizoen_model->getRequestCountEpisodesSeizoen($id);
//        $newCount = ($currentCount->aantalRequests + 1);
//        $CI->episodesSeizoen_model->updateRequestCountEpisodesSeizoen($id, $newCount);
//    }
}
