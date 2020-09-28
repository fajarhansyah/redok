<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Dokumen</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="form-group col-md-12 ">
                          <label>Filter Berdasarkan:</label>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control float-right" value="" id="reservation">
                            </div>
                          </div>
                          <!-- /.input group -->
                        </div><br>
                        <div class="col-md-12">
                          <div class="form-group col-md-4">
                            <select class="select2 " multiple="multiple" data-placeholder="Jenis Dokumen" style="width: 100%;" id="jenis_dokumen">
                            <?php foreach ($master_jenis_dokumen as $jd) : ?>
                                <option value="<?php echo $jd['id'];?>">
                                        <?php echo $jd['nama_jenis_dokumen']?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group col-md-4">
                            <select class="select2 " multiple="multiple" data-placeholder="Bagian Pemilik" style="width: 100%;" id="bag_pemilik">
                                <?php foreach ($user as $usr) : ?>
                                    <option value="<?php echo $usr->id;?>">
                                      <?php echo $usr->username?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                          <div style="position:absolute; right: 0;">
                            <div class="col-sm-12 mt-3">
                                <!-- radio -->
                                <label>Tampilkan Berdasarkan :</label>
                                <div class="form-group">
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input cekdokumen" type="radio" id="customRadio1" name="customRadio" value="" checked>
                                    <label for="customRadio1" class="custom-control-label">Semua Dokumen</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input cekdokumen" type="radio" id="customRadio2" name="customRadio" value="<?php echo $this->session->userdata('id')?>">
                                    <label for="customRadio2" class="custom-control-label">Dokumen Sendiri</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input cekdokumen" type="radio" id="customRadio3" name="customRadio" value="<?php echo $this->session->userdata('id')?>">
                                    <label for="customRadio3" class="custom-control-label">Dokumen yang di beri akses</label>
                                  </div>
                                </div>
                            </div>
                          </div>
                    </div>
                  </div>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Dokumen</th>
                        <th>Jenis Dokumen</th>
                        <th>Bagian/Kebun</th>
                        <th>PIC</th>
                        <th>Masa Aktif</th>
                        <th>Akses</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no=0;
                            foreach ($data_dokumen as $dd) :
                            $no++;
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $dd['nama_dokumen'] ?></td>
                                <td><?php echo $dd['nama_jenis_dokumen'] ?></td>
                                <td>
                                  <?php foreach ($user as $usr) : ?>
                                  <?php  $str = $dd['bag_or_keb'];
                                              if ($usr->id == $str) {
                                                echo $usr->username.'<br>';
                                              }
                                          
                                      ?> 
                                      <?php endforeach; ?></td>
                                <td><?php echo $dd['pic'] ?></td>
                                <td>
                                  <?php 
                                      $str =  $dd['masa_aktif'];
                                      $tanggal = explode("-",$str);
                                      echo date('d/m/Y', strtotime($tanggal[0]));
                                      echo ' - ';
                                      echo date('d/m/Y', strtotime($tanggal[1]));
                                  ?>
                                </td>
                                
                                <td>
                                <?php foreach ($user as $usr) : ?>
                                  <?php  $str = $dd['akses_for'];
                                            $str1 = explode(",",$str);
                                            $jumlahdata = count($str1);
                                            for ($i=0; $i < $jumlahdata; $i++) { 
                                              if ($usr->id == $str1[$i]) {
                                                echo '-'.$usr->username.'<br>';
                                              }
                                            }
                                          
                                      ?> 
                                      <?php endforeach; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                    
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
      <!-- ./col -->
      
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
      $(document).ready(function(){
        $("#jenis_dokumen").change(function(){
          jenis_dkm();
        })
      })
      $(document).ready(function(){
        $("#bag_pemilik").change(function(){
          bag_keb();
        })
      })
      $(document).click(function(){
        $("#reservation").change(function(){
          reservation1();
        })
      })
      $(document).click(function(){
        $("#customRadio2").change(function(){
            var customRadio2 = $("#customRadio2").val();
            $.ajax({
              url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
              data: "customRadio2=" +customRadio2 ,
              success:function(data){
                $('#example2 tbody').html(data);
              }
            })
        })
      })
      $(document).click(function(){
        $("#customRadio1").change(function(){
            var customRadio1 = $("#customRadio1").val();
            $.ajax({
              url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
              data: "customRadio1=" +customRadio1 ,
              success:function(data){
                $('#example2 tbody').html(data);
              }
            })
        })
      })
      $(document).click(function(){
        $("#customRadio3").change(function(){
            var customRadio3 = $("#customRadio3").val();
            $.ajax({
              url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
              data: "customRadio3=" +customRadio3 ,
              success:function(data){
                $('#example2 tbody').html(data);
              }
            })
        })
      })


      function jenis_dkm(){
        var jenis_dokumen = $("#jenis_dokumen").val();
        $.ajax({
          url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
          data: "jenis_dokumen=" +jenis_dokumen ,
          success:function(data){
            $('#example2 tbody').html(data);
          }
        })
      } 
      function bag_keb(){
        var bag_pemilik = $("#bag_pemilik").val();
        $.ajax({
          url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
          data: "bag_pemilik=" +bag_pemilik ,
          success:function(data){
            $('#example2 tbody').html(data);
          }
        })
      } 
      function reservation1(){
        var reservation = $("#reservation").val();
        $.ajax({
          url : "<?php echo base_url('c_laporan/load_jenis_data_dokumen') ?>",
          data: "reservation=" +reservation ,
          success:function(data){
            $('#example2 tbody').html(data);
          }
        })
      } 
      
    </script>