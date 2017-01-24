

<?php
class Jamkerja extends CI_Controller{
    private $limit=10;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_jamkerja');
		
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
	
	public function index()
	{
		if(isset($_GET['grid']))
			echo $this->m_jamkerjas->getJson();
		else{
			$data['dept'] = $this->m_jamkerja->getdept(); 
			$this->template->display('jamkerja/index',$data);
		//	$this->template->display('jamkerja/index');
		}
		// $this->template->display('hutang/index',$data);
	}
	
	public function getall() {
		//echo $this->m_jamkerja->getJson(); 
		//$_GET['deptid'];///
		//$deptid = $_GET['deptid'];
		//echo $this->$deptid ;
		$dept  =  $_GET['dept'];// $this->input->post('deptid'); 
		//$deptid  =  $_POST['dept'];// $this->input->post('deptid'); 
		//echo $this->m_jamkerja->semua($deptid); 
		//echo $this->m_jamkerja->semua($deptid); 
		//if(isset($_POST['dept'])){
			//$dept = $this->input->post('dept');
			echo $this->m_jamkerja->semua($dept);
		//}
		//}
		//else{
		 //  echo $this->m_jamkerja->semua(); 
	}
	
	public function getalls() {
		//echo $this->m_jamkerja->getJson(); 
		echo $this->m_jamkerja->semuas(); 
	}
	
	
	public function update()
	{
		//if(!isset($_POST))	
			//show_404();
		$id = intval(addslashes($_POST['id']));
		//$this->crud_model->update($id);
		if($this->m_jamkerja->update($id))
			echo json_encode(array('success'=>true));
		else
			echo json_encode(array('msg'=>'Gagal mengubah data'));
	}
	
	public function generatenik()
	{
		//if(!isset($_POST))	
			//show_404();
		 //$id = 4; //intval(addslashes($_POST['id']));
		   $id  = $this->input->post('deptid'); 
		    $info=array(
                    'int_nik'=>$this->input->post('int_nik'),
                    'int_jam'=>$this->input->post('int_jam'),
                    'dt_tanggal'=>$this->input->post('dt_tanggal')
                );
		//generatenik($getdeptid){
		//if($this->m_jamkerja->update($id))
			$this->m_jamkerja->generatenik($id);
		//	echo json_encode(array('success'=>true));
		//else
		//	echo json_encode(array('msg'=>'Gagal mengubah data'));
	}
	
	public function create()
	{
		//if(!isset($_POST))	
			//show_404();
		
		
		if($this->m_jamkerja->create())
			echo json_encode(array('success'=>true));
		else
			echo json_encode(array('msg'=>'Gagal memasukkan data'));
	}
    
   
}