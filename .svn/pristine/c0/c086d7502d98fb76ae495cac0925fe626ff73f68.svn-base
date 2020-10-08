
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Jenis Dokumen</h1>
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
                        <div class="col-md-2 mb-3">
                            <a href="<?php echo base_url() ?>c_master_jenis_dokumen/form_jenis_dokumen"><button type="button" class="btn btn-block btn-info btn-xs">Tambah Jenis Dokumen</button></a>
                        </div>
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Jenis Dokumen</th>
                          <th>Reminder</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                              $no=0;
                              foreach ($jenis_dokumen as $jendok) :
                              $no++;
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $jendok['nama_jenis_dokumen'] ?></td>
                                <td>
                                  <?php echo $jendok['durasi_tahun'] ?> Tahun :
                                  <?php echo $jendok['durasi_bulan'] ?> Bulan : 
                                  <?php echo $jendok['durasi_tgl'] ?> Hari
                                </td>
                              <td>
                              <?php echo anchor('c_master_jenis_dokumen/edit_jenis_dokumen/'.$jendok['id'], '<button type="button" class="btn  btn-primary btn-sm"><i class="far fa-edit"></i></button>') ?>
                                <?php echo anchor('c_master_jenis_dokumen/delete/'.$jendok['id'], '<button type="button" class="btn  btn-danger btn-sm "><i class="fas fa-trash"></i></button>') ?>
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