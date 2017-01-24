<?php
class M_hutang extends CI_Model{
    private $table="tr_hutang";
    private $primary="id";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type)){
			//$this->db->distinct();
			$this->db->select('*');
            $this->db->from($table);
            $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_hutang.int_nik');
            $this->db->order_by($this->primary,'asc');
		}
        else{
			$this->db->distinct();
			$this->db->select('tr_hutang.*,vw.nama,vw.dept');
           // $this->db->from($table);
            $this->db->join('vw_karyawan vw', 'vw.nik = tr_hutang.int_nik');
            $this->db->order_by($order_column,$order_type);
		}
        return $this->db->get($this->table,$limit,$offset);
    }
    
	function akumulasi(){
		 //$this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4') AS amount_paid', FALSE); 
         //$query = $this->db->get('mytable');
		 $this->db->select('select  vw.nik, vw.nama,sum(th.int_jam) from vw_karyawan vw left join tr_hutang th on th.int_nik = vw.nik group by nik',false);
		 
		 return  $this->db->get();
	}
	
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
		$this->db->select('tr_hutang.*,vw.nama,vw.dept');
           // $this->db->from($table);
            $this->db->join('vw_karyawan vw', 'vw.nik = tr_hutang.int_nik');
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    
	 function seek($keyword){
        $this->db->select('nama')->from('vw_karyawan');
        $this->db->like('nama',$keyword);
        $query = $this->db->get();
 
        return $query->result();
    }
	
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
    
    function update($kode,$jenis){
        $this->db->where($this->primary,$kode);
        $this->db->update($this->table,$jenis);
    }
    
    function hapus($kode){
        $this->db->where($this->primary,$kode);
        $this->db->delete($this->table);
    }
    /*
    function cari($cari){
		
       // $this->db->like($this->primary,$cari);
	    $this->db->like("int_nik",$cari);
      // $this->db->or_like("int_nik",$cari);
        return $this->db->get($this->table);
    }*/

	 function cari($cari){
		$this->db->distinct();
	    $this->db->select('tr_hutang.*,vw.nama,vw.dept');  
		$this->db->from('tr_hutang');
        $this->db->join('vw_karyawan vw', 'vw.nik = tr_hutang.int_nik');	
        $this->db->like("nik",$cari);
        $this->db->or_like("nama",$cari);
        return $this->db->get();
    }	
	
	 public function cari_nik($kode){
        $this->db->like('nik',$kode);
        $query=$this->db->get('nik');
        return $query->result();
     }
}