<?php

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        // geef user-object met opgegeven $id
        $this->db->where('id', $id);
        $query = $this->db->get('users');

        return $query->row();
    }

    public function getUserIdByEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row()->id;
    }

    public function getAccount($email, $password)
    {
        // geef user-object met $email en $password EN geactiveerd = 1
        $this->db->where('email', strtolower($email));
        $this->db->where('password', sha1($password));
        $this->db->where('geactiveerd', 1);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function updateLaatstAangemeld($id)
    {
        $user = new stdClass();
        // pas tijd laatstAangemeld aan
        $user->laatstAangemeld = date("Y-m-d");
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function updateWachtwoord($email, $newpassword)
    {
        $user = new stdClass();
        $user->password = sha1($newpassword);
        $this->db->where('email', $email);
        $this->db->update('users', $user);
    }

    public function updateUserProfile($id, $naam, $email)
    {
        $user = new stdClass();
        $user->naam = $naam;
        $user->email = $email;
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function updateUserProfileWithPassword($id, $naam, $email, $password)
    {
        $user = new stdClass();
        $user->naam = $naam;
        $user->email = $email;
        $user->password = sha1($password);
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function deleteProfile($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function emailVrij($email)
    {
        // is email al dan niet aanwezig
        $this->db->where('email', strtolower($email));
        $query = $this->db->get('users');
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($naam, $email, $password)
    {
        $user = new stdClass();

        // voeg nieuwe user toe
        $user->naam = $naam;
        $user->email = strtolower($email);
        $user->password = sha1($password);
        $user->level = 1;
        $user->creatie = date("Y-m-d");
        $user->laatstAangemeld = date("Y-m-d");
        $user->geactiveerd = 0;
        $user->geaboneerd = "0000-00-00";
        $this->db->insert('users', $user);
        return $this->db->insert_id();
    }

    public function activeer($id)
    {
        $user = new stdClass();

        // plaats geactiveerd op 1
        $user->geactiveerd = 1;
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function rCodeExist($Rcode)
    {
        // is Rcode aanwezig?
        $this->db->where('Rcode', intval($Rcode));
        $query = $this->db->get('registercodes');
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteRcode($Rcode)
    {
        // verwijder Rcode
        $this->db->where('Rcode', $Rcode);
        $this->db->delete('registercodes');
    }

    public function getUserGedownload($id)
    {
        $this->db->select('gedownload');
        $this->db->where('id', $id);
        $currentCount = $this->db->get('users');
        return $currentCount->row();
    }

    public function updateUserGedownload($id, $newCount)
    {
        $user = new stdClass();
        $user->gedownload = $newCount;
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function updateSubscription($id){
		$user = new stdClass();
		$user->geabonneerd = date("Y-m-d");
		$this->db->where('id', $id);
		$this->db->update('users', $user);
	}
}
