
/**********************************AJAX*********************************************/

/*
 * Fonction ajaxLoadContent
 * Execute une requête asynchrone pour récupérer des informations sur le serveur
 */
function ajaxLoadContent(page, elem, param){
	
	var rep = elem;
	
	//Création de l'objet XMLHttpRequest
	http = createRequestObject();
	//Paramétrage de la connexion au serveur et et de l'appel du programme en asynchrone
	http.open('POST', './' + page, true);
	//Affectation d'une fonction à l'évenement onreadystatechange
	http.onreadystatechange = handleAJAXReturn;
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//Envoi de la requête
	http.send(param);
	
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 *	0 : Non initialisé
	 *	1 : En cours de chargement (requête en train de s'effectuer ; en attente de la réponse du programme sur le serveur)
	 *	2 : Chargé (la réponse est arrivée)
	 *	3 : Interactif (la réponse est en cours de traitement)
	 *	4 : Terminé (la requête est terminée, nous pouvons utiliser le résultat)
	 */
	function handleAJAXReturn(){
		if(http.readyState == 4){
			if(http.status == 200){
				// Utilisation du résultat
				//alert(http.responseText);
				rep.innerHTML = http.responseText;
			}
		}
	}
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 */
	function createRequestObject(){
		var http;
		if(window.XMLHttpRequest){ // Mozilla, Safari, ...
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){ // Internet Explorer
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return http;
	}
}

/*********************************FIN AJAX****************************************************/

/*
 * Fonction ajaxLoadContent
 * Execute une requête asynchrone pour récupérer des informations sur le serveur
 */
function ajaxLoadContent2(page, elem, param){
	
	var rep = elem;
	//alert(page+' '+elem +' '+param);
	//Création de l'objet XMLHttpRequest
	http = createRequestObject();
	//Paramétrage de la connexion au serveur et et de l'appel du programme en asynchrone
	http.open('POST', './' + page, true);
	//Affectation d'une fonction à l'évenement onreadystatechange
	http.onreadystatechange = handleAJAXReturn;
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//Envoi de la requête
	http.send(param);
	
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 *	0 : Non initialisé
	 *	1 : En cours de chargement (requête en train de s'effectuer ; en attente de la réponse du programme sur le serveur)
	 *	2 : Chargé (la réponse est arrivée)
	 *	3 : Interactif (la réponse est en cours de traitement)
	 *	4 : Terminé (la requête est terminée, nous pouvons utiliser le résultat)
	 */
	function handleAJAXReturn(){
		if(http.readyState == 4){
			if(http.status == 200){
				// Utilisation du résultat
				//alert(http.responseText);
				rep.value = http.responseText;
			}
		}
	}
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 */
	function createRequestObject(){
		var http;
		if(window.XMLHttpRequest){ // Mozilla, Safari, ...
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){ // Internet Explorer
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return http;
	}
}



/*
 * Fonction ajaxLoadContent
 * Execute une requête asynchrone pour récupérer des informations sur le serveur
 */
function ajaxLoadContentSuppr(page, elem, param){
	
	var rep = elem;
	//alert(page+' '+elem +' '+param);
	//Création de l'objet XMLHttpRequest
	http = createRequestObject();
	//Paramétrage de la connexion au serveur et et de l'appel du programme en asynchrone
	http.open('POST', './' + page, true);
	//Affectation d'une fonction à l'évenement onreadystatechange
	http.onreadystatechange = handleAJAXReturn;
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//Envoi de la requête
	http.send(param);
	
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 *	0 : Non initialisé
	 *	1 : En cours de chargement (requête en train de s'effectuer ; en attente de la réponse du programme sur le serveur)
	 *	2 : Chargé (la réponse est arrivée)
	 *	3 : Interactif (la réponse est en cours de traitement)
	 *	4 : Terminé (la requête est terminée, nous pouvons utiliser le résultat)
	 */
	function handleAJAXReturn(){
		if(http.readyState == 4){
			if(http.status == 200){
				// Utilisation du résultat
				//alert(http.responseText);
				var jrep = eval('(' + http.responseText + ')');
				
				if(jrep.res == "Suppression reussie")
				{
					rep.innerHTML = '<div style="position:absolute;top:35px;left:100px;">Suppression reussie</div>';	
					document.getElementById('form_retour').submit();
				}
				else if((jrep.res == "Echec suppression") || (jrep.res == "Echec suppression correspondre"))
				{
					if(jrep.res == "Echec suppression")
						rep.innerHTML = "<center>Echec de la suppression</center>";	
					else
						rep.innerHTML = "<center>Echec de la suppression correspondre</center>";	
						
					setTimeout(function(){
									document.getElementById('bout_suppr').style.visibility = "visible";	
							   },
							   1100);
							   
					setTimeout(function(){
									document.getElementById('ajax_suppr').style.visibility = "hidden";
									document.getElementById('ajax_suppr_if').style.visibility = "hidden";
							   },
							   1000);
							   
								
				}
				else if(jrep.res == "Pas de suppression")
				{
					var str = "Vous ne pouvez pas supprimer ce consommable</li>";
					if(jrep.livrer == "1")
						str += "<ul><li>car ce consommable fait partie d'une livraison</li>";
					
					if(jrep.commande == "1")
						str += "<li>car ce consommable fait partie d'une commande</li>";
						
					if(jrep.consomme == "1")
						str += "<li>car ce consommable fait partie d'une consommation d'un service</li>";
						
					if(jrep.demande == "1")
						str += "<li>car ce consommable fait partie d'une demande</li></ul>";
						
					rep.innerHTML = str;
					
					setTimeout(function(){
									document.getElementById('bout_suppr').style.visibility = "visible";	
							   },
							   10100);
					
					setTimeout(function(){
									document.getElementById('ajax_suppr').style.visibility = "hidden";
									document.getElementById('ajax_suppr_if').style.visibility = "hidden";
							   },
							   10000);
					
				}
				
			}
		}
	}
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 */
	function createRequestObject(){
		var http;
		if(window.XMLHttpRequest){ // Mozilla, Safari, ...
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){ // Internet Explorer
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return http;
	}
}

/*********************************FIN AJAX****************************************************/

/*
 * Fonction ajaxLoadContent
 * Execute une requête asynchrone pour récupérer des informations sur le serveur
 */
function ajaxLoadContentRef(page, param){
	
	
	//alert(page+' '+elem +' '+param);
	//Création de l'objet XMLHttpRequest
	http = createRequestObject();
	//Paramétrage de la connexion au serveur et et de l'appel du programme en asynchrone
	http.open('POST', './' + page, true);
	//Affectation d'une fonction à l'évenement onreadystatechange
	http.onreadystatechange = handleAJAXReturn;
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//Envoi de la requête
	http.send(param);
	
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 *	0 : Non initialisé
	 *	1 : En cours de chargement (requête en train de s'effectuer ; en attente de la réponse du programme sur le serveur)
	 *	2 : Chargé (la réponse est arrivée)
	 *	3 : Interactif (la réponse est en cours de traitement)
	 *	4 : Terminé (la requête est terminée, nous pouvons utiliser le résultat)
	 */
	function handleAJAXReturn(){
		if(http.readyState == 4){
			if(http.status == 200){
				// Utilisation du résultat
				//alert(http.responseText);
				var jrep = eval('(' + http.responseText + ')');
				
				if(jrep.res == 'libre')
				{
					var form = document.getElementById('form_aff_conso');
					var param = 'reference=' + form.reference.value + '&designation=' + form.designation.value + '&pu=' + form.pu.value + '&lot=' + form.lot.value +  '&qte_stock=' + form.qte_stock.value + '&seuil_reap=' + form.seuil_reap.value + '&commentaire=' + form.com1.value + form.com2.value + form.com3.value + form.com4.value + form.com5.value + form.com5.value + '&tva=' + form.tva.value + '&type_conso=' + form.type_conso.value + '&conso_ref=' + form.conso_ref.value;
					ajaxLoadContentModifconso('modif_conso.php', document.getElementById('ajax_modif'), param);
					
				}
				else if(jrep.res == 'pris')
				{
					alert('La reference est deja prise');	
					document.getElementById('ref').value = document.getElementById('conso_ref').value;
				}
				else if(jrep.res == 'Pas de modif de ref')
				{
					document.getElementById('ref').value = document.getElementById('conso_ref').value;
					
					var str = "Vous ne pouvez pas modifier la reference de ce consommable</li>";
					if(jrep.livrer == "1")
						str += "<ul><li>car ce consommable fait partie d'une livraison</li>";
					
					if(jrep.commande == "1")
						str += "<li>car ce consommable fait partie d'une commande</li>";
						
					if(jrep.consomme == "1")
						str += "<li>car ce consommable fait partie d'une consommation d'un service</li>";
						
					if(jrep.demande == "1")
						str += "<li>car ce consommable fait partie d'une demande</li></ul>";
						
					document.getElementById('ajax_modif').style.visibility = "visible";
					document.getElementById('ajax_suppr_if').style.visibility = "visible";
					document.getElementById('ajax_modif').innerHTML = str;
					
					document.getElementById('bout_suppr').style.visibility = "hidden";
					setTimeout(function(){
									document.getElementById('bout_suppr').style.visibility = "visible";	
							   },
							   5100);
					
					setTimeout(function(){
									document.getElementById('ajax_modif').style.visibility = "hidden";
									document.getElementById('ajax_suppr_if').style.visibility = "hidden";
							   },
							   5000);
					
				}
					
			}
		}
	}
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 */
	function createRequestObject(){
		var http;
		if(window.XMLHttpRequest){ // Mozilla, Safari, ...
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){ // Internet Explorer
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return http;
	}
}

/*********************************FIN AJAX****************************************************/

/*
 * Fonction ajaxLoadContent
 * Execute une requête asynchrone pour récupérer des informations sur le serveur
 */
function ajaxLoadContentModifconso(page, elem, param){
	
	var rep = elem;
	//alert(page+' '+elem +' '+param);
	//Création de l'objet XMLHttpRequest
	http = createRequestObject();
	//Paramétrage de la connexion au serveur et et de l'appel du programme en asynchrone
	http.open('POST', './' + page, true);
	//Affectation d'une fonction à l'évenement onreadystatechange
	http.onreadystatechange = handleAJAXReturn;
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//Envoi de la requête
	http.send(param);
	
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 *	0 : Non initialisé
	 *	1 : En cours de chargement (requête en train de s'effectuer ; en attente de la réponse du programme sur le serveur)
	 *	2 : Chargé (la réponse est arrivée)
	 *	3 : Interactif (la réponse est en cours de traitement)
	 *	4 : Terminé (la requête est terminée, nous pouvons utiliser le résultat)
	 */
	function handleAJAXReturn(){
		if(http.readyState == 4){
			if(http.status == 200){
				// Utilisation du résultat
				//alert(http.responseText);
				var form = document.getElementById('form_aff_conso');
				
				var jrep = eval('(' + http.responseText + ')');
				if(jrep.resultat == 'Echec modification')
				{
					document.getElementById('ajax_modif').style.visibility = "visible";
					document.getElementById('ajax_suppr_if').style.visibility = "visible";
					rep.innerHTML = "<center>Echec lors de la modification</center><br/><center>" + jrep.err + "<center>";
					rep.innerHTML += "<br/>Si cette erreur persiste, veuillez consulter l'administrateur";
					setTimeout(function(){
									document.getElementById('ajax_modif').style.visibility = "hidden";
									document.getElementById('ajax_suppr_if').style.visibility = "hidden";
							   },
							   10000);
					document.getElementById('ref').value = document.getElementById('conso_ref').value;
				}
				else
				{
					form.conso_ref.value = form.reference.value;
					form.conso_des.value = form.designation.value;
					form.conso_prix_tot.value = form.prix_tot.value
					form.conso_pu.value = form.pu.value;
					form.conso_lot.value = form.lot.value;
					form.conso_qte_stock.value = form.qte_stock.value;
					form.conso_seuil_reap.value = form.seuil_reap.value;
					form.conso_com1.value = form.com1.value;
					form.conso_com2.value = form.com2.value;
					form.conso_com3.value = form.com3.value;
					form.conso_com4.value = form.com4.value;
					form.conso_com5.value = form.com5.value;
					form.conso_com6.value = form.com6.value;
					
					/*document.getElementById('ajax_modif').style.visibility = "visible";
					document.getElementById('ajax_suppr_if').style.visibility = "visible";
					rep.innerHTML += jrep.res;
					setTimeout(function(){
									document.getElementById('ajax_modif').style.visibility = "hidden";
									document.getElementById('ajax_suppr_if').style.visibility = "hidden";
							   },
							   10000);*/
				
				
				}
				
			}
		}
	}
	/*
	 * Fonction createRequestObject
	 * Crée un objet XMLHttpRequest. Compatible avec la majorité des navigateurs
	 */
	function createRequestObject(){
		var http;
		if(window.XMLHttpRequest){ // Mozilla, Safari, ...
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){ // Internet Explorer
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return http;
	}
}
