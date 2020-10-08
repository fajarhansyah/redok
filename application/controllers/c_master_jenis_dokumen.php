<?php
class C_master_jenis_dokumen extends CI_Controller{
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
      $query_dokumen = $this->db->query("SELECT * FROM `tb_master_jenis_dok` WHERE 1");
      $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $data['notifikasi_reminder'] = $query_notifikasi->result_array();
      $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
      $data['jenis_dokumen'] = $query_dokumen->result_array();
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar');
      $this->load->view('master_jenis_dokumen',$data);
      $this->load->view('templates/footer');
    
  }
  public function form_jenis_dokumen()
  { 
    $this->load->view('tambah-master_jenis_dokumen');
  }
  public function tambah_jenis_dokumen()
  {
    $nama_jenis_dokumen = $this->input->post('nama_jenis_dokumen');
    $durasi_tahun = $this->input->post('durasi_tahun');
    $durasi_bulan = $this->input->post('durasi_bulan');
    $durasi_tgl = $this->input->post('durasi_tgl');
    
    $data = array(
      'nama_jenis_dokumen' => $nama_jenis_dokumen,
      'durasi_tahun' => $durasi_tahun,
      'durasi_bulan' => $durasi_bulan,
      'durasi_tgl' => $durasi_tgl
    );
    $this->model_jenis_dokumen->tambah_jenis_dokumen($data, 'tb_master_jenis_dok');
    redirect('c_master_jenis_dokumen/index');
  }
  public function edit_jenis_dokumen($id)
  {
    $where = array('id' =>$id);
    $data['jenis_dokumen'] = $this->model_jenis_dokumen->edit_jenis_dokumen($where,'tb_master_jenis_dok')->result();
    
    $this->load->view('edit-master_jenis_dokumen',$data);
  }
  public function update_jenis_dokumen()
  {
    $id       = $this->input->post('id');
    $nama_jenis_dokumen = $this->input->post('nama_jenis_dokumen');
    $durasi_tahun = $this->input->post('durasi_tahun');
    $durasi_bulan = $this->input->post('durasi_bulan');
    $durasi_tgl = $this->input->post('durasi_tgl');
    
    $data = array(
      'nama_jenis_dokumen' => $nama_jenis_dokumen,
      'durasi_tahun' => $durasi_tahun,
      'durasi_bulan' => $durasi_bulan,
      'durasi_tgl' => $durasi_tgl
    );
    $where = array('id' => $id);
    $this->model_dokumen->update_dokumen($where,$data,'tb_master_jenis_dok');
    redirect('c_master_jenis_dokumen/index');
  }
  public function delete($id)
	{
	$this->db->query("DELETE FROM `reminder_dok`.`tb_master_jenis_dok` WHERE `tb_master_jenis_dok`.`id` = '$id'");
	redirect('c_master_jenis_dokumen/index');
	}

}
 ?>
