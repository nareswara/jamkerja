<legend><?php echo $title;?></legend>

	
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('laporan/cariakumulasi');?>" method="post">
	<div class="form-group">
      <table class="table table-striped"> 
           <tr>
		       <td>Tanggal Dari</td>
			   <td><input type="text" name="dt_tanggal" id="tanggal"  class="form-control"></td>
			   <td>Tanggal Sampai</td>
			   <td> <input type="text" name="dt_tanggal1" id="tanggal1"  class="form-control"></td>
			    <td>Cari</td>   <!-- <input type="text" name="dt_tanggal" id="tanggal" class="form-control"> -->
			   <td>  <input type="text" class="form-control" id="nikac"  name="cari"></td>
		   </tr>
		   </table>
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Nik</td>
            <td>Nama</td>
            <td>Bagian</td>
            <td>Hari</td>
			<td>Jam</td>
        </tr>
    </thead>
   <?php $no=0; foreach($anggota as $row): $no++;?>
    <tr>
	    <?php
		  if ($row->akumulasi < 0) { //-10 12
			  $rowakumulasi = $row->akumulasi * -1;
		  }
		  else {
			  $rowakumulasi = $row->akumulasi; //12
		  }
		  if ($rowakumulasi > 6) {  // 5.56 12
            $bilhari = floor($rowakumulasi/7); //5  1 .714
			//$bilhari1 = floor($bilhari);
            $bil = ($rowakumulasi/7)-$bilhari;	
            $biljam = $bil * 7;		  
		  }
		  else {
			 $bilhari = 0;
      		 $biljam = $rowakumulasi; 	 
		  }
		?>
        <td><?php echo $no;?></td>
        <td><?php echo $row->nik;?></td>
        <td><?php echo $row->nama;?></td>
        <td><?php echo $row->dept;?></td>
        <td><?php echo $bilhari;?></td>
		<td><?php echo $biljam;?></td>
    </tr>
	 <?php endforeach;?>
</table>

