<?php
class M_Membre extends CI_MODEl
{
	public function check($data)
	{
		$query = $this->db->get_where('membre',array('email'=>$data['email'],'mdp'=>$data['mdp']));
		return $query->row_array();
	}
	public function add($data)
	{
		$data = array(
               'email' => $data['email'],
               'mdp'=>$data['mdp'],
               'nom'=>$data['pseudo']
            );
		$query=$this->db->insert('membre', $data); ;
	}
	public function listMember($id)
	{ 	$this->db->select('id_membre, nom');
		$this->db->where('id_membre !=', $id);
		$query=$this->db->get('membre');
		return $query->result_array();
	}
	public function getFollow($id)
	{
		$this->db->select('id_ami');
		$query=$this->db->get_where('follow',array('id_membre'=>$id));
		return $query->result_array();
	}
	public function addFollow($data)
	{
		$this->db->insert('follow',$data);
	}
	public function delFollow($data)
	{	$this->db->where(array('id_membre'=>$data['id_membre'],'id_ami'=>$data['id_ami']));
		$this->db->delete('follow');
	}

}