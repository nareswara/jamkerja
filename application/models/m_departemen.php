<?php
class m_departemen extends Model{
	function __construct(){
		parent::Model();
	}
	
	function getDept(){
		$result = array();
		$this->db->select('*');
		$this->db->from('ms_departemen');
		$this->db->order_by('dept','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Dept-';
            $result[$row->id]= $row->dept;
        }
        
        return $result;
	}

	function getKotaList(){
		$propinsi_id = $this->input->post('propinsi_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kota_kabupaten');
		$this->db->where('propinsi_id',$propinsi_id);
		$this->db->order_by('kota_kabupaten','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kota / Kabupaten-';
            $result[$row->kota_id]= $row->kota_kabupaten;
        }
        
        return $result;
	}

}
?>
