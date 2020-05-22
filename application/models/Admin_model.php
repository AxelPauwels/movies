<?php

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generateCodes()
    {
        $code = new stdClass();
        for ($i = 0; $i < 10; $i++) {
            $code->Rcode = mt_rand(1000000, 9999999);
            $this->db->insert('registercodes', $code);
        }
    }

    public function getRequests()
    {
        $this->db->where('aantalRequests !=', 0);
        $query = $this->db->get('films');
        return $query->result();
    }

    public function getCodes()
    {
        $query = $this->db->get('registercodes');
        return $query->result();
    }

    public function getUsers()
    {
        $this->db->order_by('laatstAangemeld', 'desc');
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getSettings()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('config');
        return $query->result();
    }

    public function updateSettings($setting)
    {
        $this->db->where('id', $setting->id);
        $this->db->update('config', $setting);
    }

    public function getSeizoenIdByName($naam)
    {
        $query = $this->db->get('episodesSeizoen');
        $this->db->where('naam', $naam);
        return $query->row();
    }

    public function insertFilm($naam, $jaar, $type, $taal, $duur, $grootte, $toegevoegd, $download, $imdb)
    {
        $movie = new stdClass();
        $movie->naam = strtoupper($naam);
        $movie->jaar = $jaar;
        $movie->type = strtoupper($type);
        $movie->taal = strtoupper($taal);
        $movie->duur = $duur;
        $movie->grootte = $grootte;
        $movie->toegevoegd = $toegevoegd;
        $movie->download = $download;
        $movie->imdb = $imdb;

        $this->db->insert('films', $movie);
    }

    public function insertMovie($movie)
    {
        $this->db->insert('films', $movie);
    }

    public function insertComedy($movie)
    {
        $this->db->insert('comedy', $movie);
    }

    public function insertDocumentary($movie)
    {
        $this->db->insert('documentary', $movie);
    }

    public function insertEpisodeSeizoenEpisode($seizoen)
    {
        $this->db->insert('episodesSeizoen', $seizoen);
        return $this->db->insert_id();
    }

    public function insertEpisodeSeizoenDocumentary($seizoen)
    {
//        $this->db->insert('documentary_episodesSeizoen', $seizoen);
//        return $this->db->insert_id();
    }

    public function insertEpisode($episode)
    {
        $this->db->insert('episodes', $episode);
    }

}
