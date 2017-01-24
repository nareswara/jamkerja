<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-lg-2 control-label">NIK</label>
        <div class="col-lg-5">
            <input type="text" name="nik" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama</label>
        <div class="col-lg-5">
            <input type="text" name="nama" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Bagian</label>
        <div class="col-lg-5">
             <input type="text" name="bagian" class="form-control"> 
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jam</label>
        <div class="col-lg-5">
            <input type="text" name="jam" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Tanggal</label>
        <div class="col-lg-5">
            <input type="text" name="tanggal" id="tanggal" class="form-control">
        </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('hutang');?>" class="btn btn-default">Kembali</a>
    </div>
</form>