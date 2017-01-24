 <table id="dg" title="My Users" style="auto"
            toolbar="#toolbar" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id" width="50" editor="{type:'validatebox',options:{required:true}}">ID</th>
				<th field="nama" width="50" editor="{type:'validatebox',options:{required:true}}">Nama</th>
                <th field="int_nik" width="50" editor="{type:'validatebox',options:{required:true}}">NIK</th>
                <th field="int_jam" width="50" editor="{type:'validatebox',options:{required:true}}">Jam</th>
                <th field="dt_tanggal"  width="50" editor="{type:'datebox',options:{formatter:myformatter,parser:myparser}}">Tanggal</th>
				
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		 <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="searchUser()">Search</a>
    </div>

	