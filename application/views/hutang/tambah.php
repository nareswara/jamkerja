     
    
	
	
<?php echo $title;?></legend> 
<?php echo validation_errors();?>
<?php echo $message;?>


<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
 <div class="form-group">
        <label class="col-lg-2 control-label">Nama</label>
        <div class="col-lg-5">
            <input type="text" name="nama"  class="autocompletes form-control" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">NIK</label>
        <div class="col-lg-5">
            <input type="search" name="int_nik" class="form-control"  id="v_nik" readonly="readonly" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Bagian</label>
        <div class="col-lg-5">
             <input type="text" name="bagian" class="form-control" id="v_dept" readonly="readonly"> 
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jam</label>
        <div class="col-lg-5">
            <input type="text" name="int_jam" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Tanggal</label>
        <div class="col-lg-5">
            <input type="text" name="dt_tanggal" id="tanggal" class="form-control" value="<?php echo $tgl;?>">
        </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('hutang');?>" class="btn btn-default">Kembali</a>
    </div>
</form>

  
