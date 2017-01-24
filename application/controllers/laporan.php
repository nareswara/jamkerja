<?php class Laporan extends CI_Controller{
	private $limit=10;
    private $all = 0;
    function __construct(){
        parent::__construct();
       // $this->load->library(array('template','pagination'));
		$this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_laporan');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function anggota(){
        $data['title']="Data Anggota";
        $data['anggota']=$this->m_laporan->semuaAnggota()->result();
        $this->template->display('laporan/anggota',$data);
    }
	
	public function laporanakumulasi(){
		$cari=$this->input->post('cari');
		$dt_tanggal=$this->input->post('dt_tanggal');
		$dt_tanggal1=$this->input->post('dt_tanggal1');
		//if ($cari=='') {
		if (empty($cari) && (!empty($dt_tanggal))) {
		
			$this->akumulasi($cari,$dt_tanggal,$dt_tanggal1);
		}
		else {
			$this->cariakumulasi();
		}
	}
	
	public function akumulasi()
    {
				$cari=$this->input->post('cari');
		$dt_tanggal=$this->input->post('dt_tanggal');
		$dt_tanggal1=$this->input->post('dt_tanggal1');
//        configurasi pagination
        $config['base_url'] = site_url('laporan/akumulasi/');
        $config['total_rows'] = $this->m_laporan->jumlahakumulasi($dt_tanggal,$dt_tanggal1);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config); 
        
//        menentukan offset record dari uri segment
        $start = $this->uri->segment(3, 0);
//        ubah data menjadi tampilan per limit
        $rows = $this->m_laporan->user_limit($config['per_page'],$start,$dt_tanggal,$dt_tanggal1)->result();
 
        $data = array(
            'title' => 'Akumulasi Jam Kerja',
            'rows' => $rows,
            'pagination' => $this->pagination->create_links(),
            'start' => $start
        );

        $this->template->display('laporan/akumulasi_jam',$data);
     
    }
    
   
	
	 function cariakumulasi(){
           $data['title']="Pencarian";
        $cari=$this->input->post('cari');
		$dt_tanggal=$this->input->post('dt_tanggal');
		$dt_tanggal1=$this->input->post('dt_tanggal1');
		
		/*	$info=array(
                    'int_nik'=>$this->input->post('cari'),
                    'dt_tanggal'=>$this->input->post('dt_tanggal'),
                    'dt_tanggal1'=>$this->input->post('dt_tanggal1')
		);*/
				
        $cek=$this->m_laporan->cariakumulasi($cari,$dt_tanggal,$dt_tanggal1);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['anggota']=$cek->result();
            $this->template->display('laporan/akumulasi_jam_cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['anggota']=$cek->result();
			
            $this->template->display('laporan/akumulasi_jam_cari',$data);
        }
    }
    
    function peminjaman(){
        $data['title']="Laporan Peminjaman";
        $this->template->display('laporan/peminjaman',$data);
    }
    
    function cari_pinjaman(){
        $data['title']="Detail Peminjaman";
        $tanggal1=$this->input->post('tanggal1');
        $tanggal2=$this->input->post('tanggal2');
        $data['lap']=$this->m_laporan->detailpeminjaman($tanggal1,$tanggal2)->result();
        $this->load->view('laporan/cari_pinjaman',$data);
    }
    
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_laporan->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_laporan->detail_pinjam($id)->result();
        $this->template->display('laporan/detail_pinjam',$data);
    }
    
    function pengembalian(){
        $data['title']="Data Pengembalian";
        $this->template->display('laporan/pengembalian',$data);
    }
    
    function cari_pengembalian(){
        $data['title']="Detail Pengembalian";
        $tanggal1=$this->input->post('tanggal1');
        $tanggal2=$this->input->post('tanggal2');
        $data['lap']=$this->m_laporan->detailpengembalian($tanggal1,$tanggal2)->result();
        $this->load->view('laporan/cari_pengembalian',$data);
    }
	}