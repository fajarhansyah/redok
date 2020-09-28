<?php
class C_master_user extends CI_Controller{
  public function index()
  {
      $id = $this->session->userdata('id');
      $query_notifikasi = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $jumlah_query_notifikasi = $this->db->query("SELECT *,COUNT(tb_dokumen.id) AS jn FROM tb_dokumen 
      LEFT JOIN tb_user ON tb_dokumen.id_user = tb_user.id
      WHERE tb_dokumen.id_user = '$id' && pengingat = '1'");
      $data_user = $this->db->query("SELECT *,tb_user.id AS id_user FROM tb_user 
      LEFT JOIN tb_role ON tb_user.role_id = tb_role.id");
      $data['data_user'] = $data_user->result_array();
      $data['notifikasi_reminder'] = $query_notifikasi->result_array();
      $data['jumlah_notifikasi_reminder'] = $jumlah_query_notifikasi->result_array();
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar');
      $this->load->view('master_user',$data);
      $this->load->view('templates/footer');
    
  }
  public function form_user()
  { 
    $data['role'] = $this->model_dokumen->tampil_data_role()->result();
    $this->load->view('tambah-master_user',$data);
  }
  public function tambah_user()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $role_id = $this->input->post('role_id');
    $no_telp = $this->input->post('no_telp');
    
    $data = array(
      'username' => $username,
      'password' => $password,
      'role_id' => $role_id,
      'no_telp' => $no_telp
    );
    $this->model_jenis_dokumen->tambah_jenis_dokumen($data, 'tb_user');
    redirect('c_master_user/index');
  }
  public function edit_user($id)
  {
    $where = array('id' =>$id);
    $data['role'] = $this->model_dokumen->tampil_data_role()->result();
    $data['user'] = $this->model_jenis_dokumen->edit_jenis_dokumen($where,'tb_user')->result();
    
    $this->load->view('edit-master_user',$data);
  }
  public function update_user()
  {
    $id       = $this->input->post('id');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $role_id = $this->input->post('role_id');
    $no_telp = $this->input->post('no_telp');
    
    $data = array(
      'username' => $username,
      'password' => $password,
      'role_id' => $role_id,
      'no_telp' => $no_telp
    );
    $where = array('id' => $id);
    $this->model_dokumen->update_dokumen($where,$data,'tb_user');
    redirect('c_master_user/index');
  }
  public function delete($id)
	{
	$this->db->query("DELETE FROM `reminder_dok`.`tb_user` WHERE `tb_user`.`id` = '$id'");
	redirect('c_master_user/index');
	}

}
 ?>
