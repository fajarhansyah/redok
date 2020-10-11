<?php
error_reporting(0);
class C_laporan extends CI_Controller{
    public function __construct(){
      parent::__construct();
      if($this->session->userdata('role_id') == ''){
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda Belum Login
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('auth/login');
      }
    }
    public function laporan_dokumen()
    {
        $id = $this->session->userdata('id');
      $nama = $this->session->userdata('username');
      $query_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      WHERE tb_user.username = '$nama' OR tb_dokumen.akses_for LIKE '%$id%' ");
      $query_permintaan_download = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
      LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''");
      $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $master_jenis_dokumen = $this->db->query("SELECT * FROM `tb_master_jenis_dok`");
      $data['master_jenis_dokumen'] = $master_jenis_dokumen->result_array();
      $data['notifikasi_reminder'] = $query_notifikasi->result_array();
      $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
      $data['data_dokumen'] = $query_dokumen->result_array();
      $data['jumlahnotifikasi'] = $query_permintaan_download->result_array();
      $data['user'] = $this->model_dokumen->tampil_data_user()->result();
      $query_notif = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id");
      $data1['query_notif'] = $query_notif->result_array();
          foreach($data1['query_notif'] as $row){
            $str = $row['masa_aktif'];
            $id_dkm = $row['iddkm'];
            $tanggal = explode("-",$str);
            $format_tgl = date('d-m-Y', strtotime($tanggal[1]));
            $hari = $row['durasi_tgl'];
            $bulan = $row['durasi_bulan'];
            $tahun = $row['durasi_tahun'];
            $tgl1    = $format_tgl; 
            $tgl2    = date('d-m-Y', strtotime('-'.$hari.'days', strtotime($tgl1)));
            $tgl3    = date('d-m-Y', strtotime('-'.$bulan.'month', strtotime($tgl2)));
            $tgl4    = date('d-m-Y', strtotime('-'.$tahun.'year', strtotime($tgl3)));
            $akhir1 = date("d-m-Y");
              if($tgl4 == $akhir1){
                $pengingat  = '1';
                $data3 = array(
                  'pengingat' => $pengingat
                );
                $where = array('id' => $id_dkm);
                $this->model_dokumen->update_dokumen($where,$data3,'tb_dokumen');  
              }
          }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_dokumen',$data);
        $this->load->view('templates/footer-cetak');
      
    }
    public function load_jenis_data_dokumen(){
      
          
    $jenis_dokumen = $_GET['jenis_dokumen'];
    $bag_pemilik = $_GET['bag_pemilik'];
    $reservation = $_GET['reservation'];
    $id = $this->session->userdata('id');
    $nama = $this->session->userdata('username');
    $query_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
    WHERE tb_user.username = '$nama' OR tb_dokumen.akses_for LIKE '%$id%' ");
    $query_permintaan_download = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
    LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
    LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
    LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
    WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''");
    $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
    $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
    $master_jenis_dokumen = $this->db->query("SELECT * FROM `tb_master_jenis_dok`");
    $data['master_jenis_dokumen'] = $master_jenis_dokumen->result_array();
    $data['notifikasi_reminder'] = $query_notifikasi->result_array();
    $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
    $data1['data_dokumen'] = $query_dokumen->result_array();
    $data['jumlahnotifikasi'] = $query_permintaan_download->result_array();
    $data2['user'] = $this->model_dokumen->tampil_data_user()->result();
          
    $tanggal = explode(" - ",$reservation);
    $format_tgl_awal = $tanggal[0];
    $format_tgl_akhir = $tanggal[1];
         
    $customRadio1 = $_GET['customRadio1'];
    $customRadio2 = $_GET['customRadio2'];
    $customRadio3 = $_GET['customRadio3'];

    $check_where = false;
    $where = '';
    if(!empty($customRadio1) || !empty($customRadio2) || !empty($customRadio3)){
      if (!empty($customRadio2)) {
        $check_where = true;
        $where = "WHERE tb_dokumen.bag_or_keb = '$customRadio2'";
      }
      if (!empty($customRadio3)) {
        $check_where = true;
        $where = "WHERE tb_dokumen.akses_for LIKE '%$customRadio3%'";
      }
    }
    if( !empty($jenis_dokumen) ){
      $jenis_dokumens = explode(",",$jenis_dokumen);
      $jumlahdata = count($jenis_dokumens);
      $check_js = false;
      foreach ($jenis_dokumens as $jdkm){
        if ($check_where) {
          if ($check_js) {
            $where = $where."OR tb_dokumen.jenis_dok = '$jdkm' ";
          }else{
            $where = $where."AND (tb_dokumen.jenis_dok = '$jdkm' ";
            $check_js = true;
          }
        }else{
          $check_where = true;
          $check_js = true;
          $where = "WHERE (tb_dokumen.jenis_dok = '$jdkm' ";
        }
      }
      $where = $where.')';
    }
    if( !empty($bag_pemilik) ){
      $bag_pemiliks = explode(",",$bag_pemilik);
      $check_bp = false;
      foreach ($bag_pemiliks as $jdkm){
        if ($check_where) {
          if ($check_bp) {
            $where = $where."OR tb_dokumen.bag_or_keb = '$jdkm' ";
          }else{
            $check_bp = true;
            $where = $where."AND (tb_dokumen.bag_or_keb = '$jdkm' ";
          }
        }else{
          $check_where = true;
          $check_bp = true;
          $where = "WHERE (tb_dokumen.bag_or_keb = '$jdkm' ";
        }
      };
      $where = $where.')';
    }
    if( !empty($reservation) ){
      $now = date("d/m/Y");
      $check_rs = false;
      if ($now == $format_tgl_awal && $now == $format_tgl_akhir) {
        # code...
      }else{
        $replc1 =str_replace("/","-",$format_tgl_awal);
        $replc2 =str_replace("/","-",$format_tgl_akhir);
        $crv_tgl_awal = date('Y-m-d', strtotime($replc1));
        $crv_tgl_akhir = date('Y-m-d', strtotime($replc2));
        if ($check_where) {
          if($check_rs){
            $where = $where."OR ((tb_dokumen.masa_aktif_awal BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir') OR (tb_dokumen.masa_aktif_akhir BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir') ";
          }else{
            $check_rs = true;
            $where = $where."AND ((tb_dokumen.masa_aktif_awal BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir') OR (tb_dokumen.masa_aktif_akhir BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir') ";
          }
          
        }else{
          $check_where = true;
          $check_rs = true;
          $where = "WHERE (tb_dokumen.masa_aktif_awal BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir') OR (tb_dokumen.masa_aktif_akhir BETWEEN '$crv_tgl_awal' AND '$crv_tgl_akhir' ";
        }
        $where = $where.')';
      }
    }
    
    $query_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      $where");
      
    $data1['data_dokumen'] = $query_dokumen->result_array();
    $no=1;
    foreach ($data1['data_dokumen'] as $dd) :
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $dd['nama_dokumen'] ?></td>
        <td><?php echo $dd['nama_jenis_dokumen'] ?></td>
        <td>
          <?php foreach ($data2['user'] as $usr) : ?>
          <?php  $str = $dd['bag_or_keb'];
                      if ($usr->id == $str) {
                        echo $usr->username.'<br>';
                      }
                  
              ?> 
              <?php endforeach; ?></td>
        <td><?php echo $dd['pic'] ?></td>
        <td>
          <?php 
              echo  date('d/m/Y', strtotime($dd['masa_aktif_awal']));
              echo ' - ';
              echo date('d/m/Y', strtotime($dd['masa_aktif_akhir']));
          ?>
        </td>
        
        <td>
        <?php foreach ($data2['user'] as $usr) : ?>
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
    <?php endforeach; ?><?php
  
    }
    public function laporan_download()
    {
        $id = $this->session->userdata('id');
        $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
        LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
        $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
        LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
        $query_download_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori FROM tb_dokumen 
        LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
        LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
        LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''");
        $data['data_download_dokumen'] = $query_download_dokumen->result_array(); 
        $data['notifikasi_reminder'] = $query_notifikasi->result_array();
        $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
        $data['user'] = $this->model_dokumen->tampil_data_user()->result();
        // print "<pre>";
        // print_r($data['data_download_dokumen']);
        // print "</pre>";
        // die();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_download',$data);
        $this->load->view('templates/footer-cetak');
      
    }
    
