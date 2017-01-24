<!DOCTYPE html>
<html>
<body>


<label>Bagian</label>
         
          <select name="bagian" id="bagian" class="form-control">
           <option></option>
           <?php foreach($dept as $rowprov){?>
           <option value="<?=$rowprov->id?>"><?=$rowprov->dept?></option>
           <?php }?>
          </select>
		 
         
		
	       <button id="tombol">Generate Data</button> 

	<!-- center -->
	<div data-options="region:'center'" title="Main Content"  style="overflow:hidden;padding:1px">
		<?php $this->load->view('jamkerja/grids'); ?>
	</div>
	
	 
</body>
</html>