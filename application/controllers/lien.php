<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lien extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->helper('form');
		$this->load->model('M_Lien');
		$data['erreurs']=array();
		$data['anchor']='link';
		$data['liens']= $this->M_Lien->listing();
		$this->lister($data);
		if($this->input->is_ajax_request() == TRUE)
		{
			echo $data['liens']= $this->M_Lien->listing();
		}		
	}
	public function recuperer_donnees()
	{
		$this->load->model('M_Lien');
		$data['erreurs']=array();
		$this->load->library('Curl');
		$url = $this->input->post('lien');
		if ( strstr($url, 'http://') == false )
		{
			$url_tmp=$url;
			$url='http://'.$url;
		}
		if(substr($url,-1)!='/')
		{
			$url[strlen($url)]='/';
		}
		if(!$data['donnees']= $this->curl->simple_get($url))
		{
			$this->curl->option(CURLOPT_SSL_VERIFYPEER, FALSE);
			$url='https://'.$url_tmp;
			if(!$data['donnees']= $this->curl->simple_get($url))
			{
				$url='https://www.'.$url_tmp;
				if(!$data['donnees']= $this->curl->simple_get($url))
				{
					$data['message']="L'url que vous avez entrez n'est pas valide";
				}
			}					
		}
		if($data['donnees'])
		{
			//$d_txt=file_get_contents($data['donnees']);
			file_put_contents('web/img/uploaded/'.'.txt',$data['donnees'], LOCK_EX);
		$regexTitre = '#<title.*?>(.*)</title>#im';
			if(preg_match($regexTitre,$data['donnees'], $titre_lien))
			{
				$data['titre_lien']=$titre_lien[1];
				$data['titre_lien']=strip_tags(html_entity_decode($data['titre_lien']));
			}
		$regexDescription = '#name="description".content="(.*?)"#im';
			if(preg_match($regexDescription,$data['donnees'], $description_lien))
			{
				$data['description_lien']=$description_lien[1];

				iconv(mb_detect_encoding($data['description_lien'], mb_detect_order(), true), "UTF-8", $data['description_lien']);	
				$data['description_lien']=utf8_encode(utf8_decode($data['description_lien']));
				$data['description_lien']=mb_convert_encoding($data['description_lien'],"UTF-8","HTML-ENTITIES");
				$data['description_lien']=strip_tags(html_entity_decode($data['description_lien']));
			}
			else
			{
				$data['description_lien']='Pas de description disponible';
			}
		$regexImage = '#<img.*src="(.*?)"#im';
			$image_lien=array();
			if(preg_match_all($regexImage,$data['donnees'], $image_lien))
			{
				$data['image_lien']=array();
				foreach($image_lien[1] as $img_tmp)
				{
					if ( strstr($img_tmp, 'http') == false )
					{
						if($img_tmp[0]=='/')
						{
							$img_tmp=substr($img_tmp,1);
						}
						if(substr($img_tmp[0],-1)=='/')
						{
							$img_tmp=substr($img_tmp, 0,-1);
						}
						$img_tmp=$url.$img_tmp;
					}

					array_push($data['image_lien'], $img_tmp);
				}
			
		}
		else
		{
			$data['message']="Pas d'image disponible";
		}

			$data['url']=$url;
			$data['check']='checked';
			$data['titre']='Curl-engine';
			if($this->input->is_ajax_request() == TRUE)
			{
				$data['liens']=$this->M_Lien->listing();
				$data['anchor']='link';
				 echo ($data['vue']=$this->load->view('lien',$data,TRUE));
			}
			else
			{
			$data['anchor']='link';
			$data['vue']=$this->load->view('lien',$data,TRUE);
			$this->load->view('layout', $data);
			}
		}
		else
		{
			$data['message']="L'url entrée n'est pas valide";
			if($this->input->is_ajax_request() == TRUE)
				{
					 $data['liens']=$this->M_Lien->listing();
					 $data['anchor']='link';
					 echo ($data['vue']=$this->load->view('lien',$data,TRUE));
					
				}
				else
				{
				$data['anchor']='link';
				$data['vue']=$this->load->view('lien',$data,TRUE);
				$this->load->view('layout', $data);
				}
		}		
		
	

	}
	public function ajouter()
	{
		var_dump($this->input->post('image'));
		$this->load->model('M_Lien');
		$this->load->helper(array('form', 'url'));
		$data['titre']="Ajout d'un lien";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titre', 'titre', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_message('required', "Le champ %s est requis");
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($u_image=$this->input->post('image'))
			{
			$ext=getimagesize($u_image);
			$ext=explode('/', $ext['mime']);
			$extension=$ext[1];
			$d_image=file_get_contents($u_image);
			$n_image=uniqid().$this->session->userdata('session_id').'.'.$extension;
			file_put_contents('web/img/uploaded/'.$n_image,$d_image, LOCK_EX);
			$config['image_library'] = 'imagemagick';
					$config['source_image'] = 'web/img/uploaded/'.$n_image;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 85;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
			}
			else
			{
				$n_image=NULL;
			}
			$data=array(
				'description' => $this->input->post('description') ,
				'image' =>$n_image,
				'titre' =>$this->input->post('titre'),
				'id_membre'=>$this->session->userdata('id_membre'),
				'url'=>$this->input->post('url')
					);
			$id=$this->M_Lien->add($data);
			$data=$this->ajouterTag($id,$data);
			$error=$this->ajouterArobase($id,$data);
			$data['vue']=$this->load->view('lien',$data,TRUE);
			redirect($this->load->view('layout', $data));
		}
	}
	public function ajouterTag($id,$data)
	{
		$description=$data['description'];
		$regexTag = '#\#(.*?)\s#im';
		if(preg_match_all($regexTag,$description, $tag))
		{
			foreach ($tag[1] as $_tag) {
				$this->M_Lien->addTag($_tag,$id);
			}
		}
		return $data;
	}
	public function ajouterArobase($id,$data)
	{
		$description=$data['description'];
		$regexArobase = '#@(.*?)\s#im';
		if(preg_match_all($regexArobase,$description, $at))
		{
			foreach ($at[1] as $_at)
			{
				$this->M_Lien->addAt($_at,$id);
			}
		}
		return $data;
	}
	public function lister()
	{
		$this->load->model('M_Lien');
		$this->load->library('mycustom');
		if (!isset($data['anchor']))
		{
			$data['anchor']='link';
		}
		$data['liens']=$this->M_Lien->listing();
		$data=$this->convertirTag($data);
		if(!isset($data['titre']))
		{
			$data['titre']='Liste des liens';	
		}
		$data['connect']=$this->load->view('membre',$data,TRUE);
		$data['vue']=$this->load->view('lien',$data,TRUE);
		$data['listeMembre']=$this->mycustom->listerMembre();
		if($this->input->is_ajax_request() == TRUE)
		{
		echo ($data['vue']);
		}
		else
		{

			$this->load->view('layout', $data);	
		}
	}
	public function convertirTag($data)
	{
		foreach ($data['liens'] as $key=>$liens) {
			str_replace('"',"'",$data['liens'][$key]['description']);
			$data['liens'][$key]['description']=preg_replace_callback('#\#(.*?)\s#im','self::replace', $data['liens'][$key]['description']);
		}
		return $data;
	}
	public function replace($matches)
	{
		return $matches[1]='<a class="tag" href="'.site_url().'lien/listerLienTag/?tag='.$matches[1].'">'.$matches[0].'</a>';
	}

	
	public function listerLienFollow()
	{
		$this->load->model('M_Lien');
		$id=$this->session->userdata('id_membre');
		$this->load->library('mycustom');
		$data['anchor']='follow';
		$data['titre']='Liste des liens suivis';
		if($follow=$this->mycustom->listerFollow($id))
		{
			$data['liens']=$this->M_Lien->listFollow($follow);
			$data=$this->convertirTag($data);
		}
		else
		{
			$data['erreur']='Vous ne suivez personne actuellement.';
		}
		$data['vue']=$this->load->view('lien',$data,TRUE);
		unset($data['erreur']);
		if($this->input->is_ajax_request() == TRUE)
		{
		echo ($data['vue']);
		}
		else
		{
			$this->load->view('layout', $data);	
		}
		
	}
	public function listerLienTag()
	{
		$this->load->model('M_Lien');
		$data['anchor']='linkTag';
		$data['first']='first';
		$data['titre']='Liste par Tag';
		if($get=$this->input->get(NULL, TRUE))
		{
			if(!isset($get['first']))
			{
				$tag=$get['tag'];
				if($data['liens']=$this->M_Lien->listTag($tag))
				{
				$data=$this->convertirTag($data);	
				}
				else
				{
					$data['erreur']='Aucun lien ne correspond.';
					$data['vue']=$this->load->view('lien',$data,TRUE);	
				}	
			}
			else
			{
				$data['first']=$get['first'];
			}
			$data['vue']=$this->load->view('lien',$data,TRUE);	
			if($this->input->is_ajax_request() == TRUE)
			{
			echo ($data['vue']);
			}
			else
			{
				$this->load->view('layout', $data);	
			}	
		}
	}
	public function listerLienAt()
	{
		$this->load->model('M_Lien');
		$nom=$this->session->userdata('id_nom');
		$data['anchor']='named';
		$data['titre']='Liste des liens qui me citent';
		if(!$data['liens']=$this->M_Lien->listAt($nom))
		{
			$data['erreur']="Vous n'êtes cité dans aucun lien";
		}
		$data=$this->convertirTag($data);
		$data['vue']=$this->load->view('lien',$data,TRUE);
		if($this->input->is_ajax_request() == TRUE)
			{
			echo ($data['vue']);
			}
			else
			{
				$this->load->view('layout', $data);	
			}	
	}
	public function supprimer()
	{
		$this->load->model('M_Lien');
		$get=$this->input->get(NULL, TRUE);
		$id=$get['id'];
		$this->M_Lien->delete($id);
		$data['anchor']='link';
		$data['vue']=$this->load->view('lien',$data,TRUE);
		if($this->input->is_ajax_request() == TRUE)
			{
			echo ($data['vue']);
			}
			else
			{
				$this->load->view('layout', $data);	
			}	
	}
	public function editer()
	{
		$this->load->model('M_Lien');
		$data['edit']="edited";
		$get=$this->input->get(NULL, TRUE);
		$data['anchor']='link';
		$data['titre']="Modification d'un lien";
		$id=$get['id'];
		$data['lien']=$this->M_Lien->listOne($id);
		$data['vue']=$this->load->view('lien',$data,TRUE);
		if($this->input->is_ajax_request() == TRUE)
		{
			$data['liens']=$this->M_Lien->listing();
			$data['anchor']='link';
			echo ($data['vue']=$this->load->view('lien',$data,TRUE));
		}
		else
		{
				$data['unlink']='unlink';
				$data['vue']=$this->load->view('lien',$data,TRUE);
				$this->load->view('layout', $data);	
		}	
	}

	public function modifier()
	{
		$this->load->model('M_Lien');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titre', 'titre', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_message('required', "Le champ %s est requis");
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'description' => $this->input->post('description') ,
				'titre' =>$this->input->post('titre'),
					);
			$id=$this->input->post('id');
			if($this->M_Lien->update($data,$id))
			{
				$data['erreur']='Votre lien a bien été modifié';
			}
			else
			{
				$data['erreur']="Votre lien n'a pu être modifié";
			}
			$data=$this->ajouterTag($id,$data);
			$error=$this->ajouterArobase($id,$data);
			$data['vue']=$this->load->view('lien',$data,TRUE);
			redirect($this->load->view('layout', $data));
		}
	}




	
	
}