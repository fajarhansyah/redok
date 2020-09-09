
  <!-- Content Wrapper. Contains page content -->
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
                        
                          <a href="<?php echo base_url() ?>c_data_dokumen/form_data_dokumen" class="col-md-3"><button type="button" class="btn btn-block btn-info btn-xs col-md-7">Tambah Dokumen</button></a>
                          <div style="position: absolute;right: 0;"><a href="<?php echo base_url() ?>c_data_dokumen/permintaan_download"><button type="button" class="btn btn-block btn-info btn-xs">Permintaan Download <span class="badge bg-success">10</span></button></a></div>
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
                            <th>Action</th>
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
                                <td><?php echo $dd['username'] ?></td>
                                <td><?php echo $dd['pic'] ?></td>
                                <td><?php echo $dd['masa_aktif'] ?></td>
                                <td>
                                <?php foreach ($user as $usr) : ?>
                                  <?php  $str = $dd['akses_for'];
                                          if ($usr->id == $str) {
                                            echo $usr->username;
                                          }
                                      ?> 
                                      <?php endforeach; ?>
                                </td>
                                <td>
                                  <?php echo anchor('c_data_dokumen/edit_data_dokumen/'.$dd['iddkm'], '<button type="button" class="btn btn-block btn-primary">Edit</button>') ?>
                                  <?php echo anchor('c_data_dokumen/delete/'.$dd['iddkm'], '<button type="button" class="btn btn-block btn-danger mt-2">Hapus</button>') ?>
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Status Perpanjang </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Nama Dokumen : <span style="color: red;">7 Hari Lagi</span> 
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Diperpanjang</button>
                <button onclick="window.location.href='edit-data_dokumen.html';" type="button" class="btn btn-primary">Memperbarui masa Aktif</button>
                </div>
            </div>
        </div>
    </div>