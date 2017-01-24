<script type="text/javascript">
var url;

function create(){
	jQuery('#dialog-form').dialog('open').dialog('setTitle','Tambah Mobil');
	jQuery('#form').form('clear');
	url = '<?php echo site_url('jamkerja/create'); ?>';
}

function update(){
	var row = jQuery('#datagrid-crud').datagrid('getSelected');
	if(row){
		jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Mobil');
		jQuery('#form').form('load',row);
		url = '<?php echo site_url('crud/update'); ?>/' + row.id;
	}
}

function save(){
	jQuery('#form').form('submit',{
		url: url,
		onSubmit: function(){
			return jQuery(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if(result.success){
				jQuery('#dialog-form').dialog('close');
				jQuery('#datagrid-crud').datagrid('reload');
			} else {
				jQuery.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}
		}
	});
}

function remove(){
	var row = jQuery('#datagrid-crud').datagrid('getSelected');
	if (row){
		jQuery.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
			if (r){
				jQuery.post('<?php echo site_url('crud/delete'); ?>',{id:row.id},function(result){
					if (result.success){
						jQuery('#datagrid-crud').datagrid('reload');
					} else {
						jQuery.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				},'json');
			}
		});
	}
}
</script>

<!-- Data Grid -->
<table  id="datagrid-crud" title="Jam Kerja" class="easyui-datagrid table table-striped" style="width:700px;height:250px" url="<?php echo site_url('jamkerja/index'); ?>?grid=true" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
	<thead>
		<tr>
			<th field="id" width="30" sortable="true">ID</th>
			<th field="int_nik" width="100" sortable="true">NIK</th>
			<th field="dt_tanggal" width="100" sortable="true">Tanggal</th>
			<th field="int_jam" width="100" sortable="true">Jam</th>
		</tr>
	</thead>
</table>

<!-- Toolbar -->
<div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Tambah Data</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit Data</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="remove()">Hapus Data</a>
</div>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:400px; height:200px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form" method="post" novalidate>
		<div hidden class="form-item">
			<label for="type">Nama</label><br />
			<input type="text" name="nama" class="easyui-validatebox" required="true" size="53" maxlength="50" />
		</div>
		<div hidden class="form-item">
			<label for="type">NIK</label><br />
			<input type="text" name="nik" class="easyui-validatebox" required="true" size="53" maxlength="50" />
		</div>
		<div class="form-item">
			<label for="type">Dept</label><br />
			<input class="easyui-numberbox" name="dept" data-options="precision:2,groupSeparator:'.',decimalSeparator:',',prefix:'Rp. '" class="easyui-validatebox" required="true" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>