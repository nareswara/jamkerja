<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function tambah(){
		$this->load->view('index');
	}
	
	 function index(){
            $this->template->display('anggota/index');
    }
	
	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		// cari di database
		$data = $this->db->from('autocomplete')->like('nama',$keyword)->get();	

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama,
				'nim'	=>$row->nim,
				'jurusan'	=>$row->jurusan

			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
	}
}
?>