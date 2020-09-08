<?php
class C_data_dokumen extends CI_Controller{
  public function index()
  {   $nama = $this->session->userdata('username');
      $query_dokumen = $this->db->query("SELECT *,tb_dokumen.id AS iddkm FROM tb_user 
      LEFT JOIN tb_dokumen ON tb_user.id = tb_dokumen.id_user
      LEFT JOIN tb_master_bag_keb ON tb_dokumen.bag_or_keb = tb_master_bag_keb.id
      LEFT JOIN tb_master_jenis_dok ON tb_dokumen.jenis_dok = tb_master_jenis_dok.id
      WHERE tb_user.username = '$nama'");
      $data['data_dokumen'] = $query_dokumen->result_array();
      $this->load->view('templates/header');
      $this->load->view('templates/sidebar');
      $this->load->view('data_dokumen',$data);
      $this->load->view('templates/footer');
  }
  public function permintaan_download()
  {   
      $this->load->view('templates/header');
      $this->load->view('templates/sidebar');
      $this->load->view('permintaan_download');
      $this->load->view('templates/footer');
  }
  public function form_data_dokumen()
  { 
    $data['jenis_dokumen'] = $this->model_dokumen->tampil_data_jenis_dokumen()->result();
    $data['bagian_kebun'] = $this->model_dokumen->tampil_data_bagian_kebun()->result();
    $this->load->view('tambah-data_dokumen',$data);
  }
  public function tambah_data_dokumen()
  {
    $id = $this->session->userdata('id');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $bag_or_keb = $this->input->post('bag_or_keb');
    $jenis_dok = $this->input->post('jenis_dok');
    $masa_aktif = $this->input->post('masa_aktif');
    $pic = $this->input->post('pic');
    $akses_for = $_POST['akses_for'];
    
    $upload_dokumen = $_FILES['upload_dokumen']['name'];
    if($upload_dokumen =''){}else{
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
      'masa_aktif' => $masa_aktif,
      'pic' => $pic,
      'akses_for' => implode(",",$akses_for),
      'upload_dokumen' => $upload_dokumen
    );
    $this->model_dokumen->tambah_dokumen($data1, 'tb_dokumen');
    redirect('c_data_dokumen/index');
  }
  public function tambah_histori_data_dokumen()
  {
    $id_dokumen = $this->input->post('id_dokumen');
    $pembaruan_tanggal = $this->input->post('pembaruan_tanggal');
    $data1 = array(
      'id_dokumen' => $id_dokumen
    );
    $data2 = array(
      'masa_aktif' => $pembaruan_tanggal
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
    $data['bagian_kebun'] = $this->model_dokumen->tampil_data_bagian_kebun()->result();
    $nama = $this->session->userdata('username');
    $query_dokumen = $this->db->query("SELECT * FROM tb_user 
    LEFT JOIN tb_dokumen ON tb_user.id = tb_dokumen.id_user
    LEFT JOIN histori_pembarui_dokumen ON tb_dokumen.id = histori_pembarui_dokumen.id_dokumen
    LEFT JOIN tb_master_bag_keb ON tb_dokumen.bag_or_keb = tb_master_bag_keb.id
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
    $pic = $this->input->post('pic');
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
    
    $data = array(
      'nama_dokumen' => $nama_dokumen,
      'bag_or_keb' => $bag_or_keb,
      'jenis_dok' => $jenis_dok,
      'masa_aktif' => $masa_aktif,
      'pic' => $pic,
      'akses_for' => implode(",",$akses_for),
      'upload_dokumen' => $upload_dokumen
    );
    $where = array('id' => $id);
    $this->model_dokumen->update_dokumen($where,$data,'tb_dokumen');
    redirect('c_data_dokumen/edit_data_dokumen/'.$id);
  }
  public function delete($id)
	{
	$this->db->query("DELETE FROM `reminder_dok`.`tb_dokumen` WHERE `tb_dokumen`.`id` = '$id'");
	redirect('c_data_dokumen/index');
	}
  

}
 ?>
