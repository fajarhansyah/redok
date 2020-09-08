<?php
class C_download_dokumen extends CI_Controller{
  public function index()
  {
      $this->load->view('templates/header');
      $this->load->view('templates/sidebar');
      $this->load->view('download_dokumen');
      $this->load->view('templates/footer');
    
  }

}
 ?>
