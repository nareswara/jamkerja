  
	
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('hutang/cari');?>" method="post">
        <div class="form-group">
            <label>Cari NIK / Nama</label>
            <input type="text" class="form-control" id="nikac" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('hutang/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
			<td hidden>IDs</td>
            <td>NIK</td>
            <td>Nama</td>
            <td>Bagian</td>
            <td>Tanggal</td>
            <td>Jam</td>
            <td colspan="2"></td>
        </tr>
    </thead>
	<?php 
 
     $no=0; foreach($hutang as $row ): $no++;?>
	
    <tr>
        <td><?php echo $no;?></td>
		<td hidden><?php echo $row->id;?></td>
        <td><?php echo $row->int_nik;?></td>
        <td><?php echo $row->nama;?></td>
        <td><?php echo $row->dept;?></td>
		<td><?php echo $row->dt_tanggal;?></td>
        <td><?php echo $row->int_jam;?></td>
        
        <td><a href="<?php echo site_url('hutang/edit/'.$row->id);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
    <?php endforeach;?>
</Table>
<?php echo $pagination;?>

<script>
    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });
        
        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            
            $.ajax({
                url:"<?php echo site_url('hutang/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('hutang/index/delete_success');?>";
                }
            });
        });
    });
</script>