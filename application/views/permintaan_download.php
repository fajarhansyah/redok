
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Permintaan Download</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permintaan Download</li>
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
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Input</th>
                                <th>Peminta</th>
                                <th>Status</th>
                                <th>Keperluan</th>
                                <th>Tanggal Download</th>
                                <th>Kode Unik</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=0;
                                    foreach ($data_download_dokumen as $ddd) :
                                    $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($ddd['log']));
                                    ?></td>
                                    <td><?php echo $ddd['username'] ?></td>
                                    <td><?php echo $ddd['status'] ?></td>
                                    <td><?php echo $ddd['keterangan'] ?></td> 
                                    <td><?php 
                                    if( $ddd['tanggal_download'] != ''){
                                      echo date('d-m-Y', strtotime($ddd['tanggal_download']));
                                    }
                                    ?></td> 
                                    <td><input  style="height:35px" type="text" value="<?php echo $ddd['kode_unik'] ?>" id="myInput<?php echo $no ?>" readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#detailmodal"><i class="fas fa-info-circle"></i></button>
                                        <button type="button" class="btn btn-block btn-primary" onclick="myFunction<?php echo $no ?>()">Salin</button>
                                        <button id="<?php echo $ddd['kode_unik']?>" onClick="reply_click1(this.id,<?php echo $ddd['no_telp']?>)" type="button" class="btn btn-block btn-success mt-2" data-toggle="modal" data-target="#kirimsms">Kirim Sms</button>
                                        <button id="<?php echo $ddd['iddkm']?>"  onClick="reply_click(this.id,<?php echo $ddd['idhistori']?>)" type="button" class="btn btn-block btn-danger mt-2" data-toggle="modal" data-target="#exampleModalCenter">Ditolak</button>
                                        <script>
                                          function myFunction<?php echo $no ?>() {
                                            var copyText = document.getElementById("myInput<?php echo $no ?>");
                                            copyText.select();
                                            copyText.setSelectionRange(0, 99999)
                                            document.execCommand("copy");
                                          }
                                        </script>
                                       
                                    </td>
                                </tr>
                                
                                <?php endforeach; ?>
                                <!-- <tr>
                                    <td>5</td>
                                    <td>10-10-2020</td>
                                    <td>Fajar</td>
                                    <td>Request</td>
                                    <td>Perpanjang STNK</td>
                                    <td>05-07-2021</td>
                                    <td><input  style="height:35px" type="text" value="FH3GKJT4" id="myInput" readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#detailmodal">Detail</button>
                                        <button type="button" class="btn btn-block btn-primary" onclick="myFunction()">Salin</button>
                                        <button type="button" class="btn btn-block btn-success mt-2">Kirim SMS</button>
                                        <button type="button" class="btn btn-block btn-danger mt-2">Ditolak</button>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                  <td>6</td>
                                  <td>10-10-2020</td>
                                  <td>Fajar</td>
                                  <td>Ditolak</td>
                                  <td>Perpanjang STNK</td>
                                  <td>-</td>
                                  <td><input  style="height:35px" type="text" value="" id="myInput" readonly></td>
                                  <td>
                                      <button type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#detailmodal">Detail</button>
                                      <button type="button" class="btn btn-block btn-primary disabled" onclick="myFunction()" disabled>Salin</button>
                                      <button type="button" class="btn btn-block btn-success mt-2">Kirim SMS</button>
                                      <button type="button" class="btn btn-block btn-danger mt-2">Ditolak</button>
                                  </td>
                                </tr>  -->
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <form  action="<?php echo base_url(). 'c_data_dokumen/tolak_permintaan_download/' ?>" method="post">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Tolak Permintaan Download </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="myText" name="id" value="clicked_id">
                    <input type="hidden" id="myTex1" name="idhistori" value="clicken_name">
                  Apakah anda yakin akan menolak permintaan download
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" >Tolak</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Identitas Pengunduh </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                IP : <span style="color: red;"><?php echo $ip_address ?></span> <br>
                Hostname : <span style="color: red;">Release.dnetsurabaya.id</span> <br>
                City : <span style="color: red;">Surabaya</span> <br>
                Region : <span style="color: red;">East Java</span> <br>
                Country : <span style="color: red;">ID</span> <br>
                Loc : <span style="color: red;">-7.2474,436.5423</span> <br>
                Timezone : <span style="color: red;">Asia/Jakarta</span><br> 
                Browser : <span style="color: red;"><?php echo $browser ?></span> <br> 
                Operating Sistem : <span style="color: red;"><?php echo $os ?></span> 
                <!-- IP : <span style="color: red;">202.148.25.3</span> <br>
                Hostname : <span style="color: red;">Release.dnetsurabaya.id</span> <br>
                City : <span style="color: red;">Surabaya</span> <br>
                Region : <span style="color: red;">East Java</span> <br>
                Country : <span style="color: red;">ID</span> <br>
                Loc : <span style="color: red;">-7.2474,436.5423</span> <br>
                Timezone : <span style="color: red;">Asia/Jakarta</span><br> 
                Browser : <span style="color: red;">Chrome</span>  -->
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kirimsms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?php echo base_url()?>c_data_dokumen/sendsms" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Penerima:</label>
                  <input type="text" class="form-control" name="notelp"  id="myText2" readonly>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Kode Unik:</label>
                  <input type="text" class="form-control" name="pesan" id="myText3" readonly> 
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Send message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
      <?php if ($this->session->flashdata('something')) {?>
        <script>
          $(document).ready(function(){
            swal("Kode Unik Berhasil terkirim", "", "success");
          });
        </script>
        
      <?php }?>
<script type="text/javascript">
  function reply_click(clicked_id,clicken_name)
  {
      document.getElementById("myText").value = clicked_id;
      document.getElementById("myTex1").value = clicken_name;
  }
  function reply_click1(kode_unik,notelp)
  {
      document.getElementById("myText2").value = notelp;
      document.getElementById("myText3").value = kode_unik;
  }
</script>