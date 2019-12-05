<?php

//Ini Controller Home ============
class Home extends Controller{

  public function index(){

    $data['judul']='Home';
    $data['nama']=$this->model('User_model')->getUser();
    $this->view('templates/header', $data);
    $this->view('home/slider');
    $this->view('home/pilih_produk');
    $this->view('home/index');
    $this->view('templates/footer');

  }

}