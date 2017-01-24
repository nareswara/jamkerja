<?php
class M_tabungan extends CI_Model{
    private $table="tr_tabungan";
    private $primary="id";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type)){
			//$this->db->distinct();
			$this->db->select('*');
            $this->db->from($table);
            $this->db->join('vw_karyawan', 'vw_karyawan.nik = tr_tabungan.id');
            $this->db->order_by($this->primary,'asc');
		}
        else{
			$this->db->distinct();
			$this->db->select('tr_tabungan.*,vw.nama,vw.dept');
           // $this->db->from($table);
            $this->db->join('vw_karyawan vw', 'vw.nik = tr_tabungan.int_nik');
            $this->db->order_by($order_column,$order_type);
		}
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
		$this->db->select('tr_tabungan.*,vw.nama,vw.dept');
           // $this->db->from($table);
            $this->db->join('vw_karyawan vw', 'vw.nik = tr_tabungan.int_nik');
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
	    $this->db->select('tr_tabungan.*,vw.nama,vw.dept');  
		$this->db->from('tr_tabungan');
        $this->db->join('vw_karyawan vw', 'vw.nik = tr_tabungan.int_nik');	
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