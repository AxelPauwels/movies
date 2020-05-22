<?php

class Episodes_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getEpisodes($seizoenId)
    {
        $this->db->where('seizoenId', $seizoenId);
        $query = $this->db->get('episodes');
        return $query->result();
    }

    public function getEpisode($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('episodes');
        return $query->row();
    }

    public function getAllEpisodes()
    {
        $query = $this->db->get('episodes');
        return $query->result();
    }

}
