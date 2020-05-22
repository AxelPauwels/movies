<?php

class EpisodesSeizoen_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getEpisodesSeizoenOpNaam($zoekstring)
    {
        $this->db->select('id,naam,jaar,download,type,imdb');
        $this->db->like('LOWER(naam)', strtolower($zoekstring));
        $orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
        $this->db->order_by($orderby);
        $query = $this->db->get('episodesSeizoen');
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getEpisodesSeizoenOpJaar($zoekstring)
    {
        $this->db->select('id,naam,jaar,download,type,imdb');
        $this->db->like('jaar', $zoekstring, 'after');
        $orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
        $this->db->order_by($orderby);
        $query = $this->db->get('episodesSeizoen');
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getAlleEpisodesSeizoen()
    {
        $this->db->select('id,naam,jaar,collectie,download,type,imdb');
        $orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
        $this->db->order_by($orderby);
        $query = $this->db->get('episodesSeizoen');
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getAantalSeizoenenPerCollectie($collectieNaam)
    {
        $this->db->distinct();
        $this->db->where('collectie', $collectieNaam);
        $query = $this->db->get('episodesSeizoen');
        return $query->num_rows();
    }

    public function getEpisodesMeestGedownload()
    {
        $this->db->select('id,naam,jaar,download,type,imdb');
        $this->db->where('aantalDownloads >=', 1);
        $this->db->order_by('aantalDownloads', 'desc');
        $query = $this->db->get('episodesSeizoen');
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getAlleEpisodesByCollectie($collectie)
    {
        $this->db->select('id,naam,collectie,download,type,imdb');
        $this->db->where('collectie', $collectie);
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('episodesSeizoen');
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getEpisodesSeizoenOpLaatstToegevoegd($aantal)
    {
        $this->db->select('id,naam,jaar,download,type,imdb');
        $this->db->order_by('toegevoegd', 'desc');
        $this->db->limit($aantal);
        $query = $this->db->get('episodesSeizoen');

        $episodesSeizoenen = $query->result();
        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    public function getEpisodesSeizoen($zoekid)
    {

        $this->db->where('id', $zoekid);
        $query = $this->db->get('episodesSeizoen');
        $seizoen = $query->row();

        $this->load->model('episodes_model');
        $this->db->order_by('id', 'desc');

        $seizoen->episodes = $this->episodes_model->getEpisodes($seizoen->id);
        return $seizoen;
    }

    public function getGesorteerdeEpisodes($taal, $type, $collectie, $seizoen, $jaarVan, $jaarTot)
    {
        $this->db->select('id,naam,jaar,collectie,download,type,imdb');
        if ($taal != "0") {
            $this->db->where('taal', $taal);
        }
        if ($type != "0") {
            $this->db->where('type', $type);
        }
        if ($collectie != "0") {
            $this->db->where('collectie', $collectie);
        }
        if ($seizoen != "0") {
            $this->db->where('naam', $seizoen);
        }
        if ($jaarVan != "") {
            $this->db->where('jaar >=', $jaarVan);
        }
        if ($jaarTot != "") {
            $this->db->where('jaar <=', $jaarTot);
        }
        $orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
        $this->db->order_by($orderby);
        $query = $this->db->get('episodesSeizoen');
//        return $query->result();
        $episodesSeizoenen = $query->result();

        //get episodes of this season
        foreach ($episodesSeizoenen as $seizoen) {
            $this->db->where('seizoenId', $seizoen->id);
            $query = $this->db->get('episodes');
            $seizoen->episodes = $query->result();
        }

        return $episodesSeizoenen;
    }

    //statistieken

    public function getCountEpisodes()
    {
        $info = new stdClass();
        $info->aantalSeizoenen = $this->db->count_all_results('episodesSeizoen');
        $info->aantalEpisodes = $this->db->count_all_results('episodes');
        $info->soortSeizoenen = 'Seasons';
        $info->soortEpisodes = 'Episodes';

        $this->db->select('type');
        $this->db->where('type', 'HD');
        $info->aantalHD = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('type');
        $this->db->where('type', 'DVD');
        $info->aantalDVD = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('jaar');
        $this->db->where('jaar <=', 1999);
        $info->aantalJaarTot2000 = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('jaar');
        $this->db->where("(jaar>='2000' AND jaar<='2009')");
        $info->aantalJaarTot2010 = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('jaar');
        $this->db->where("(jaar>='2010' AND jaar<='2019')");
        $info->aantalJaarTot2020 = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('taal');
        $this->db->where('taal', 'NL');
        $info->aantalTaalNL = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('taal');
        $this->db->where('taal', 'ENG');
        $info->aantalTaalENG = $this->db->count_all_results('episodesSeizoen');

        $this->db->select('taal');
        $this->db->where("(taal <> 'NL' AND taal<>'ENG')");
        $info->aantalTaalAnders = $this->db->count_all_results('episodesSeizoen');

        return $info;
    }
}
