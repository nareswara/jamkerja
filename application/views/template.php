<!doctype html>
    <html>
        <head>
            <title>Aplikasi HRD | <?php echo $title;?></title>
            <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
        
            <link href="<?php echo base_url('assets/css/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/css/plugins/timeline/timeline.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/css/datepicker.css');?>" rel="stylesheet">
        
            
           
            <script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
            <script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js');?>"></script>
            
			<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/default/easyui.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/icon.css'); ?>">
 <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.8.2.min.js'></script>
	<script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	<!-- <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.edatagrid.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.edatagrid.js');?>"></script>
	 
	 <!--
	    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/	css" media="all" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>  -->
  </head>
	
	 <!-- Memanggil file .js untuk proses autocomplete -->
   
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

    <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
    <link href='<?php echo base_url();?>assets/js/jquery.autocomplete.css' rel='stylesheet' />

    <!-- Memanggil file .css autocomplete_ci/assets/css/default.css -->
    <link href='<?php echo base_url();?>assets/css/default.css' rel='stylesheet' />
	
	
	   
	<script>

 $(document).ready(function() {
 var nilai = $("#bagian").val();
     $("#tombol").click(function() {
       var nilai = $("#bagian").val();
       $.ajax({
            url: '<?php echo site_url('jamkerja/generatenik'); ?>',     //memanggil function controller dari url
            async: false,
            type: "POST",     //jenis method yang dibawa ke function
            data: "deptid="+nilai,   //data yang akan dibawa di url
            dataType: "html",
            success: function() {
                  //hasil ditampilkan pada combobox id=kota
				 //  $('#dg').datagrid('reload');
            }
        })
     })
 })

</script>

 <script type="text/javascript">
        function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
	
	function searchUser()
      {        
	   var nilai = $("#bagian").val();   
		//alert(nilai); 
     $("#dg").datagrid('options').url='<?php echo site_url('jamkerja/getall'); ?>?dept='+nilai;
     $("#dg").datagrid('reload');
//alert('<?php echo site_url('jamkerja/getall'); ?>');


		  //-  var nilai1 = $("#bagian").val();
			//alert(nilai1); url="<?php echo site_url('crud/index'); ?>?grid=true"
		//-	alert('<?php echo site_url('jamkerja/getall'); ?>?deptid='+nilai1);
          //-  $('#dg').edatagrid('load',{url:'<?php echo site_url('jamkerja/getall'); ?>?dept=3'});
			//$('#dg').datagrid('load',{url:'<?php echo site_url('jamkerja/getall'); ?>?deptid='+nilai1'});//+nilai1});
			
      }
    </script>


            <script>
			var site = "<?php echo site_url();?>";
                    tinymce.init({selector:'textarea'});
                    
                    $(function(){
                        $("#tanggal1").datepicker({
                            format:'yyyy-mm-dd'
                        });
                        
                        $("#tanggal2").datepicker({
                            format:'yyyy-mm-dd'
                        });
                        
                        $("#tanggal").datepicker({
                            format:'yyyy-mm-dd'
                        });
						$("#tanggal3").datepicker({
                            format:'yyyy-mm-dd'
                        });
                    })
					

					 
             var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocompletes').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/peminjaman/searchauto',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#v_nik').val(''+suggestion.nik); // membuat id 'v_nim' untuk ditampilkan
                    $('#v_dept').val(''+suggestion.dept); // membuat id 'v_jurusan' untuk ditampilkan
                }
            });
			
			
         // var nilai_iddept=document.getElementById("bagian").innerHTML;

		  $('#dg').edatagrid({
			   
                url: '<?php echo site_url('jamkerja/getall'); ?>', 
                saveUrl: '<?php echo site_url('jamkerja/create'); ?>',
                updateUrl: '<?php echo site_url('jamkerja/update'); ?>',
                destroyUrl: 'destroy_user.php'
            });	
			//url="<?php echo site_url('crud/index'); ?>?grid=true"
			
			
        });
            </script>
        </head>
        <body>
            <?php echo $_header;?>
        
            
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $_sidebar;?>
                    </div>
                
                    <div class="col-md-9">
                        <?php echo $_content;?>
                    </div>
                </div>
            </div>
        
        <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                  </div>
                  <div class="modal-body">
                        <input type="hidden" name="idhapus" id="idhapus">
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        
        <!-- Core Scripts - Include with every page -->
        <script src="<?php echo base_url('assets/js/holder.js');?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js');?>"></script>
        <script src="<?php echo base_url('assets/js/application.js');?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/morris/raphael-2.1.0.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/morris/morris.js');?>"></script>
        <script src="<?php echo base_url('assets/js/sb-admin.js');?>"></script>
        <script src="<?php echo base_url('assets/js/demo/dashboard-demo.js');?>"></script>    
        </body>
    </html>