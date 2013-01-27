<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mycustom{

	

    public function listerFollow($id)
	{
		$CI =& get_instance();
		$CI->load->model('M_Membre');
		$suivi=$CI->M_Membre->getFollow($id);
		$data=[];
		foreach ($suivi as $follow) {
		array_push($data,$follow['id_ami']);
		}
		return $data;
	}
	public function listerMembre()
	{	$CI =& get_instance();
		$CI->load->model('M_Membre');
		$id=$CI->session->userdata('id_membre');
		$membre=$CI->M_Membre->listMember($id);
		$follow=$this->listerFollow($id);
		foreach($membre as $key=>$member) 
		{
			if(in_array($member['id_membre'], $follow))
			{
				$membre[$key]['followed']='true';
			}
			else
			{
				$membre[$key]['followed']='false';
			}	
		}
		$data['membre']=$membre;
		$data['listeMembre']=$CI->load->view('listerMembre', $data,true);
		return $data['listeMembre'];
	}
}
