<?php
class M_Lien extends CI_Model
{
	public function listing()
	{
		$this->db->simple_query('SET NAMES \'utf-8\''); 
		$this->db->order_by("id_lien", "desc"); 
		$query = $this->db->get('liens');
		
		return $query->result_array();
	}
	public function listFollow($data)
	{	
		$this->db->where_in('id_membre',$data);
		$query = $this->db->get('liens');
		return $query->result_array();
	}
	
	public function add($data)
	{
		if($data['image'])
		{
			$data = array(
		   'titre' => $data['titre'] ,
		   'description' => $data['description'] ,
		   'image' => $data['image'],
		   'id_membre'=>$data['id_membre'],
		   'url'=>$data['url']
		);
		}
		else
		{
		$data = array(
		   'titre' => $data['titre'] ,
		   'description' => $data['description'] ,
		   'id_membre'=>$data['id_membre'],
		   'url'=>$data['url']
		);
		}
		$this->db->insert('liens', $data);
		return $this->db->insert_id(); 
	}
	public function addTag($tag,$id)
	{
		$data=array('tag'=>$tag,'id_lien'=>$id);
		$this->db->insert('tags',$data);
	}
	public function addAt($at,$id)
	{
		$data=array('at'=>$at,'id_lien'=>$id);
		$this->db->insert('ats',$data);
	}
	public function listTag($tag)
	{
		$this->db->where('tag',$tag);
		$this->db->order_by("liens.id_lien", "desc"); 
		$this->db->select('*');
		$this->db->from('liens');
		$this->db->join('tags', 'tags.id_lien = liens.id_lien');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function listAt($nom)
	{
		$this->db->where('at',$nom);
		$this->db->select('*');
		$this->db->order_by("liens.id_lien", "desc"); 
		$this->db->from('liens');
		$this->db->join('ats', 'ats.id_lien = liens.id_lien');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function delete($id)
	{
		$this->db->where('id_lien',$id);
		$this->db->delete('liens');
	}
	public function listOne($id)
	{
		$this->db->where('id_lien',$id);
		$this->db->from('liens');	
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update($data,$id)
	{
		$data = array(
		   'titre' => $data['titre'] ,
		   'description' => $data['description'] ,
		);

		$this->db->where('id_lien', $id);
		$this->db->update('liens', $data);
		return $id; 
	}
}