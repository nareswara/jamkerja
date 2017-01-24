<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_jamkerja extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	
	public function create()
	{
		return $this->db->insert('tr_hutang',array(
			'int_nik'=>$this->input->post('int_nik',true),
			'int_jam'=>$this->input->post('int_jam',true),
			'dt_tanggal'=>$this->input->post('dt_tanggal',true)
		));
	}
	
	public function update($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('tr_hutang',array(
			'int_nik'=>$this->input->post('int_nik',true),
			'int_jam'=>$this->input->post('int_jam',true),
			'dt_tanggal'=>$this->input->post('dt_tanggal',true)
		));
	}
	
	function getdept(){
        
        $query = $this->db->get('ms_departemen');
 
        return $query->result();
    }
	
	public function delete($id)
	{
		return $this->db->delete('mobil', array('id' => $id)); 
	}
	
	function generatenik($getdeptid){
		
		$this->db->where('int_jam', 0);
        $this->db->delete('tr_hutang'); 
		
        $this->db->select('nik');	
		$this->db->where('deptid',$getdeptid);
		$criteria = $this->db->get('ms_karyawan');
		
		
		foreach($criteria->result_array() as $data)
		{	
			
           $info = array(
                'int_nik' => $data['nik'],
				'int_jam' => '0'
            );

			$this->db->insert('tr_hutang', $info); 

		}
		
		
		
//		$result=array_merge($result,array('rows'=>$row));
	//	return json_encode($result);
	}
	
	function semuas(){
      
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$offset = ($page-1) * $rows;
		//$deptid = isset($_POST['deptid']);
		// join table
		
		
		$result = array();
			$this->db->select('*');
            $this->db->from('tr_hutang');
           // $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
		    $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
			$this->db->where('tr_hutang.int_jam = ','0'); 
			//$this->db->where('vw_karyawan.deptid = ',$deptid); 
		$result['total'] = $this->db->get()->num_rows();
		$row = array();
		
		
		$this->db->limit($rows,$offset);
		$this->db->order_by($sort,$order);
			//$this->db->distinct();
			$this->db->select('*');
            $this->db->from('tr_hutang');
            $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
            $this->db->order_by('id','asc');
			$this->db->where('tr_hutang.int_jam = ','0'); 
			$this->db->where('vw_karyawan.deptid = ',$deptid); 
			$criteria = $this->db->get();
		
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'id'=>$data['id'],
				'int_nik'=>$data['int_nik'],
				'nama'=>$data['nama'],
				'int_jam'=>$data['int_jam'],
				'dt_tanggal'=>$data['dt_tanggal']
				//'deptid'=>$deptid
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
    }
	
	
	//function semua($deptid){
		function semua($dept){
      
	  $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$offset = ($page-1) * $rows;
		//$deptid = isset($_POST['deptid']);
		// join table
		
		
		$result = array();
			$this->db->select('*');
            $this->db->from('tr_hutang');
           // $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
		    $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
			$this->db->where('tr_hutang.int_jam = ','0'); 
			$this->db->or_where('tr_hutang.dt_tanggal','');
			$this->db->where('vw_karyawan.deptid = ',$dept); 
			
		$result['total'] = $this->db->get()->num_rows();
		$row = array();
		
		
		$this->db->limit($rows,$offset);
		$this->db->order_by($sort,$order);
			//$this->db->distinct();
			$this->db->select('*');
            $this->db->from('tr_hutang');
            $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
            $this->db->order_by('id','asc');
			$this->db->where('tr_hutang.int_jam = ','0'); 
			$this->db->where('vw_karyawan.deptid = ',$dept); 
			$criteria = $this->db->get();
		
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'id'=>$data['id'],
				'int_nik'=>$data['int_nik'],
				'nama'=>$data['nama'],
				'int_jam'=>$data['int_jam'],
				'dt_tanggal'=>$data['dt_tanggal']
				//'deptid'=>$deptid
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
    }
	
	public function getJson()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$offset = ($page-1) * $rows;
		
		// join table
		
		
		$result = array();
		$result['total'] = $this->db->get('tr_hutang')->num_rows();
		$row = array();
		
		
		$this->db->limit($rows,$offset);
		$this->db->order_by($sort,$order);
		$criteria = $this->db->get('tr_hutang');
		
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'id'=>$data['id'],
				'int_nik'=>$data['int_nik'],
				'int_jam'=>$data['int_jam'],
				'dt_tanggal'=>$data['dt_tanggal']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
}

/* End of file crud_model.php */
/* Location: ./application/controllers/crud_model.php */