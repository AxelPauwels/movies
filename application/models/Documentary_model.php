<?php

class Documentary_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get($zoekid)
	{
		$this->db->where('id', $zoekid);
		$query = $this->db->get('documentary');
		return $query->row();
	}
	
	public function getDocumentariesOpNaam($zoekstring)
	{
		$this->db->select('*');
		$this->db->like('LOWER(naam)', strtolower($zoekstring));
		$this->db->order_by('naam', 'asc');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');

		return $query->result();
	}

	public function getDocumentariesOpJaar($zoekstring)
	{
		$this->db->select('*');
		$this->db->like('jaar', $zoekstring, 'after');
		$this->db->order_by('naam', 'asc');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');

		return $query->result();
	}

	public function getDocumentariesOpLaatstToegevoegd($aantal)
	{
		$this->db->select('*');
		$this->db->order_by('toegevoegd', 'desc');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$this->db->limit($aantal);
		$query = $this->db->get('documentary');

		return $query->result();
	}

	public function getAlleDocumentaries()
	{
		$this->db->select('*');
		$this->db->order_by('naam', 'asc');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');

		return $query->result();
	}

	public function getDocumentaryEpisodesBySeizoenId($seizoenId)
	{
		$this->db->select('*');
		$this->db->where('seizoenId', $seizoenId);
		$query = $this->db->get('documentary');

		return $query->result();
	}
}
