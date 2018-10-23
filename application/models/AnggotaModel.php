<?php
	
class AnggotaModel extends CI_Model {

	public $Anggota;

	public function __construct() {
        parent::__construct();
    }


   public function GetAllData()
   {
      $this->db->from('data_anggota');
   		$query = $this->db->get();
            
      return $query->result_object();
   } 

   public function store()
   {
   		return $this->db->insert('data_anggota', $this->Anggota);
   }

   public function update()
   {
      $this->db->set($this->Anggota);
      $this->db->where('id_anggota', $this->Anggota['id_anggota']);

      return $this->db->update('data_anggota', $this->Anggota);
   }

   public function delete($Id_anggota)
   {
            
            $this->db->where('id_anggota', $this->Anggota['id_anggota']);

            return $this->db->delete('data_anggota', $this->Anggota);
   }


}
