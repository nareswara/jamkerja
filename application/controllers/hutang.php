<?php
class Hutang extends CI_Controller{
    private $limit=10;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_hutang');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='int_nik',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='int_nik';
        if(empty($order_type)) $order_type='asc';
        
        //load data
		//$paging
		/*$page=$this->input->get('per_page');
		if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
           $offset = 0;
        else:
           $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
        endif; */


        $data['hutang']=$this->m_hutang->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Data Jam Kerja";
        
        $config['base_url']=site_url('hutang/index/');
        $config['total_rows']=$this->m_hutang->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
		
		//        menentukan offset record dari uri segment
       // $start = $this->uri->segment(3, 0);
		
        $data['pagination']=$this->pagination->create_links();
       // $data['jlhpage']=$page;
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('hutang/index',$data);
    }
	
	function search(){
 
     // memproses hasil pengetikan keyword pada form
     $keyword = $this->input->post('term');
     $data['response'] = 'false'; //mengatur default response
     $this->load->model('m_hutang'); // memanggil file model
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
         $this->load->view('hutang/index',$data); //memanggil file view dan mengisi data yg diperoleh
     }
 
	}
    
	
    
    function edit($id){
		
        $data['title']="Edit Data Hutang";
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
            $this->m_hutang->update($id,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data hutang 
            $data['hutang']=$this->m_hutang->cek($id)->row_array();
            $this->template->display('hutang/edit',$data);
        }else{
            $data['hutang']=$this->m_hutang->cek($id)->row_array();
            $data['message']="";
            $this->template->display('hutang/edit',$data);
        }
    }
    
    
    function tambah(){
		$tgl = $this->input->post('dt_tanggal');
        $data['title']="Input Perhitungan Jam Kerja";
		$data['tgl']=$tgl;
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nik=$this->input->post('int_nik');
            //$cek=$this->m_hutang->cek($nik);
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
				
                $this->m_hutang->simpan($info);
                //redirect('hutang/index/add_success');
				//$data['tgl']=$tgl;
				$data['message']="";
				$this->template->display('hutang/tambah',$data);
            }
        else{
			//$data['tgl']=$tgl;
            $data['message']="";
            $this->template->display('hutang/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_hutang->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/hutang/".$det->image);
	endforeach;
        $this->m_hutang->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_hutang->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['hutang']=$cek->result();
            $this->template->display('hutang/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['hutang']=$cek->result();
            $this->template->display('hutang/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('int_nik','nik','required|max_length[10]');
        $this->form_validation->set_rules('int_jam','jam','required|max_length[50]');
        $this->form_validation->set_rules('dt_tanggal','Tanggal','required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}