<?php
class departemen extends Controller{

	function __construct(){
		parent::Controller();
		$this->load->model('m_departemen');
	}
	
	function index(){		
		$data['dept'] = $this->MChain->getPropinsiList();
		$this->load->view('chain/index',$data);
	}
	
	function select_dept(){
          
        	$data['dept'] = $this->m_departemen->getDept();		
		    $this->load->view('chain/kota',$data);
            
		
	}
        
        function submit(){
            echo "Propinsi ID = ".$this->input->post("provinsi_id");
            echo "<br>";
            echo "Kota ID = ".$this->input->post("kota_id");
        }
}
?>
