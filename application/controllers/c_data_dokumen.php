<?php
error_reporting(0);
class C_data_dokumen extends CI_Controller{
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
  public function index()
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
            // print_r($tgl4);
            // die();
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
      $this->load->view('data_dokumen',$data);
      $this->load->view('templates/footer');
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
      // echo $where;die();
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
        <td>
          <?php 
            $id = $this->session->userdata('id');
            if($dd['id_user'] == $id){
          ?>
          <?php echo anchor('c_data_dokumen/edit_data_dokumen/'.$dd['iddkm'], '<button type="button" class="btn btn-primary btn-sm mt-2"><i class="far fa-edit" title="Edit"></i></button>') ?>
          <button type="button" id="<?php echo $dd['iddkm']?>" onClick="reply_click(this.id)" class="btn  bg-gradient-success btn-sm mt-2" data-toggle="modal" title="Download" data-target="#exampleModal"><i class="fas fa-download"></i></button>
          <?php echo anchor('c_data_dokumen/delete/'.$dd['iddkm'], '<button type="button" class="btn  btn-danger btn-sm mt-2" title="Hapus"><i class="fas fa-trash"></i></button>') ?>
            <?php }else{ ?>
            <button type="button" id="<?php echo $dd['iddkm']?>" onClick="reply_click(this.id)" class="btn  bg-gradient-success btn-sm mt-2" data-toggle="modal" title="Download" data-target="#exampleModal"><i class="fas fa-download"></i></button>
            <?php } ?>
        </td>
    </tr>
    <?php endforeach; ?><?php
  
  }

  
  public function form_data_dokumen()
  { 
    $data['jenis_dokumen'] = $this->model_dokumen->tampil_data_jenis_dokumen()->result();
    $data['user'] = $this->model_dokumen->tampil_data_user()->result();
    $this->load->view('tambah-data_dokumen',$data);
  }
  public function tambah_data_dokumen()
  { 
    $username = $this->session->userdata('username');
    $id = $this->session->userdata('id');
    $role_id = $this->session->userdata('role_id');
    if($role_id == 1){
      $nama_dokumen = $this->input->post('nama_dokumen');
      $bag_or_keb = $this->input->post('bag_or_keb');
      $jenis_dok = $this->input->post('jenis_dok');
      $masa_aktif = $this->input->post('masa_aktif');
      $masa_aktif_pisah =explode(" - ",$masa_aktif);
      $masa_aktif_awal = $masa_aktif_pisah[0];
      $masa_aktif_akhir = $masa_aktif_pisah[1];
       $replc1 =str_replace("/","-",$masa_aktif_awal);
       $replc2 =str_replace("/","-",$masa_aktif_akhir);
      $cnvrt_masa_aktif_awal = date('Y-m-d', strtotime($replc1));
      $cnvrt_masa_aktif_akhir = date('Y-m-d', strtotime($replc2));
      $pic = $this->input->post('pic');
      $akses_for = $_POST['akses_for'];
  
      $querty_tambahdata = $this->db->query("SELECT * FROM `tb_user` WHERE `username` LIKE '%$username%' ;");
      $data['querty_tambahdata'] = $querty_tambahdata->result_array();
      $datausername = $data['querty_tambahdata'][0]['id'];
  
      $upload_dokumen = $_FILES['upload_dokumen']['name'];
      if($upload_dokumen =''){
        
      }else{
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = '*';
  
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_dokumen')) {
          echo "Gambar Gagal Upload !";
        }else {
          $upload_dokumen=$this->upload->data('file_name');
        }
      }
      $data1 = array(
        'id_user' => $id,
        'nama_dokumen' => $nama_dokumen,
        'bag_or_keb' => $bag_or_keb,
        'jenis_dok' => $jenis_dok,
        'masa_aktif_awal' => $cnvrt_masa_aktif_awal,
        'masa_aktif_akhir' => $cnvrt_masa_aktif_akhir,
        'pic' => $pic,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokumen
      );
      $this->model_dokumen->tambah_dokumen($data1, 'tb_dokumen');
      redirect('c_data_dokumen/index');
    }elseif($role_id != 1){
      $nama_dokumen = $this->input->post('nama_dokumen');
      $jenis_dok = $this->input->post('jenis_dok');
      $masa_aktif = $this->input->post('masa_aktif');
      $masa_aktif_pisah =explode(" - ",$masa_aktif);
      $masa_aktif_awal = $masa_aktif_pisah[0];
      $masa_aktif_akhir = $masa_aktif_pisah[1];
       $replc1 =str_replace("/","-",$masa_aktif_awal);
       $replc2 =str_replace("/","-",$masa_aktif_akhir);
      $cnvrt_masa_aktif_awal = date('Y-m-d', strtotime($replc1));
      $cnvrt_masa_aktif_akhir = date('Y-m-d', strtotime($replc2));
      $pic = $this->input->post('pic');
      $akses_for = $_POST['akses_for'];
  
      $querty_tambahdata = $this->db->query("SELECT * FROM `tb_user` WHERE `username` LIKE '%$username%' ;");
      $data['querty_tambahdata'] = $querty_tambahdata->result_array();
      $datausername = $data['querty_tambahdata'][0]['id'];
  
      $upload_dokumen = $_FILES['upload_dokumen']['name'];
      if($upload_dokumen =''){}else{
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
  
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_dokumen')) {
          echo "Gambar Gagal Upload !";
        }else {
          $upload_dokumen=$this->upload->data('file_name');
        }
      }
      $data1 = array(
        'id_user' => $id,
        'nama_dokumen' => $nama_dokumen,
        'bag_or_keb' => $datausername ,
        'jenis_dok' => $jenis_dok,
        'masa_aktif_awal' => $cnvrt_masa_aktif_awal,
        'masa_aktif_akhir' => $cnvrt_masa_aktif_akhir,
        'pic' => $pic,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokumen
      );
      $this->model_dokumen->tambah_dokumen($data1, 'tb_dokumen');
      redirect('c_data_dokumen/index');
    }
    
  }
  public function tambah_histori_data_dokumen()
  {
    $id_dokumen = $this->input->post('id_dokumen');
    $masa_aktif = $this->input->post('pembaruan_tanggal');
    $masa_aktif_pisah =explode(" - ",$masa_aktif);
    $masa_aktif_awal = $masa_aktif_pisah[0];
    $masa_aktif_akhir = $masa_aktif_pisah[1];
      $replc1 =str_replace("/","-",$masa_aktif_awal);
      $replc2 =str_replace("/","-",$masa_aktif_akhir);
    $cnvrt_masa_aktif_awal = date('Y-m-d', strtotime($replc1));
    $cnvrt_masa_aktif_akhir = date('Y-m-d', strtotime($replc2));
    $data1 = array(
      'id_dokumen' => $id_dokumen
    );
    $data2 = array(
      'masa_aktif_awal' => $cnvrt_masa_aktif_awal,
      'masa_aktif_akhir' => $cnvrt_masa_aktif_akhir
    );
    $where = array('id' => $id_dokumen);
    $this->model_dokumen->tambah_dokumen($data1, 'histori_pembarui_dokumen');
    $this->model_dokumen->update_dokumen($where,$data2,'tb_dokumen');

    redirect('c_data_dokumen/edit_data_dokumen/'.$id_dokumen);
  }
  public function edit_data_dokumen($id)
  {
    $where = array('id' =>$id);
    $data['data_dokumen'] = $this->model_dokumen->edit_dokumen($where,'tb_dokumen')->result();
    $data['jenis_dokumen'] = $this->model_dokumen->tampil_data_jenis_dokumen()->result();
    $data['user'] = $this->model_dokumen->tampil_data_user()->result();
    $nama = $this->session->userdata('username');
    $query_dokumen = $this->db->query("SELECT * FROM tb_user 
    LEFT JOIN tb_dokumen ON tb_user.id = tb_dokumen.id_user
    LEFT JOIN histori_pembarui_dokumen ON tb_dokumen.id = histori_pembarui_dokumen.id_dokumen
    LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
    WHERE tb_user.username = '$nama' && histori_pembarui_dokumen.id_dokumen = '$id'");
    $data['histori_data_dokumen'] = $query_dokumen->result_array(); 
    
    $this->load->view('edit-data_dokumen',$data);
  }
  public function update_data_dokumen()
  {
    $id       = $this->input->post('id');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $bag_or_keb = $this->input->post('bag_or_keb');
    $jenis_dok = $this->input->post('jenis_dok');
    $masa_aktif = $this->input->post('masa_aktif');
      $masa_aktif_pisah =explode(" - ",$masa_aktif);
      $masa_aktif_awal = $masa_aktif_pisah[0];
      $masa_aktif_akhir = $masa_aktif_pisah[1];
       $replc1 =str_replace("/","-",$masa_aktif_awal);
       $replc2 =str_replace("/","-",$masa_aktif_akhir);
      $cnvrt_masa_aktif_awal = date('Y-m-d', strtotime($replc1));
      $cnvrt_masa_aktif_akhir = date('Y-m-d', strtotime($replc2));
    $pic = $this->input->post('pic');
    $upload_dokument = $this->input->post('upload_dokument');
    $akses_for = $_POST['akses_for'];
    $upload_dokumen = $_FILES['upload_dokumen']['name'];
    if($upload_dokumen == null){
      $data = array(
        'nama_dokumen' => $nama_dokumen,
        'bag_or_keb' => $bag_or_keb,
        'jenis_dok' => $jenis_dok,
        'masa_aktif_awal' => $cnvrt_masa_aktif_awal,
        'masa_aktif_akhir' => $cnvrt_masa_aktif_akhir,
        'pic' => $pic,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokument
      );
      $where = array('id' => $id);
      $this->model_dokumen->update_dokumen($where,$data,'tb_dokumen');
      redirect('c_data_dokumen/edit_data_dokumen/'.$id);
    }else{
      $config['upload_path'] = './uploads';
      $config['allowed_types'] = '*';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('upload_dokumen')) {
        echo "Gambar Gagal Upload !";
      }else {
        $upload_dokumen=$this->upload->data('file_name');
      }
      $data = array(
        'nama_dokumen' => $nama_dokumen,
        'bag_or_keb' => $bag_or_keb,
        'jenis_dok' => $jenis_dok,
        'masa_aktif_awal' => $cnvrt_masa_aktif_awal,
        'masa_aktif_akhir' => $cnvrt_masa_aktif_akhir,
        'pic' => $pic,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokumen
      );
      $where = array('id' => $id);
      $this->model_dokumen->update_dokumen($where,$data,'tb_dokumen');
      redirect('c_data_dokumen/edit_data_dokumen/'.$id);
    }
    
    
  }
  public function delete($id)
	{
	$this->db->query("DELETE FROM `reminder_dok`.`tb_dokumen` WHERE `tb_dokumen`.`id` = '$id'");
	$this->db->query("DELETE FROM `reminder_dok`.`histori_download_dokumen` WHERE `histori_download_dokumen`.`id_dokumen` = '$id'");
	$this->db->query("DELETE FROM `reminder_dok`.`histori_pembarui_dokumen` WHERE `histori_pembarui_dokumen`.`id_dokumen` = '$id'");
	redirect('c_data_dokumen/index');
  }
  public function permintaan_download()
  { 
      $this->load->library('user_agent');
      $data['browser'] = $this->agent->browser();
      $data['os'] = $this->agent->platform();
      $data['ip_address'] = $this->input->ip_address();
      $id_pem_dokumen = $this->session->userdata('id');
      $query_download_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm,histori_download_dokumen.id AS idhistori FROM tb_dokumen 
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      LEFT JOIN histori_download_dokumen ON tb_dokumen.id = histori_download_dokumen.id_dokumen
      LEFT JOIN tb_user ON tb_dokumen.akses_for = tb_user.id
      WHERE tb_dokumen.id_user = '$id_pem_dokumen' && histori_download_dokumen.status != ''");
      $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id_pem_dokumen' && pengingat = '1'");
      $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id_pem_dokumen' && pengingat = '1'");
      $data['notifikasi_reminder'] = $query_notifikasi->result_array();
      $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
      $data['data_download_dokumen'] = $query_download_dokumen->result_array(); 
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar');
      $this->load->view('permintaan_download',$data);
      $this->load->view('templates/footer');
  }
  public function tolak_permintaan_download()
  {   
    $idhistori            = $this->input->post('idhistori');
    $kode_generate  = '-';
    $status         = 'Ditolak';
    $data1 = array(
      'status'    => $status,
      'kode_unik' => $kode_generate
    );
    $where1 = array('id' => $idhistori);
    $this->model_dokumen->update_dokumen($where1,$data1,'histori_download_dokumen');
    redirect('c_data_dokumen/permintaan_download');
  }
  public function modal_statusperpanjang()
  { 
    $dataperubahan = $this->input->post('iddokumens');
    $query_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
    WHERE tb_dokumen.id = '$dataperubahan' && pengingat = '1'");
    $data['perubahandokumen'] = $query_dokumen->result_array(); 
    foreach($data as $row)
    {
      echo $row[0]['nama_dokumen'].' : ';
       $str = $row[0]['masa_aktif_akhir'];
       $format_tgl = $str;
       $hari = $row[0]['durasi_tgl'];
       $bulan = $row[0]['durasi_bulan'];
       $tahun = $row[0]['durasi_tahun'];
       $tgl1    = $format_tgl; 
       $tgl2    = date('d-m-Y', strtotime('-'.$hari.'days', strtotime($tgl1)));
       $tgl3    = date('d-m-Y', strtotime('-'.$bulan.'month', strtotime($tgl2)));
       $tgl4    = date('d-m-Y', strtotime('-'.$tahun.'year', strtotime($tgl3)));
       $awal  = date_create();
        $akhir = date_create($tgl1);
        $interval = $akhir->diff($awal);
        echo $interval->format('<span style="color: red;"> %y Tahun, %m Bulan, %d Hari lagi</span>');
        echo '</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Diperpanjang</button>
        <a href="'.base_url().'c_data_dokumen/edit_data_dokumen/'.$dataperubahan.'#exampleModalCenter'.'"><button  type="button" class="btn btn-primary">Memperbarui masa Aktif</button></a>
        </div>';
        // echo $interval->format('%a total days')."\n"; 
        
         

    }
  }
  public function sendsms() 
    {
      $notelp            = $this->input->post('notelp');
      $pesan            = $this->input->post('pesan');
      $url = "http://103.16.199.187/masking/send_post.php";
      $rows = array (
      'username' => 'ptpn12_sms ',
      'password' => '123456789',
      'hp' => '62'.$notelp   ,
      'message' => 'Kode Verifikasi anda adalah  '.$pesan.'  silahkan masukkan kode tersebut untuk mendownload dokumen permintaan anda'
      );
      $curl = curl_init();
      curl_setopt( $curl, CURLOPT_URL, $url );
      curl_setopt( $curl, CURLOPT_POST, TRUE );
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
      curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($rows) );
      curl_setopt( $curl, CURLOPT_HEADER, FALSE );
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
      curl_setopt($curl, CURLOPT_TIMEOUT, 60);
      $htm = curl_exec($curl);
      if(curl_errno($curl) !== 0) {
      error_log('cURL error when connecting to ' . $url . ': ' . curl_error($curl));
      }
      curl_close($curl);
      print_r($htm);
      if($htm != '0'){
        $this->session->set_flashdata('something', 'Pesan Terkirim');
        redirect('c_data_dokumen/permintaan_download');
      }

    }

}
 ?>
