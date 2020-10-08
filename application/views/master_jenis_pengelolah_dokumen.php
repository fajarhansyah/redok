
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
                            <a href="<?php echo base_url() ?>c_jenis_pengelolah_dokumen/form_jenis_dokumen"><button type="button" class="btn btn-block btn-info btn-xs">Tambah Jenis Dokumen</button></a>
                        </div>
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Jenis Dokumen</th>
                          <th>Status</th>
                          <th>Keterangan</th>
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
                                <td><?php echo $jendok['status_jenis_dokumen'] ?></td>
                                <td><?php echo $jendok['keterangan'] ?></td>
                              <td>
                              <?php echo anchor('c_jenis_pengelolah_dokumen/edit_jenis_dokumen/'.$jendok['id_jenis_dokumen'], '<button type="button" class="btn  btn-primary btn-sm"><i class="far fa-edit" title="Edit"></i></button>') ?>
                                <?php echo anchor('c_jenis_pengelolah_dokumen/delete/'.$jendok['id_jenis_dokumen'], '<button type="button" class="btn  btn-danger btn-sm "><i class="fas fa-trash" title="Hapus"></i></button>') ?>
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