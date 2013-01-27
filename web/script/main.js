
/* JS Document - Map.js
 * november 2012
 */

/*jslint regexp: true, vars: true, white: true, browser: true */
/*jshint nonstandard: true, browser: true, boss: true */
/*global jQuery */

( function ( $ ) {
	"use strict";
	// -- globals
	var $a,
		$link,
		$body,
		$content,
		$titre,
		$image,
		$description,
		$url,
		$tag,
		$aTag,
		$aId,
		$n,
		$id,
		$name,
		i,
		$titlepre='CurLink',
		$title,
		max,
		$clicked,
		$lastFunction='lien/lister',
		$container;
	

		
	

	// -- methods
	//Ajax CURL
	var curLink=function(e){
		e.preventDefault();
		e.returnValue = false;
		$link=$('input[name="lien"]').val();
		$(this).val('Curl en Cours...');
		console.log($link);
		$lastFunction='lien/lister';
		//Envoi des données et récupération de la vue
		$.post( 'lien/recuperer_donnees' , {lien:$link},
		 	function (data) {
		 		$content=$('#content *');
				$container=$('#content');
		 		$container.fadeOut(200);
		 		$content.remove();
		 		$container.append(data);
		 		$container.fadeIn(200);
		 		form();
			});
		 document.title=$titlepre+"-Ajout d'un lien";
	};
	var shareLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$image=$('.form input[checked="checked"]').val();
		$titre=$('#titre').val();
		$description=$('#description').val();
		$url=$('input[name="url"]').val();
		console.log($image,$titre,$description,$url);
		$lastFunction='lien/ajouter';

		//Envoi des données
		$.post( $lastFunction , {image:$image,titre:$titre,description:$description,url:$url},
		 	function (data) {
		 		getView(data);
			});
	};
	var editLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$titre=$('#titre').val();
		$id=$('input[name="id"]').val();
		$description=$('#description').val();
		console.log($image,$titre,$description,$url);
		$lastFunction='lien/modifier';

		//Envoi des données
		$.post( $lastFunction , {titre:$titre,description:$description,id:$id},
		 	function (data) {
		 		getView(data);
			});
	};

	var allLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$lastFunction='lien/lister';
		$.get( 'lien/lister', {},
			function (data){
				getView(data);
			});
	};
	var followedLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$lastFunction='lien/listerLienFollow';
		$.get( 'lien/listerLienFollow', {},
			function (data){
				getView(data);
			});
		 document.title=$titlepre+"-Liens que je suis";
	};
	var namedLink=function(e)
	{

		e.preventDefault();
		e.returnValue = false;
		$lastFunction='lien/listerLienAt';
		$.get('lien/listerLienAt',{},
			function (data){
				getView(data);
			});
		 document.title=$titlepre+"-Lien qui me citent";
	};
	var tagLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$tag=$(this).attr('href');
		$aTag=$tag.split('/');
		$n=($aTag.length)-1;
		$tag=$aTag[$n];
		$tag=$tag.replace('?tag=','');
		console.log($tag);
		$lastFunction='lien/listerLienTag';
		$.get( $lastFunction , {tag:$tag},
		 	function (data) {
		 		getView(data);
			});
	};	
	var anchorTagLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$lastFunction='lien/listerLienTag';
		$.get( $lastFunction , {first:'first'},
		 	function (data) {
		 		getView(data);
			});
		 document.title=$titlepre+"-Lien par tag";

	};
	var followMember=function(e){
		e.preventDefault();
		e.returnValue = false;
		$id=$(this).attr('href');
		$aId=$id.split('/');
		$n=($aId.length)-1;
		$id=$aId[$n];
		$id=$id.replace('?id_ami=','');
		console.log($id);
		$name=$('this').prev('h1').text();
		$.get( 'membre/ajouterFollows' , {id_ami:$id});
		$(this).remove();
		
		$.post( $lastFunction ,{message:$name},
		 	function (data) {
		 		getView(data);
			});
	};


	//Changement de vue
	var getView=function(data)
	{
		$content=$('#content *');
			$container=$('#content');
		 	$container.fadeOut(200);
		 	$content.remove();
		 	$container.append(data);
		 	$container.fadeIn(200);
	};
	var form=function()
	{
		$('.form img').hide();
		$('.form input[type="radio"]').hide();
		$('.form img').first().show();
		$('.form input[type="radio"]').eq(0).attr("checked", "checked");
		max=($('.form img').length)-1;
		i=0;
		$('.imgSelector').show().css({maxWidth:'45px','float':'right'});
		$('.form img').css({maxWidth:'45px',position:'absolute', top:'0.5em',left:'6.2em'});
	}
	var prevImg=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$('.form img').eq(i).fadeOut(200);
		$('.form input[type="radio"]').eq(i).removeAttr("checked");
		if(i<0)
		{
			i=max;
		}
		console.log(i);
		i--;
		$('.form input[type="radio"]').eq(i).attr("checked", "checked");
		$('.form img').eq(i).fadeIn(200);
	};
		var nextImg=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		console.log($('.form input[checked="checked"]').val());
		$('.form img').eq(i).fadeOut(200);
		$('.form input[type="radio"]').eq(i).removeAttr("checked");
		if(i>max-1)
		{
			i=-1;
		}
		console.log(i);
		i++;
		$('.form input[type="radio"]').eq(i).attr("checked", "checked");
		$('.form img').eq(i).fadeIn(200);

		
	};
	var deleteLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$('#delete').remove();
		$id=$(this).attr('href');
		$aId=$id.split('/');
		$n=($aId.length)-1;
		$id=$aId[$n];
		$id=$id.replace('?id=','');
		if($clicked!=false)
		{	$('body').append('<div id="overlay"></div>');
			$('#overlay').css({backgroundColor:'rgba(255,255,255,0.5)',display:'block',position:'absolute',top:0,left:0,zIndex:'3',height:$(document).height(),width:$(document).width()})
			$(this).parent('.lien').append('<div id="delete"><p>Voulez vous supprimer ce lien?</p><a href="#" id="yes" class="btn">Oui</a><a href="#" id="no" class="btn">Non</a></div>');
		}
		$clicked=true;
	};

	var delLink=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$(this).parent('#delete').remove();
		$.get( 'lien/supprimer' , {id:$id});
		$(this).parent('.lien').remove();
	};
	var removeDel=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$(this).parent('#delete').remove();
		$('#overlay').remove();
	};
	var edit=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$id=$(this).attr('href');
		$aId=$id.split('/');
		$n=($aId.length)-1;
		$id=$aId[$n];
		$id=$id.replace('editer?id=','');
		console.log($id);
		$lastFunction='lien';
		$.get('lien/editer',{id:$id},
		 	function (data) {
		 		console.log(data);
		 		getView(data);
			});
		 document.title=$titlepre+"-Modification d'un lien";
	};
	var searchTag=function(e)
	{
		e.preventDefault();
		e.returnValue = false;
		$tag=$('input[name="tag"]').val();
		$.get('lien/listerLienTag',{tag:$tag},
		 	function (data) {
		 		console.log(data);
		 		getView(data);
			});

	};
	var prevent =function(e)
	{
		if(e.which==13)
		{
		e.preventDefault();
		e.returnValue = false;
		}
		console.log('clicked');
		curLink();	
		return false;
		
	};


	$( function () {
		// -- onload routines
		$body=$("body");
		$body.delegate('input[name="check"]','click',curLink);
		$body.delegate('input[name="submit"]','click',shareLink);
		$body.delegate('input[name="edit"]','click',editLink);
		$body.delegate('a[name="editer"]','click',edit);
		$body.delegate('#follow','click',followedLink);
		$body.delegate('#named','click',namedLink);
		$body.delegate('#link','click',allLink);
		$body.delegate('#linkTag','click',anchorTagLink);
		$body.delegate('.tag','click',tagLink);
		$body.delegate('.followMember','click',followMember);
		$body.delegate('#left','click',prevImg);
		$body.delegate('#right','click',nextImg);
		$body.delegate('a[name="supprimer"]','click',deleteLink);
		$body.delegate('#no','click',removeDel);
		$body.delegate('#yes','click',delLink);
		$body.delegate('input[name="search"]','click',searchTag);
		$body.delegate('input[name="lien"]','keydown',prevent);



	});

}( jQuery ) );