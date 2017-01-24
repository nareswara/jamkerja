<?php
class Tabungan extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_tabungan');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='int_nik',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='int_nik';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['tabungan']=$this->m_tabungan->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Data Tabungan";
        
        $config['base_url']=site_url('tabungan/index/');
        $config['total_rows']=$this->m_tabungan->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('tabungan/index',$data);
    }
	
	function search(){
 
     // memproses hasil pengetikan keyword pada form
     $keyword = $this->input->post('term');
     $data['response'] = 'false'; //mengatur default response
     $this->load->model('m_tabungan'); // memanggil file model
     $query = $this->home_model->seek($keyword); //memanggil fungsi pencarian pada model
 
     if(! empty($query) ) {
          $data['response'] = 'true'; //mengatur response
          $data['message'] = array(); //membuat array
          foreach( $query as $row ){
           $data['message'][] = array('nama' => $row->nama, 'nama' => $row->nama); //mengisi array dengan record yang diperoleh
          }
 
     }
 
     //konstanta IS_AJAX
     if(IS_AJAX){
          echo json_encode($data); //mencetak json jika merupakan permintaan ajax
     }
     else {
         $this->load->view('tabungan/index',$data); //memanggil file view dan mengisi data yg diperoleh
     }
 
	}
    
	
    
    function edit($id){
        $data['title']="Edit Data Tabungan";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('id');
            //setting konfiguras upload image
           // $config['upload_path'] = './assets/img/hutang/';
	   // $config['allowed_types'] = 'gif|jpg|png';
	   // $config['max_size']	= '1000';
	   // $config['max_width']  = '2000';
	  //  $config['max_height']  = '1024';
                
        //    $this->upload->initialize($config);
         //   if(!$this->upload->do_upload('gambar')){
         //       $gambar="";
         //   }else{
          //      $gambar=$this->upload->file_name;
          //  }
            
            $info=array(
               
                'int_jam'=>$this->input->post('int_jam'),
                'dt_tanggal'=>$this->input->post('dt_tanggal')
            );
            //update data angggota
            $this->m_tabungan->update($id,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data hutang 
            $data['tabungan']=$this->m_tabungan->cek($id)->row_array();
            $this->template->display('tabungan/edit',$data);
        }else{
            $data['tabungan']=$this->m_tabungan->cek($id)->row_array();
            $data['message']="";
            $this->template->display('tabungan/edit',$data);
        }
    }
    
    
    function tambah(){
        $data['title']="Tambah Data tabungan";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nik=$this->input->post('int_nik');
            //$cek=$this->m_tabungan->cek($nik);
           // if($cek->num_rows()>0){
            //    $data['message']="<div class='alert alert-warning'>Nis sudah digunakan</div>";
            //    $this->template->display('hutang/tambah',$data);
            //}else{
                //setting konfiguras upload image
              //  $config['upload_path'] = './assets/img/hutang/';
		//$config['allowed_types'] = 'gif|jpg|png';
	//	$config['max_size']	= '1000';
		//$config['max_width']  = '2000';
		//$config['max_height']  = '1024';
                
          //      $this->upload->initialize($config);
            //    if(!$this->upload->do_upload('gambar')){
              //      $gambar="";
              //  }else{
                //    $gambar=$this->upload->file_name;
               // }
                
                $info=array(
                    'int_nik'=>$this->input->post('int_nik'),
                    'int_jam'=>$this->input->post('int_jam'),
                    'dt_tanggal'=>$this->input->post('dt_tanggal')
                );
				
                $this->m_tabungan->simpan($info);
                redirect('tabungan/index/add_success');
            }
        else{
            $data['message']="";
            $this->template->display('tabungan/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_tabungan->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/tabungan/".$det->image);
	endforeach;
        $this->m_tabungan->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_tabungan->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['tabungan']=$cek->result();
            $this->template->display('tabungan/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['tabungan']=$cek->result();
            $this->template->display('tabungan/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('int_nik','nik','required|max_length[10]');
        $this->form_validation->set_rules('int_jam','jam','required|max_length[50]');
        $this->form_validation->set_rules('dt_tanggal','Tanggal','required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}