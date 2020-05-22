<?php
/**
 * Created by PhpStorm.
 * User: stefanieseker
 * Date: 7/12/19
 * Time: 10:52 AM
 */

class Config_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getConfigByName($configName)
    {
        $this->db->select('id,config_name,flash_message, flash_message_is_active');
        $this->db->where('config_name', $configName);
        $this->db->order_by('id', 'asc');
        $currentCount = $this->db->get('config');
        return $currentCount->row();
    }
}