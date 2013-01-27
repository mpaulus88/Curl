<?php	
	function anchorLink($anchor)
	{
		switch ($anchor) {
    case 'link':
       echo anchor('lien/lister', 'Tous les liens','id="link" class="linkAnchor active"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" class="linkAnchor"');
        break;
    case 'follow':
       echo anchor('lien/lister', 'Tous les liens','id="link" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" class="linkAnchor active"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" class="linkAnchor"');
        break;
    case 'named':
        echo anchor('lien/lister', 'Tous les liens','id="link" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" class="linkAnchor active"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" class="linkAnchor"');
        break;
     case 'linkTag':
        echo anchor('lien/lister', 'Tous les liens','id="link" class="linkAnchor"');
     echo anchor('lien/listerLienFollow', 'Les liens que je suis','id="follow" class="linkAnchor"');
     echo anchor('lien/listerLienAt', 'Liens qui me citent','id="named" class="linkAnchor"');
     echo anchor('lien/listerLienTag', 'Liens par tags','id="linkTag" class="linkAnchor active"');
        break;    
}
	}
?>
