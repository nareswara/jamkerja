<?php
class M_Laporan extends CI_Model{
    #code
    
      
	
	function semuaAnggota(){
        return $this->db->get("anggota");
    }
    
    function semuaAkumulasi($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type)){
			//$this->db->distinct();
		$this->db->select('vw.nik,vw.dept, vw.nama,sum(th.int_jam) akumulasi');
        $this->db->from('vw_karyawan vw');
        $this->db->join('tr_hutang th', ' th.int_nik = vw.nik','left');
		$this->db->where('th.dt_tanggal >=', '2017-01-14'); 
		$this->db->where('th.dt_tanggal <=', '2017-01-20'); 
	    $this->db->group_by("vw.nik");
		}
        else{
		$this->db->select('vw.nik,vw.dept, vw.nama,sum(th.int_jam) akumulasi');
        $this->db->from('vw_karyawan vw');
        $this->db->join('tr_hutang th', ' th.int_nik = vw.nik','left');
		$this->db->where('th.dt_tanggal >=', '2017-01-14'); 
		$this->db->where('th.dt_tanggal <=', '2017-01-20'); 
	    $this->db->group_by("vw.nik");
		}
        return $this->db->get('',$limit,$offset);
    } 
	
	 function jumlahakumulasi($dt_tanggal,$dt_tanggal1){
       // return $this->db->count_all("vw_karyawan");
	    $this->db->select('vw.nik,vw.dept, vw.nama,sum(th.int_jam) akumulasi');
	    $this->db->from('vw_karyawan vw');
      // $this->db->where("(nama LIKE '%$cari%'");
	  // $this->db->or_where("dept LIKE '%$cari%')");
	    $this->db->join('tr_hutang th', ' th.int_nik = vw.nik','left');
		if (!empty($dt_tanggal)) {
			$this->db->where('th.dt_tanggal >=', $dt_tanggal);
		$this->db->where('th.dt_tanggal <=', $dt_tanggal1);
		}
		
	    $this->db->group_by("vw.nik");
    
        return $this->db->get()->num_rows();
	  // return $this->db->get("vw_karyawan")->num_rows();
    }
	
	function jumlahakumulasicari($cari){
		 
		  $this->db->like("dept",$cari);
          $this->db->or_like("nama",$cari);
		  //return $this->db->get('vw_karyawan')->num_rows();
		  return $this->db->count_all("vw_karyawan");
	}
	

	
function user_limit($limit, $start = 0,$dt_tanggal,$dt_tanggal1) {
        $this->db->select('vw.nik,vw.dept, vw.nama,sum(th.int_jam) akumulasi');
        $this->db->from('vw_karyawan vw');
        $this->db->join('tr_hutang th', ' th.int_nik = vw.nik','left');
		if (!empty($dt_tanggal)) {
			$this->db->where('th.dt_tanggal >=', $dt_tanggal);
		$this->db->where('th.dt_tanggal <=', $dt_tanggal1);
		}
	    $this->db->group_by("vw.nik");
        $this->db->limit($limit, $start);
        return $this->db->get();
    }

	function cariakumulasi($cari,$dt_tanggal,$dt_tanggal1){
		
	   $this->db->select('vw.nik,vw.dept, vw.nama,sum(th.int_jam) akumulasi');
	    $this->db->from('vw_karyawan vw');
       $this->db->where("(nama LIKE '%$cari%'");
	   $this->db->or_where("dept LIKE '%$cari%')");
	    $this->db->join('tr_hutang th', ' th.int_nik = vw.nik','left');
		$this->db->where('th.dt_tanggal >=', $dt_tanggal);
		$this->db->where('th.dt_tanggal <=', $dt_tanggal1);
	    $this->db->group_by("vw.nik");
    
        return $this->db->get();
    }	

	
	
    
    function detailpeminjaman($tanggal1,$tanggal2){
        return $this->db->query("select * from transaksi where tanggal_pinjam between '$tanggal1' and '$tanggal2' group by id_transaksi");
    }
    
    function detail_pinjam($id){
        $this->db->select("*");
        $this->db->from("transaksi");
        $this->db->where("id_transaksi",$id);
        $this->db->join("buku","buku.kode_buku=transaksi.kode_buku");
        return $this->db->get();
    }
    
    function detailpengembalian($tanggal1,$tanggal2){
        return $this->db->query("select * from pengembalian where tgl_pengembalian between '$tanggal1' and '$tanggal2' group by id_transaksi");
    }
}
