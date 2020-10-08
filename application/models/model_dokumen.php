<?php
class Model_dokumen extends CI_Model{
  public function tampil_data(){
    return $this->db->get('tb_dokumen');
  }
  public function tampil_data_jenis_dokumen(){
    return $this->db->get('tb_master_jenis_dok');
  }
  public function tampil_data_jenis_pengelolah_dokumen(){
    return $this->db->get('hkm_master_jenis_dokumen');
  }
  public function tampil_data_bagian_kebun(){
    return $this->db->get('tb_master_bag_keb');
  }
  public function tampil_data_user(){
    return $this->db->get('tb_user');
  }
  public function tampil_data_role(){
    return $this->db->get('tb_role');
  }
  public function tambah_dokumen($data,$tables){
      $this->db->insert($tables,$data);
  }
  public function tambah_histori_dokumen($data,$tables){
    $this->db->insert($tables,$data);
}
  public function edit_dokumen($where,$tables){
    return $this->db->get_where($tables,$where);
  }
  public function update_dokumen($where,$data,$tables){
      $this->db->where($where);
      $this->db->update($tables,$data);
  }
  public function hapus_dokumen($where,$tables){
    $this->db->where($where);
    $this->db->delete($tables);
  }
}
 ?>
