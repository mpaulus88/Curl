<?php class membre extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('M_Membre');
		$data['titre']="CurLink";
		$this->load->view('layout',$data);
	}
	public function login()
	{
		$data['titre']="Connexion";
		$this->load->library('encrypt');
		$this->load->model('M_Membre');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
		$this->form_validation->set_message('required', "Le champ %s est requis");
		$this->form_validation->set_message('valid_email', "L'adresse email n'est pas valide");

		$this->form_validation->set_message('matches', 'Le mot de passe ne correspond pas à la confirmation');
		if ($this->form_validation->run() == FALSE)
		{
			$data=array();
			$data['titre']="Connexion";
			$data['errL']="errL";
		}
		else
		{
			$data['mdp']= $this->input->post('mdp');
			$data['mdp']=$this->encrypt->sha1($data['mdp']);
			$data['email']= $this->input->post('email');
			$data['titre']="Connexion";
			if($this->M_Membre->check($data))
			{
				$data_user=$this->M_Membre->check($data);
				$data_tmp= array('id_membre'=>$data_user['id_membre'],'nom'=>$data_user['nom']);
				$this->session->set_userdata($data_tmp);
				$this->session->set_userdata('logged in', TRUE);
				redirect('/lien');
			} 
			else
			{
				$data['messageM']="Erreur d'identification";
				$data['vue'] = $this->load->view('membre', $data, true);
	            $this->load->view('layout', $data);
			}	
		}
		$data['titre']="Connexion";
	    $this->load->view('layout', $data);	
	}
	public function logout()
	{
		$data['titre']='Déconnexion';
		$this->session->unset_userdata('logged in');
		$data['vue'] = $this->load->view('membre','$data', true);
        $this->load->view('layout', $data);
	}
	public function signin()
	{
		$this->load->model('M_Membre');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Iemail', 'email', 'required|valid_email|is_unique[membre.email]');
		$this->form_validation->set_rules('Imdp', 'mot de passe', 'required|matches[confirm]');
		$this->form_validation->set_rules('confirm', 'confirmation du mot de passe', 'required');
		$this->form_validation->set_rules('pseudo', 'pseudo', 'required|is_unique[membre.nom]');
		$this->form_validation->set_message('required', "Le champ %s est requis");
		$this->form_validation->set_message('valid_email', "L'adresse email n'est pas valide");
		$this->form_validation->set_message('is_unique', 'Cet %s est déja utilisé');
		$this->form_validation->set_message('matches', 'Le mot de passe ne correspond pas à la confirmation');
		if ($this->form_validation->run() == FALSE)
		{
			$data=array();
			$data['errM']='errM';
		}
		else
		{
		$data=array();
		$this->load->library('encrypt');
		$data['pseudo']=$this->input->post('pseudo');
		$data['mdp']= $this->input->post('Imdp');
		$data['mdp']=$this->encrypt->sha1($data['mdp']);
		$data['confirm']=$this->input->post('confirm');
		$data['email']= $this->input->post('Iemail');
		$this->M_Membre->add($data);
		$data['titre']="Connexion";
		$data['messageOk']="Vous êtes désormais inscrit";
		$data['vue'] = $this->load->view('membre', $data, true);
        $this->load->view('layout', $data);
	}
		$data['titre']="Connexion";
		$data['vue'] = $this->load->view('membre', $data, true);
        $this->load->view('layout', $data);
	}
	public function ajouterFollows()
	{
		$this->load->model('M_Membre');
		if($get=$this->input->get(NULL, TRUE))
		{
			$data['id_membre']=$this->session->userdata('id_membre');
			$data['id_ami']=$get['id_ami'];
			$this->M_Membre->addFollow($data);
		}
			if($this->input->is_ajax_request() == TRUE)
			{
			}
			else
			{
				redirect('lien/');
			}
	}
	public function retirerFollows()
	{
		$this->load->model('M_Membre');
		if($get=$this->input->get(NULL, TRUE))
		{
			$data['id_membre']=$this->session->userdata('id_membre');
			$data['id_ami']=$get['id_ami'];
			$this->M_Membre->delFollow($data);
		}
			if($this->input->is_ajax_request() == TRUE)
			{
			}
			else
			{
				redirect('lien/');
			}
	}
	
}