    public function load_download_dokumen()
    {
      $status = $_GET['status'];
      $reservation = $_GET['reservation'];
      $peminta = $_GET['peminta'];
      $id = $this->session->userdata('id');
      $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $query_download_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori FROM tb_dokumen 
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
      LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''");
      $data['data_download_dokumen'] = $query_download_dokumen->result_array(); 
      $data['notifikasi_reminder'] = $query_notifikasi->result_array();
      $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
      $data['user'] = $this->model_dokumen->tampil_data_user()->result();
      // print "<pre>";
      // print_r($data['data_download_dokumen']);
      // print "</pre>";
      // die();
      $tanggal = explode("-",$reservation);
      $format_tgl_awal = date("d/m/Y", strtotime($tanggal[0]));  
      $format_tgl_akhir = date('d/m/Y', strtotime($tanggal[1]));
      $check_where = false;
      $where = "WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''";
      if( !empty($status) ){
        
        $id = $this->session->userdata('id');
        $statuss = explode(",",$status);
        $check_s = false;
        foreach ($statuss as $jdkm){
          if ($check_where) {
            if ($check_s) {
              $where = $where." OR tb_dokumen.id_user = '$id' && histori_download_dokumen.status = '$jdkm' && histori_download_dokumen.status != ''";
            }else{
              $check_s = true;
              $where = $where." AND (tb_dokumen.id_user = '$id' && histori_download_dokumen.status = '$jdkm' && histori_download_dokumen.status != ''";
            }
          }else{
            $check_where = true;
            $check_s = true;
            $where = "WHERE (tb_dokumen.id_user = '$id' && histori_download_dokumen.status = '$jdkm' && histori_download_dokumen.status != ''";
          }
        };
        $where = $where.')'; 
        }
      if( !empty($peminta) ){
        $id = $this->session->userdata('id');
        $pemintas = explode(",",$peminta);
        
        $check_p = false;
        foreach ($pemintas as $jdkm){
          if ($check_where) {
            if ($check_p) {
              
              $where = $where." OR tb_dokumen.id_user = '$id' && histori_download_dokumen.peminta = '$jdkm' && histori_download_dokumen.status != ''";
            }else{
              
              $check_p = true;
              $where = $where."AND (tb_dokumen.id_user = '$id' && histori_download_dokumen.peminta = '$jdkm' && histori_download_dokumen.status != ''";
            }
          }else{
            $check_where = true;
            $check_p = true;
            $where = "WHERE (tb_dokumen.id_user = '$id' && histori_download_dokumen.peminta = '$jdkm' && histori_download_dokumen.status != ''";
          }
        };
        $where = $where.')'; 
      }
      if( !empty($reservation) ){
        $now = date("m/d/Y");
        $check_rs = false;
        if ($now == $format_tgl_awal && $now == $format_tgl_akhir) {
          # code...
        }else{
          if ($check_where) {
            if($check_rs){
              $where = $where."OR (tb_dokumen.id_user = '$id' && histori_download_dokumen.tanggal_download BETWEEN '$format_tgl_awal' AND '$format_tgl_akhir' && histori_download_dokumen.status != ''";
            }else{
              $check_rs = true;
              $where = $where."AND (tb_dokumen.id_user = '$id' && histori_download_dokumen.tanggal_download BETWEEN '$format_tgl_awal' AND '$format_tgl_akhir' && histori_download_dokumen.status != ''";
            }
            
          }else{
            $check_where = true;
            $check_rs = true;
            $where = "WHERE (tb_dokumen.id_user = '$id' && histori_download_dokumen.tanggal_download BETWEEN '$format_tgl_awal' AND '$format_tgl_akhir' && histori_download_dokumen.status != ''";
          }
          $where = $where.')';
        }
      }
      $query_download_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori FROM tb_dokumen 
        LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
        LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
        LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
        $where ");
        // echo json_encode($where)  ;
        // die();
        $data['data_download_dokumen'] = $query_download_dokumen->result_array(); 
        
          $no=1;
          foreach ($data['data_download_dokumen'] as $ddd) :
          
      ?>
      <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $ddd['log'] ?></td>
          <td><?php echo $ddd['peminta'] ?></td>
          <td><?php echo $ddd['status'] ?></td>
          <td><?php echo $ddd['keterangan'] ?></td> 
          <td><?php 
          if( $ddd['tanggal_download'] != ''){
              echo date('d/m/Y', strtotime($ddd['tanggal_download']));
            }?>
          </td> 
          <td><input  style="height:35px" type="text" value="<?php echo $ddd['kode_unik'] ?>" id="myInput<?php echo $no ?>" readonly></td>
          
      </tr>
      <?php endforeach; ?><?php
    }
    public function laporan_dokumen_hukum()
    {
        $id = $this->session->userdata('id');
        $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
        LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
        $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
        LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
        $query_download_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori FROM tb_dokumen 
        LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
        LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
        LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
        WHERE tb_dokumen.id_user = '$id' && histori_download_dokumen.status != ''");
        $data['data_download_dokumen'] = $query_download_dokumen->result_array(); 
        $data['notifikasi_reminder'] = $query_notifikasi->result_array();
        $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
        $data['user'] = $this->model_dokumen->tampil_data_user()->result();
        // print "<pre>";
        // print_r($data['data_download_dokumen']);
        // print "</pre>";
        // die();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('laporan_download',$data);
        $this->load->view('templates/footer-cetak');
      
    }
}
 ?>
