<?php

class DocumentarySeizoen_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getDocumentarySeizoenenOpNaam($zoekstring)
	{
		$this->db->select('*');
		$this->db->like('LOWER(naam)', strtolower($zoekstring));
		$orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
		$this->db->where('id >', 0);
		$this->db->order_by($orderby);
		$query = $this->db->get('documentarySeizoen');

		return $query->result();
	}

	public function getDocumentarySeizoenenOpJaar($zoekstring)
	{
		$this->db->select('id,naam,jaar,download,type,imdb,imageUrl');
		$this->db->like('jaar', $zoekstring, 'after');
		$orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
		$this->db->where('id >', 0);
		$this->db->order_by($orderby);
		$query = $this->db->get('documentarySeizoen');

		return $query->result();
	}

	public function getDocumentarySeizoenOpLaatstToegevoegd($aantal)
	{
		$this->db->select('*');
		$this->db->order_by('toegevoegd', 'desc');
		$this->db->where('id >', 0);
		$this->db->limit($aantal);
		$query = $this->db->get('documentarySeizoen');

		return $query->result();
	}

	public function getAlleDocumentarySeizoen()
	{
		$this->db->select('*');
		$orderby = "LEFT(naam,LENGTH(naam)-3),jaar";
		$this->db->where('id >', 0);
		$this->db->order_by($orderby);
		$query = $this->db->get('documentarySeizoen');
		$documentarySeizoenen = $query->result();

		return $documentarySeizoenen;
	}

	public function getDocumentarySeizoenBySeizoenId($seizoenId)
	{
		$this->db->select('*');
		$this->db->where('id', $seizoenId);
		$query = $this->db->get('documentarySeizoen');

		return $query->row();
	}

	// statistieken
	public function getCountDocumentaries()
	{
		$info = new stdClass();
		$info->aantalSeizoenen = $this->db->count_all_results('documentarySeizoen');
		$info->aantalEpisodes = $this->db->count_all_results('documentary');
		// non-season documentary
		$this->db->select('*');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalDocumentaries = $query->num_rows();
		$info->totaalAantalDocumentaries = ($info->aantalSeizoenen + $info->aantalDocumentaries ) ; //season + non-season

		$info->soortSeizoenen = 'Seasons';
		$info->soortEpisodes = 'Episodes';
		$info->soortDocumentaries = 'Documentaries';

		$this->db->select('type');
		$this->db->where('type', 'HD');
		$info->aantalHD = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('type');
		$this->db->where('type', 'HD');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalHD += $query->num_rows();

		$this->db->select('type');
		$this->db->where('type', 'DVD');
		$info->aantalDVD = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('type');
		$this->db->where('type', 'DVD');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalDVD += $query->num_rows();

		$this->db->select('jaar');
		$this->db->where('jaar <=', 1999);
		$info->aantalJaarTot2000 = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('jaar');
		$this->db->where('jaar <=', 1999);
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalJaarTot2000 += $query->num_rows();

		$this->db->select('jaar');
		$this->db->where("(jaar>='2000' AND jaar<='2009')");
		$info->aantalJaarTot2010 = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('jaar');
		$this->db->where("(jaar>='2000' AND jaar<='2009')");
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalJaarTot2010 += $query->num_rows();

		$this->db->select('jaar');
		$this->db->where("(jaar>='2010' AND jaar<='2019')");
		$info->aantalJaarTot2020 = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('jaar');
		$this->db->where("(jaar>='2010' AND jaar<='2019')");
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalJaarTot2020 += $query->num_rows();

		$this->db->select('taal');
		$this->db->where('taal', 'NL');
		$info->aantalTaalNL = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('taal');
		$this->db->where('taal', 'NL');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalTaalNL += $query->num_rows();

		$this->db->select('taal');
		$this->db->where('taal', 'ENG');
		$info->aantalTaalENG = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('taal');
		$this->db->where('taal', 'ENG');
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalTaalENG += $query->num_rows();

		$this->db->select('taal');
		$this->db->where("(taal <> 'NL' AND taal<>'ENG')");
		$info->aantalTaalAnders = $this->db->count_all_results('documentarySeizoen');
		// non-season documentary
		$this->db->select('taal');
		$this->db->where("(taal <> 'NL' AND taal<>'ENG')");
		$this->db->where('seizoenId =', -1); // only non-season episodes
		$query = $this->db->get('documentary');
		$info->aantalTaalAnders += $query->num_rows();

		return $info;
	}
}
