<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaController extends CI_Controller {
	public function __construct() {
        parent::__construct();
    	$this->load->model('AnggotaModel');  
    }

	public function index() {

        $Anggota = $this->AnggotaModel->GetAllData();
        $Sender = array("data" => $Anggota);
        $this->load->view('Anggota/index', $Sender); 

    }

    public function store()
    {
    	$this->AnggotaModel->Anggota = array(
			                        "nama" => $this->input->post("nama"),
					        		"tanggal_lahir" => $this->input->post("tanggal_lahir"),
                                    "alamat" => $this->input->post("alamat"),
                                    "moto" => $this->input->post("moto")
			        			);

    	$this->AnggotaModel->store();
    }

    public function update()
    {
        $this->AnggotaModel->Anggota = array(
                                    "id_anggota" => $this->input->post("id_anggota"),
                                    "nama" => $this->input->post("nama"),
                                    "tanggal_lahir" => $this->input->post("tanggal_lahir"),
                                    "alamat" => $this->input->post("alamat"),
                                    "moto" => $this->input->post("moto")
                                );

        $this->AnggotaModel->update();
    }
    
    public function delete($Id_anggota) { 
        $this->AnggotaModel->Anggota  = array('id_anggota' => $Id_anggota);
        $this->AnggotaModel->delete($Id_anggota, 'data_anggota');

        redirect('AnggotaController/index');
        
    }
}
