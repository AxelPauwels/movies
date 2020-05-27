<?php

class Comedy_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getComediesOpNaam($zoekstring)
    {
        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
        $this->db->like('LOWER(naam)', strtolower($zoekstring));
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('comedy');
        return $query->result();
    }

    public function getComediesOpJaar($zoekstring)
    {
        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
        $this->db->like('jaar', $zoekstring, 'after');
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('comedy');
        return $query->result();
    }

    public function getAllComedies()
    {
        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('comedy');
        return $query->result();
    }

    public function getComediesMeestGedownload()
    {
        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
        $this->db->where('aantalDownloads >=', 3);
        $this->db->order_by('aantalDownloads', 'desc');
        $query = $this->db->get('comedy');
        return $query->result();
    }

    public function getGesorteerdeComedies(
        $taal,
        $type,
        $duurVan,
        $duurTot,
        $grootteVan,
        $grootteTot,
        $jaarVan,
        $jaarTot
    ) {

        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');

        if ($taal != "0") {
            $this->db->where('taal', $taal);
        }
        if ($type != "0") {
            $this->db->where('type', $type);
        }
        if ($duurVan != "0") {
            $this->db->where('duur >=', $duurVan);
        }
        if ($duurTot != "0") {
            $this->db->where('duur <=', $duurTot);
        }
        if ($grootteVan != "0") {
            $this->db->where('grootte >=', $grootteVan);
        }
        if ($grootteTot != "0") {
            $this->db->where('grootte <=', $grootteTot);
        }
        if ($jaarVan != "") {
            $this->db->where('jaar >=', $jaarVan);
        }
        if ($jaarTot != "") {
            $this->db->where('jaar <=', $jaarTot);
        }

        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('comedy');
        return $query->result();
    }

    public function get($zoekid)
    {
        $this->db->where('id', $zoekid);
        $query = $this->db->get('comedy');
        return $query->row();
    }

    public function getComediesOpLaatstToegevoegd($aantal)
    {
        $this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
        $this->db->order_by('toegevoegd', 'desc');
        $this->db->limit($aantal);
        $query = $this->db->get('comedy');
        return $query->result();
    }

    //statistieken

    public function getCountComedies()
    {
        $info = new stdClass();
        $info->aantalComedies = $this->db->count_all_results('comedy');
        $info->soortComedies = 'Comedies';

        $this->db->select('type');
        $this->db->where("(type='HD' OR type='3D')");
        $info->aantalHD = $this->db->count_all_results('comedy');

        $this->db->select('type');
        $this->db->where('type', 'DVD');
        $info->aantalDVD = $this->db->count_all_results('comedy');

        $this->db->select('jaar');
        $this->db->where('jaar <=', 1999);
        $info->aantalJaarTot2000 = $this->db->count_all_results('comedy');

        $this->db->select('jaar');
        $this->db->where("(jaar>='2000' AND jaar<='2009')");
        $info->aantalJaarTot2010 = $this->db->count_all_results('comedy');

        $this->db->select('jaar');
        $this->db->where("(jaar>='2010' AND jaar<='2019')");
        $info->aantalJaarTot2020 = $this->db->count_all_results('comedy');

        $this->db->select('taal');
        $this->db->where('taal', 'NL');
        $info->aantalTaalNL = $this->db->count_all_results('comedy');

        $this->db->select('taal');
        $this->db->where('taal', 'ENG');
        $info->aantalTaalENG = $this->db->count_all_results('comedy');

        $this->db->select('taal');
        $this->db->where("(taal <> 'NL' AND taal<>'ENG')");
        $info->aantalTaalAnders = $this->db->count_all_results('comedy');

        return $info;
    }
}
