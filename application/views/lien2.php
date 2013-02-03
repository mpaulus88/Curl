
<?php
if($this->session->userdata('logged in')):
$this->load->helper('form');?>
<section id="curl">
  <h1 class="ieTitle">Curl-engine</h1>
  <?php
  echo form_open('lien/recuperer_donnees', array('method' => 'post'));
  echo form_fieldset('Curl lien');
  echo form_input('lien', 'lien');
  echo form_submit('check', 'CurLink','class="btn"');
  echo form_fieldset_close();
  echo form_close(); 
  if(isset($message)): ?>
  <p class="erreurs"><?php echo $message; ?></p>
  <?php endif; ?> 
</section>

<?php if( isset($check)&& $check=='checked'):?>
<section id="ajout" class="form">
  <h1 class="ieTitle">Ajout d'un lien</h1>
  <?php
  echo validation_errors();
  echo form_open('lien/ajouter', array('method' => 'post'));
  echo form_fieldset('Ajout lien');
  $input=array('id'=>'titre','name'=>'titre','value'=>$titre_lien);
  echo form_input($input);
  $hidden=array('url'=>$url);
  echo form_hidden($hidden);
  $text_area = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $description_lien,
                'rows'        => '4', 
                'cols'        =>'50'
              );
  echo form_textarea($text_area);
if(isset($image_lien)):?>
  <div id="imageBox">
    <a id="right" href="#" class="imgSelector" rel="js">right</a>
    <?php foreach($image_lien as $img): ?>
      <img alt="<?php echo $titre_lien; ?>" src="<?php echo $img;?>"/>
    <?php
      $radio =array(
      				'name'    =>'image',
      				'value'	=> $img,
              'id'=>'image'
      );
      echo form_radio($radio);?>
      <br>
      <?php endforeach;?> 
      <a href="#" id="left" class="imgSelector" rel="js">left</a>
    <?php endif;?>
    </div>
  <?php echo form_submit('submit', 'Partager','class="btn"');
  echo form_fieldset_close();
  echo form_close();
  endif; ?>
</section>
<?php if( isset($edit)&& $edit=='edited'):?>
 <section id="edit" class="form">
  <h1 class="hidden">Editer un lien</h1>
  <?php
  echo validation_errors();
  echo form_open('lien/modifier', array('method' => 'post'));
  echo form_fieldset('Modifier lien');
  $input=array('id'=>'titre','name'=>'titre','value'=>$lien['titre']);
  echo form_input($input);
  $hidden=array('id'=>$lien['id_lien']);
  echo form_hidden($hidden);
  $text_area = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $lien['description'],
                'rows'        => '4', 
                'cols'        =>'50'
              );
  echo form_textarea($text_area);
  echo form_submit('edit', 'Modifier','class="btn"');
  echo form_fieldset_close();
  echo form_close();
  endif; ?>
</section>
 <?php
    if($this->session->userdata('logged in')&&!isset($unlink)):       
    $this->load->helper('anchorLink');
    anchorLink($anchor);
     endif; 
       if(isset($first)):?>
    <section id="searchTag">
     <?php
     echo form_open('lien/listerLienTag', array('method' => 'get')); 
     echo form_fieldset('Recherche Tag');?>
     <span>#</span>
     <?php
     echo form_input('tag', 'tag');
     echo form_submit('search', 'Rechercher','class="btn"');
      echo form_fieldset_close();
     echo form_close(); ?>
    </section>
    <?php endif; 
     if(isset($erreur)): ?>
     <section id="erreur">
      <h1>Erreur!</h1>
      <p class="erreurs"><?php echo $erreur; ?></p>
     </section>
    <?php endif;
 if(isset($liens)): ?>
  <section id="listeLien">
   <h1 class="hidden">Liste des liens</h1>
   <?php foreach($liens as $link):?>
   <article class="lien">
    <h1 class='linkHeader'><?php echo $link['titre']; ?></h1>
    <?php if($link['id_membre']==$this->session->userdata['id_membre']): ?>
    <a href="lien/supprimer?id=<?php echo $link['id_lien']; ?>" class="linkTool" name="supprimer">Supprimer</a>
    <a href="lien/editer?id=<?php echo $link['id_lien']; ?>" class="linkTool" name="editer">Editer</a>
    <?php
    endif;
    ?>
    <p><?php echo $link['description']; ?></p>
    <a target="_blank" name="< ?php echo $link['titre']; ?>" href="<?php echo $link['url']; ?>">Consulter le site</a>
    <?php if(!empty($link['image'])): ?>
    <img alt="<?php echo $link['titre']; ?>" src="<?php echo site_url(); ?>web/img/uploaded/<?php echo $link['image']; ?>"/>
    <?php endif; ?>
  </article>
<?php endforeach; ?>
</section>
<?php endif; endif; ?>
<?php  
