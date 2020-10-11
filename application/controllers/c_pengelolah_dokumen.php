<?php
class C_pengelolah_dokumen extends CI_Controller{
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
    $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
    $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
    $query_dokumen = $this->db->query("SELECT * FROM `hkm_dokumen`
    LEFT JOIN tb_user ON hkm_dokumen.user_upload = tb_user.id
    LEFT JOIN hkm_master_jenis_dokumen ON hkm_dokumen.jenis_dokumen = hkm_master_jenis_dokumen.id_jenis_dokumen
    WHERE hkm_dokumen.user_upload = '$id'");
    $data['notifikasi_reminder'] = $query_notifikasi->result_array();
    $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
    $data['data_dokumen'] = $query_dokumen->result_array();
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar');
      $this->load->view('pengelolah_dokumen',$data);
      $this->load->view('templates/footer');
  }
  public function detail_dokumen($id_dokumen)
  { 
    $id_pengakses = $this->session->userdata('id');
    $query_download_dokumen = $this->db->query("SELECT *,hkm_dokumen.upload_dokumen AS dkm_lama,hkm_dokumen.status AS sts_lama FROM hkm_dokumen
    LEFT JOIN hkm_dokumen_proses ON hkm_dokumen.id_dokumen = hkm_dokumen_proses.id_dokumen
    WHERE hkm_dokumen.id_dokumen = '$id_dokumen' && hkm_dokumen_proses.upload_dokumen != '' && hkm_dokumen_proses.status != '' && hkm_dokumen.upload_dokumen != ''");
    $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id_pengakses' && pengingat = '1'");
    $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
    LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
    WHERE tb_dokumen.id_user = '$id_pengakses' && pengingat = '1'");
    $data['notifikasi_reminder'] = $query_notifikasi->result_array();
    $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
    $data['detail_pengelolah'] = $query_download_dokumen->result_array();
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('detail-pengelolah_dokumen',$data);
    $this->load->view('templates/footer');
  }
  public function form_data_dokumen()
  { 
    $query_dokumen = $this->db->query("SELECT * FROM `hkm_dokumen`");
    $data['data_dokumen_lama'] = $query_dokumen->result_array();
    $data['jenis_dokumen'] = $this->model_dokumen->tampil_data_jenis_pengelolah_dokumen()->result();
    $data['user'] = $this->model_dokumen->tampil_data_user()->result();
    $this->load->view('tambah-pengelolah_dokumen',$data);
  }
  public function tambah_data_dokumen()
  { 
      
      $id = $this->session->userdata('id');
      $nama_dokumen = $this->input->post('nama_dokumen');
      $jenis_dok = $this->input->post('jenis_dok');
      $pic = $this->input->post('pic');
      $status = $this->input->post('status');
      $dokumen_lama = $this->input->post('dokumen_lama');
      $tanggal = date('d/m/Y');
      $akses_for = $_POST['akses_for'];
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
      if ($status == 'Baru'){
        $data = array(
          'user_upload' => $id,
          'nama_dokumen' => $nama_dokumen,
          'jenis_dokumen' => $jenis_dok,
          'pic' => $pic,
          'status' => $status,
          'tanggal' => $tanggal,
          'akses_for' => implode(",",$akses_for),
          'upload_dokumen' => $upload_dokumen
        );
        $this->model_dokumen->tambah_dokumen($data, 'hkm_dokumen');
        redirect('c_pengelolah_dokumen/index');
      }elseif ($status == 'Mencabut') {
        $data = array(
          'id_dokumen' => $dokumen_lama,
          'status' => $status,
          'upload_dokumen' => $upload_dokumen
        );
        $data1 = array(
          'status' => 'Dicabut',
        );
        $where = array('id_dokumen' => $dokumen_lama);
        $this->model_dokumen->update_dokumen($where,$data1,'hkm_dokumen');
        $this->model_dokumen->tambah_dokumen($data, 'hkm_dokumen_proses');
        redirect('c_pengelolah_dokumen/index');
      }
      elseif ($status == 'Mengubah') {
        $data = array(
          'id_dokumen' => $dokumen_lama,
          'status' => $status,
          'upload_dokumen' => $upload_dokumen
        );
        $data1 = array(
          'status' => 'Diubah',
        );
        $where = array('id_dokumen' => $dokumen_lama);
        $this->model_dokumen->update_dokumen($where,$data1,'hkm_dokumen');
        $this->model_dokumen->tambah_dokumen($data, 'hkm_dokumen_proses');
        redirect('c_pengelolah_dokumen/index');
      }
      
    
    
  }
  public function edit_data_dokumen($id)
  {
    $where = array('id_dokumen' =>$id);
    $nama = $this->session->userdata('username');
    $data['data_dokumen'] = $this->model_dokumen->edit_dokumen($where,'hkm_dokumen')->result();
    $data['jenis_dokumen'] = $this->model_dokumen->tampil_data_jenis_pengelolah_dokumen()->result();
    $data['user'] = $this->model_dokumen->tampil_data_user()->result();
    $query_dokumen = $this->db->query("SELECT * FROM tb_user
    LEFT JOIN hkm_dokumen ON tb_user.id = hkm_dokumen.user_upload 
    LEFT JOIN hkm_master_jenis_dokumen ON hkm_dokumen.jenis_dokumen = hkm_master_jenis_dokumen.id_jenis_dokumen
    WHERE tb_user.username = '$nama'");
    $data['histori_data_dokumen'] = $query_dokumen->result_array();
    
    $this->load->view('edit-pengelolah_dokumen',$data);
  }
  public function update_data_dokumen()
  {
    $id       = $this->session->userdata('id');
    print_r($id);
    die();
    $nama_dokumen = $this->input->post('nama_dokumen');
    $jenis_dok = $this->input->post('jenis_dok');
    $pic = $this->input->post('pic');
    $status = $this->input->post('status');
    $tanggal = date('d/m/Y');
    $akses_for = $_POST['akses_for'];
    $upload_dokument = $this->input->post('upload_dokument');
    $upload_dokumen = $_FILES['upload_dokumen']['name'];
    if($upload_dokumen == null){
      $data = array(
        'user_upload' => $id,
        'nama_dokumen' => $nama_dokumen,
        'jenis_dokumen' => $jenis_dok,
        'pic' => $pic,
        'status' => $status,
        'tanggal' => $tanggal,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokument
      );
      $where = array('id_dokumen' => $id);
      $this->model_dokumen->update_dokumen($where,$data,'hkm_dokumen');
      redirect('c_pengelolah_dokumen/edit_data_dokumen/'.$id);
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
        'user_upload' => $id,
        'nama_dokumen' => $nama_dokumen,
        'jenis_dokumen' => $jenis_dok,
        'pic' => $pic,
        'status' => $status,
        'tanggal' => $tanggal,
        'akses_for' => implode(",",$akses_for),
        'upload_dokumen' => $upload_dokumen
      );
      $where = array('id_dokumen' => $id);
      $this->model_dokumen->update_dokumen($where,$data,'hkm_dokumen');
      redirect('c_pengelolah_dokumen/edit_data_dokumen/'.$id);
    }
    
    
  }
  
  public function delete($id)
	{
	$this->db->query("DELETE FROM `reminder_dok`.`hkm_dokumen` WHERE `hkm_dokumen`.`id_dokumen` = '$id'"); 
	redirect('c_pengelolah_dokumen/index');
  }
  public function lakukan_download_pemilik($data_dokumen)
  {
    $this->load->helper('download');
    $datadok = $data_dokumen;
    force_download('uploads/'.$datadok,NULL);

  }
  public function kirim_email(){
    $config = [
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'fajarhansyah6@gmail.com',
      'smtp_pass' => 'supragtr2019',
      'smtp_port' => 465

    ];
    $this->load->library('email',$config);
    $this->email->initialize($config);

    $this->email->from('fajarhansyah6@gmail.com');
    $this->email->set_newline("\r\n");
    $this->email->to('fajarhansyah1@gmail.com');
    $this->email->subject('Coba tes');
    $this->email->message('tes aja');

    if($this->email->send()){
      echo "Berhasil Dikirim";
    }else{
      show_error($this->email->print_debugger());
    }
  }

}
 ?>