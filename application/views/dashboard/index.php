<style>
    .glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
          
      .glyphicons li {
        float: left;
        width: 11.5%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      
      .glyphicons .glyphicon {
              margin-top: 5px;
              margin-bottom: 10px;
              font-size: 24px;
          display: block;
              text-align: center;
      }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        Dashboard
    </div>
    <div class="panel-bodys">
        <div class="containers">
            <ul class="glyphicons">
                <li hidden>
                  <span class="glyphicon glyphicon-user"></span>
                  <a href="<?php echo site_url('anggota');?>">Anggota</a>
                </li>
                
                <li hidden>
                  <span class="glyphicon glyphicon-book"></span>
                  <a href="<?php echo site_url('buku');?>">Buku</a>
                </li>
                
                <li>
                  <span class="glyphicon glyphicon-saved"></span>
                  <a href="<?php echo site_url('hutang');?>">Jam Kerja</a>
                </li>
                
                <li hidden>
                  <span class="glyphicon glyphicon-saved"></span>
                  <a href="<?php echo site_url('tabungan');?>">Tabungan</a>
                </li>
                
                <li>
                  <span class="glyphicon glyphicon-print"></span>
                  <a href="<?php echo site_url('laporan/peminjaman');?>">Laporan</a>
                </li>
                
                <li>
                  <span class="glyphicon glyphicon-off"></span>
                  <a href="<?php echo site_url('dashboard/logout');?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>