<?php	
	function anchorLink($anchor)
	{
		switch ($anchor) {
    case 'link':
     echo anchor('lien', 'Tous les liens','id="link" title="Tous les liens" class="linkAnchor active"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" title="Liens des personnes que je suis" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" title="Liens qui me citent" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" title="Liens par Tag" class="linkAnchor"');
        break;
    case 'follow':
       echo anchor('lien', 'Tous les liens','id="link" title="Tous les liens" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" title="Liens des personnes que je suis" class="linkAnchor active"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" title="Liens qui me citent" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" title="Liens par Tag" class="linkAnchor"');
        break;
    case 'named':
        echo anchor('lien', 'Tous les liens','id="link" title="Tous les liens" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" title="Liens des personnes que je suis" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" title="Liens qui me citent" class="linkAnchor active"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" title="Liens par Tag" class="linkAnchor"');
        break;
     case 'linkTag':
        echo anchor('lien', 'Tous les liens','id="link" title="Tous les liens" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" title="Liens des personnes que je suis" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" title="Liens qui me citent" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" title="Liens par Tag" class="linkAnchor active"');
        break;    
}
	}
?>
