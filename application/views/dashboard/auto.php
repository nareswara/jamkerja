<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Autocomplete | AZZURA Media</title>




   


</head>
<body>


<div id="content">
<h1>Autocomplete</h1>
<form action="<?php echo site_url('admin/c_admin/add_orders'); ?>" method="post">
    <div class="wrap">
    <table>
        <tr>
            <td><small>Nama :</small><br><input type="search" class='autocompletes nama' id="autocomp" name="nama_customer"/></td>
        </tr>
        <tr>
            <td><small>Jurusan :</small><br><input type="text" class='autocomplete' id="v_jurusan" name="nama_customer"/></td>
        </tr>
        <tr>
            <td><small>NIM :</small><br><input type="text" class='autocomplete' id="v_nim" name="nama_customer"/></td>
        </tr>
    </div>
</form>
</div>


</body>

</html>