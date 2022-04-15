/*----------------Menu gauche-----------------------------*/
function Sur_menu(id, fond, couleur){
		
	var elem = document.getElementById(id);
	var lien = document.getElementById(id + 'a');
	elem.style.backgroundImage = "url('Image/" + fond + "')";	
	elem.style.cursor = "pointer";
	if(typeof couleur != 'undefined')
		lien.style.color = couleur;
	else
		lien.style.color = "white";
	
}

function Sortie_menu(id){
	
	var elem = document.getElementById(id);
	var lien = document.getElementById(id + 'a');
	elem.style.backgroundImage = "";	
	lien.style.color = "black";
	
}


function Sur_menu_ss_men(id, fond, couleur, id_ss_men){
	
	clearTimeout(timer);
	
	Sur_menu(id, fond, couleur);
	document.getElementById(id_ss_men).style.display = 'block';
	
}

var timer;
function Sortie_menu_c(id, id_ss_men){
	
	Sortie_menu(id);
	
	timer = setTimeout(function(){
							document.getElementById(id_ss_men).style.display = 'none'; 
						}, 100);
			
}


function Sur_ss_menu(id, fond, couleur){
		
	clearTimeout(timer);
		
	Sur_menu(id, fond, couleur);
	
}


function Sortie_ss_menu(id, id_ss_men){

	Sortie_menu(id);
	
	timer = setTimeout(function(){
							document.getElementById(id_ss_men).style.display = 'none'; 
						}, 100);
	


}

/***********************/

function Sur_menu_ss_men2(id, fond, couleur, id_ss_men){
	
	clearTimeout(timer2);
	
	Sur_menu(id, fond, couleur);
	document.getElementById(id_ss_men).style.display = 'block';
	
}

var timer2;
function Sortie_menu_c2(id, id_ss_men){
	
	Sortie_menu(id);
	
	timer2 = setTimeout(function(){
							document.getElementById(id_ss_men).style.display = 'none'; 
						}, 100);
			
}


function Sur_ss_menu2(id, fond, couleur){
		
	clearTimeout(timer2);
		
	Sur_menu(id, fond, couleur);
	
}


function Sortie_ss_menu2(id, id_ss_men){

	Sortie_menu(id);
	
	timer2 = setTimeout(function(){
							document.getElementById(id_ss_men).style.display = 'none'; 
						}, 100);
	


}

/**********************/


/*--------------------Fin Menu Gauche-----------------------*/



function Valider_form_connexion(){
	
	var form = document.getElementById('form_connexion');
	var valide = true;
	var str = '';
	
	if(form.login.value == '')
	{
		valide = false;
		str = '- Le champ login est vide.\n';
	}
	else if(form.login.value.search(/^[a-zA-Z0-9\-_.]+$/) == -1)
	{
		valide = false;
		str = '- Le login contient des caracteres incorrect.\n';
	}
	
	if(form.password.value == '')
	{
		valide = false;
		str += '- Le champ mot de passe est vide.\n';
	}
	else if(form.password.value.search(/^[a-zA-Z0-9\-_.]+$/) == -1)
	{
		valide = false;
		str += '- Le mot de passe contient des caracteres incorrect.\n';
	}
	
	if(!valide)
		alert(str);
		
	return valide;
		
}

function Valider_form_ajout_conso(){

	var form = document.getElementById('form_ajout_conso');
	var valide = true;
	var str = '';

	if(form.reference.value == '')
	{
		valide = false;
		str = '- Le reference est vide.\n';
	}
	else if(form.reference.value.search(/^[A-Z0-9\-]+$/) == -1)
	{
		valide = false;
		str += '- Le champ reference contient des caracteres incorrect(Lettre Majuscule).\n';
	}
	else
	{
		//requete synchrone 
		new Ajax.Request(
			'test_ref_saisir.php',
			{
				asynchronous:false,
				method: 'post',
				parameters: {ajax:'ajax', reference:form.reference.value},
				onSuccess: function(http) {
					
					if(http.responseText == 'pris')
					{
						valide = false;
						str += "- La reference est deja prise\n";
					}
					
				},
				
				onFailure: function(http) {
					
					valide = false;
					str += "- Erreur reference\n";
									
				}
				
				
			}
		);
		
		
				
	}
	
	if(form.designation.value == '')
	{
		valide = false;
		str += '- La designation est vide.\n';
	}
	
	if(form.prix_tot.value == '')
	{
		valide = false;
		str += '- Le prix total est vide.\n';
	}
	else if(form.prix_tot.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		valide = false;
		str += '- Le champ prix total contient des caracteres incorrect.\n';
	}
	
	if(form.tva.value == '')
	{
		valide = false;
		str += '- Vous devriez ajouter une tva.\n';
	}
	
	if(form.qte_stock.value == '')
	{
		valide = false;
		str += '- La Qte stock est vide.\n';
	}
	else if(form.qte_stock.value.search(/^[0-9]+$/) == -1)
	{
		valide = false;
		str += '- Le champ Qte stock contient des caracteres incorrect.\n';
	}
	
	if(form.seuil_reap.value == '')
	{
		valide = false;
		str += '- Le Seuil reappro est vide.\n';
	}
	else if(form.seuil_reap.value.search(/^[0-9]+$/) == -1)
	{
		valide = false;
		str += '- Le champ Seuil reappro contient des caracteres incorrect.\n';
	}
		
	
	if(!valide)
		alert(str);
		
	return valide;

}

function Valider_form_ajout_tva(){

	var form = document.getElementById('form_ajout_tva');
	var valide = true;
	var str = '';
	
	if(form.taux_tva.value == '')
	{
		valide = false;
		str += '- Le Taux de tva est vide.\n';
	}
	else if(form.taux_tva.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		valide = false;
		str += '- Le champ Taux de tva contient des caracteres incorrect.\n';
	}
	
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Fenetre_tva(page){
	
	var tva = window.open(page, 'Tva', 'width=370, height=220, resizable=1, scrollbars=1, location=0, status=0, menubar=0, directories=0');
	tva.moveTo(0, 0);
	
	
}

function Valider_form_ajout_type_conso(){

	var form = document.getElementById('form_ajout_type_conso');
	var valide = true;
	var str = '';
	
	if(form.lib_type_conso.value == '')
	{
		valide = false;
		str += '- Le libelle de type conso est vide.\n';
	}
		
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Fenetre_type_conso(page){
	
	var type_conso = window.open(page, 'Type_conso', 'width=580, height=220, resizable=1, scrollbars=1, location=0, status=0, menubar=0, directories=0');
	type_conso.moveTo(0, 0);
	
	
}

function Valider_form_prix_conso(){

	var form = document.getElementById('form_prix_conso');
	var valide = true;
	var str = '';
	
	if(form.prix.value == '')
	{
		valide = false;
		str += '- Le champ prix est vide.\n';
	}
	else if(form.prix.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		valide = false;
		str += '- Le champ prix contient des caracteres incorrect.\n';
	}
		
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Valider_form_comp_prix_conso(){

	var form = document.getElementById('form_comp_prix_conso');
	var valide = true;
	var str = '';
	
	if(form.prix1.value == '')
	{
		valide = false;
		str += '- Le premier champ prix est vide.\n';
	}
	else if(form.prix1.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		valide = false;
		str += '- Le premier champ prix contient des caracteres incorrect.\n';
	}
	
	if(form.prix2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ prix est vide.\n';
	}
	else if(form.prix2.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		valide = false;
		str += '- Le deuxieme champ prix contient des caracteres incorrect.\n';
	}
	
	if(valide && (parseFloat(form.prix2.value) < parseFloat(form.prix1.value)))
	{
		valide = false;
		str += '- Le premier champ prix doit etre inferieur au deuxieme champ prix.\n';
	}
		
	if(!valide)
		alert(str);
		
	return valide;
	
}


function Valider_form_date_livraison(){

	var form = document.getElementById('form_date_livraison');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
		
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
		
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Supprimer_conso(){

	if(confirm('Etes-vous sur de vouloir supprimer ce consommable?'))
	{
				
		var fen_suppr = new Ext.Window({
			title    : 'Gestion des consommables',
			closable : false,
			width    : 330,
			height   : 130,
			resizable:false,
			modal:true,
			plain    : true,
			layout   : 'anchor',
			html:'<div class="boite_mess_val"><center>Suppression en cours<img src="Image/wait.gif" alt="attente de la suppression" /></center></div>'
					
			
		});
				
		fen_suppr.show();
		
		setTimeout(function(){
						new Ajax.Request(
								'suppr_conso.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', reference:document.getElementById('conso_ref').value},
									onSuccess: function(http) {
										
										var jrep = eval('(' + http.responseText + ')');
								
										if(jrep.res == "Suppression reussie")
										{
											fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression reussie</center></div>';	
											document.getElementById('form_retour').submit();
										}
										else if((jrep.res == "Echec suppression") || (jrep.res == "Echec suppression correspondre"))
										{
											if(jrep.res == "Echec suppression")
												fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Echec de la suppression</center></div>';	
											else
												fen_suppr.body.dom.innerHTML  = '<div class="boite_mess_val"><center>Echec de la suppression correspondre</center></div>';	
																				   
											setTimeout(function(){
															fen_suppr.close();
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
												
											fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val">' + str + '</div>';
											
											setTimeout(function(){
															fen_suppr.close();
													   },
													   10000);
											
										}
																		
									},
									
									onFailure : function(){
										
										fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val">Erreur lors de la suppression</div>';
										
										setTimeout(function(){
															fen_suppr.close();
													   },
													   5000);
										
									}
									
								}
							);
						
					},
					500);
		
		
	
				   
	}
		
	


}

function Modif_conso(){
	
	var form = document.getElementById('form_aff_conso');
	
	var param = 'reference=' + form.reference.value + '&designation=' + form.designation.value + '&pu=' + form.pu.value + '&lot=' + form.lot.value +  '&qte_stock=' + form.qte_stock.value + '&seuil_reap=' + form.seuil_reap.value + '&commentaire=' + form.com1.value + form.com2.value + form.com3.value + form.com4.value + form.com5.value + form.com5.value + '&tva=' + form.tva.value + '&type_conso=' + form.type_conso.value + '&conso_ref=' + form.conso_ref.value;
				
	var fen_modif = new Ext.Window({
		title    : 'Gestion des consommables',
		closable : false,
		width    : 330,
		height   : 130,
		resizable:false,
		modal:true,
		plain    : true,
		layout   : 'anchor'
						
	});
			
			
	new Ajax.Request(
		'modif_conso.php',
		{
			method: 'post',
			parameters: param,
			onSuccess: function(http) {
				
				var jrep = eval('(' + http.responseText + ')');
				if(jrep.resultat == 'Echec modification')
				{
					fen_modif.show();
					fen_modif.body.dom.innerHTML = '<div class="boite_mess_val"><center>Echec lors de la modification</center><br/><center>' + jrep.err + "<center>";
					fen_modif.body.dom.innerHTML += "<br/><center>Si cette erreur persiste, veuillez consulter l'administrateur</center></div>";
					
					
					setTimeout(function(){
									fen_modif.close();
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
					
					if(parseInt(form.conso_qte_stock.value) <= parseInt(form.conso_seuil_reap.value))
					{
						document.getElementById('qte_stock').style.backgroundColor  = '#ff8585';
						document.getElementById('rupt_stock').innerHTML = '<span class="rupture_stock">seuil de réapprovisionnement atteint</span>';
												
					}
					else
					{
						document.getElementById('qte_stock').style.backgroundColor  = 'white';
						document.getElementById('rupt_stock').innerHTML = '';
						
					}
					
								
				}
												
			},
			
			onFailure : function(){
				
				fen_modif.body.dom.innerHTML = '<div class="boite_mess_val"><center>Erreur lors de la validation de la modification</center></div>'
				setTimeout(function(){
									fen_modif.close();
							   },
							   10000);
				
			}
			
		}
	);	
	
	
}


function Modif_valider_reference(){

	var form = document.getElementById('form_aff_conso');
	
	if(form.reference.value == '')
	{
		alert('- Le reference doit etre renseigne.\n');
		form.reference.value = form.conso_ref.value;
	}
	else if(form.reference.value.search(/^[A-Z0-9\-]+$/) == -1)
	{
		alert('- Le champ reference contient des caracteres incorrect(Lettre doivent etre en Majuscule).\n');
		form.reference.value = form.conso_ref.value;
	}
	else
	{
		if(form.conso_ref.value != form.reference.value)
		{
													
			var fen_modif = new Ext.Window({
				title    : 'Gestion des consommables',
				closable : false,
				width    : 330,
				height   : 130,
				resizable:false,
				modal:true,
				plain    : true,
				layout   : 'anchor'
								
			});
					
					
			new Ajax.Request(
				'test_reference.php',
				{
					method: 'post',
					parameters: 'nouv_reference=' + document.getElementById('ref').value + '&reference=' + form.conso_ref.value,
					onSuccess: function(http) {
						
						var jrep = eval('(' + http.responseText + ')');
				
						if(jrep.res == 'libre')
						{
							Modif_conso();
							
						}
						else if(jrep.res == 'pris')
						{
							alert('La reference est deja prise');	
							document.getElementById('ref').value = document.getElementById('conso_ref').value;
						}
						else if(jrep.res == 'Pas de modif de ref')
						{
							document.getElementById('ref').value = document.getElementById('conso_ref').value;
							
							var str = '<div class="boite_mess_val">Vous ne pouvez pas modifier la reference de ce consommable :<ul>';
							if(jrep.livrer == "1")
								str += "<li>car ce consommable fait partie d'une livraison</li>";
							
							if(jrep.commande == "1")
								str += "<li>car ce consommable fait partie d'une commande</li>";
								
							if(jrep.consomme == "1")
								str += "<li>car ce consommable fait partie d'une consommation d'un service</li>";
								
							if(jrep.demande == "1")
								str += "<li>car ce consommable fait partie d'une demande</li>";
								
							str += '</ul></div>';
								
							fen_modif.show();
							fen_modif.body.dom.innerHTML = str;
							
														
							setTimeout(function(){
											fen_modif.close();
									   },
									   10000);
							
						}
						
														
					},
					
					onFailure : function(){
						
						fen_modif.body.dom.innerHTML = '<div class="boite_mess_val"><center>Erreur lors de l enregistrement de la reference</center></div>'
						setTimeout(function(){
											fen_modif.close();
									   },
									   10000);
						
					}
					
				}
			);	
			
			
			
			
		}
	}



}

function Modif_valider_designation(){

	var form = document.getElementById('form_aff_conso');

	if(form.designation.value == '')
	{
		alert('- La designation doit etre renseigne.\n');
		form.designation.value = form.conso_des.value;
	}
	else
	{
		if(form.conso_des.value != form.designation.value)
		{
			Modif_conso();
					
		}
	
	}

}

function Modif_valider_pu(){

	var form = document.getElementById('form_aff_conso');

	if(form.pu.value == '')
	{
		alert('- Le prix unitaire doit etre renseigne.\n');
		form.pu.value = form.conso_pu.value;
	}
	else if(form.pu.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		alert('- Le champ prix unitaire contient des caracteres incorrect.\n');
		form.pu.value = form.conso_pu.value;
	}
	else
	{
		if(form.conso_pu.value != form.pu.value)
		{
			Modif_conso();
					
		}
	
	
	}


}

function Modif_valider_tva(){

	var form = document.getElementById('form_aff_conso');

	if(form.tva.value == '')
	{
		alert('- Vous devriez ajouter une tva.\n');
	}
	else
	{
		Modif_conso();
			
	}
	

}

function Modif_valider_qte_stock(){

	var form = document.getElementById('form_aff_conso');
	
	if(form.qte_stock.value == '')
	{
		alert('- La Qte stock doit etre renseigne.\n');
		form.qte_stock.value = form.conso_qte_stock.value;
	}
	else if(form.qte_stock.value.search(/^[0-9]+$/) == -1)
	{
		alert('- Le champ Qte stock contient des caracteres incorrect.\n');
		form.qte_stock.value = form.conso_qte_stock.value;
	}
	else
	{
		if(form.conso_qte_stock.value != form.qte_stock.value)
		{
			Modif_conso();
					
		}
	
	
	}


}

function Modif_valider_seuil_reap(){

	var form = document.getElementById('form_aff_conso');
	
	if(form.seuil_reap.value == '')
	{
		alert('- Le Seuil reappro doit etre renseigne.\n');
		form.seuil_reap.value = form.conso_seuil_reap.value;

	}
	else if(form.seuil_reap.value.search(/^[0-9]+$/) == -1)
	{
		alert('- Le champ Seuil reappro contient des caracteres incorrect.\n');
		form.seuil_reap.value = form.conso_seuil_reap.value;
	}
	else
	{
		if(form.conso_seuil_reap.value != form.seuil_reap.value)
		{
			Modif_conso();
					
		}
	
	
	}
	
	
	
}

function Modif_valider_type_conso(){

	var form = document.getElementById('form_aff_conso');

	if(form.type_conso.value == '')
	{
		alert('- Vous devriez ajouter un type conso.\n');
	}
	else
	{
		Modif_conso();
		
			
	}
	

}


function Modif_valider_commentaire(){

	Modif_conso();

}



function Changer_select_conso(){

	new Ajax.Request(
		'select_ref_des_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_type:document.getElementById("type_conso").value},
			onSuccess: function(http) {
				
				document.getElementById('zone_conso').innerHTML = http.responseText;
				
			}
		}
	);



}

function Changer_select_conso_saisie(){

	new Ajax.Request(
		'select_ref_des.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_type:document.getElementById("type_impr").value},
			onSuccess: function(http) {
				
				document.getElementById('zone_conso').innerHTML = http.responseText;
				
			}
		}
	);



}

function Associer_conso_saisie(){

	if(document.getElementById("impr").value != '')
	{
	
		new Ajax.Request(
			'associer_conso_saisie.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_impr:document.getElementById('impr').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
													
				}
			}
		);
	
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type.");
	}

}

function Retirer_ass_saisie(index){
		
			
	new Ajax.Request(
		'associer_conso_saisie.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ind:index},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					
													
			}
			
		}
	);

}

function Afficher_div_ajax_ref(){
	
	var ref = document.getElementById("reference");
	var div_ajax = document.getElementById('ajax_ref');

	if(ref.value != '')
	{
	
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					
					
					if(http.responseText != 'rien')
					{
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";
						//alert(http.responseText);
					}
					else
					{
						div_ajax.style.visibility = "hidden";
					
					}
									
				}
			}
		);
		
	}
	else
	{
		div_ajax.style.visibility = "hidden";
	}
	
	

	document.getElementById('b_ref').value = "non";

}

function Sur_div_ajax(id){

	var div = document.getElementById(id);
	
	div.style.backgroundColor = "#000066";
	div.style.color = "white";

}

function Sortie_div_ajax(id){

	var div = document.getElementById(id);
	
	div.style.backgroundColor = "salmon";
	div.style.color = "black";

}

function Clic_div_ajax(id){

	var div = document.getElementById(id);
	
	var str = div.childNodes[0].nodeValue;
	var ref = str.substring(0, str.indexOf(" "));
	var des = str.substring(str.indexOf(" ")+3, str.length);
	document.getElementById('reference').value = ref;
	document.getElementById('designation').value = des;
			
	document.getElementById('b_ref').value = "oui";
	
	

}

function Afficher_div_ajax_des(){

	var des = document.getElementById("designation");
	var div_ajax = document.getElementById('ajax_des');

	if(des.value != '')
	{
	
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					
					
					if(http.responseText != 'rien')
					{
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";
						//alert(http.responseText);
					}
					else
					{
						div_ajax.style.visibility = "hidden";
					
					}
									
				}
			}
		);
		
	}
	else
	{
		div_ajax.style.visibility = "hidden";
	}

	document.getElementById('b_ref').value = "non";

}

function Cache_div_ajax(id){

	document.getElementById(id).style.visibility = "hidden";

}

function Ajouter_conso_eff_dem_select(){

	if(document.getElementById("conso1").value != '')
	{
		new Ajax.Request(
			'eff_dem_liste_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('conso1').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetDem();
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type");
	}
	

}

function Cacher_div_ajax(){

	//document.getElementById('ajax_ref').style.visibility = "hidden";
	//document.getElementById('ajax_des').style.visibility = "hidden";
	

}

function Ajouter_conso_eff_dem_liste(){

	if(document.getElementById('b_ref').value == "oui")
	{
		new Ajax.Request(
			'eff_dem_liste_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('reference').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetDem();
													
				}
			}
		);
	}
	else
	{
		alert('Vous devez commencer a taper les premiere lettre de la reference,\n ou de la	designation du consommable puis le selectionner obligatoirement dans la liste qui apparaitra');
		
	}

}

function Ajouter_conso_eff_dem_impr(){

	if(document.getElementById("conso_impr").value != '')
	{
		new Ajax.Request(
			'eff_dem_liste_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('conso_impr').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetDem();
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à cette imprimante");
	}
	

}


function Retirer_conso(index){
		
			
	new Ajax.Request(
		'eff_dem_liste_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ind:index},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
				initializeConsoDropTarget();
													
			}
			
		}
	);

}

function Valider_quantite(ind){

	var qte = document.getElementById('qte_' + ind);
	
	if(isNaN(qte.value))
	{
		alert('la quantite doit etre un nombre');
		document.getElementById('val_dem').value = "non";
		new Ajax.Request(
			'eff_dem_liste_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax'},
				onSuccess:function(http){
				
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTargetDem();
								
				}
								
			}
		);
			
	}
	else
	{
		new Ajax.Request(
			'eff_dem_liste_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', maj_qte:qte.value, i:ind}
								
			}
		);
	
	
	}


}

var fen_demande;
function Valider_demande(){

	if(confirm('Voulez-vous valider votre demande ?'))
	{
		fen_demande = new Ext.Window({
					title    : 'Gestion des consommables',
					closable : false,
					width    : 330,
					height   : 130,
					resizable:false,
					modal:true,
					plain    : true,
					layout   : 'anchor',
					html:'<div class="boite_mess_val"><center>Validation de la demande en cours</center><img src="Image/wait.gif" alt="Validation de la demande en cours" /></div>'
							
					
				});
				
		fen_demande.show();
				
				
		setTimeout(function(){
						new Ajax.Request(
							'eff_dem_liste_conso.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', validation:'valider'},
								onSuccess: function(http) {
										
									document.getElementById('zone_liste_conso').innerHTML = http.responseText;
										
									fen_demande.body.dom.innerHTML = "<center>Validation reussie de la demande</center>";
									
									setTimeout(function(){
													fen_demande.close();
											   
											   },
											   1000);
									
																		
								},
								
								onFailure: function(){
								
									fen_demande.body.dom.innerHTML = "<center>Echec de la validation</center>";
									setTimeout(function(){
													fen_demande.close();
											   
											   },
											   2000);
								
								}
								
							}
						);
				
				  },
				  500);
				  
							
		
	
	}

}


function Valider_form_date_etat(){

	var form = document.getElementById('form_date_dem');
	var valide = true;
	var str = '';
	
	if(form.date_dem.value == '')
	{
		valide = false;
		str += '- Le champ date est vide.\n';
	}
	else if(form.date_dem.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date_dem.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La date est invalide.\n";
		}
	
	}
	
		
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			alert('bissextile');
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
		
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
				
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Associer_conso_modif(num_c){

	if(document.getElementById("impr").value != '')
	{
	
		new Ajax.Request(
			'associer_conso_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', num_conso:num_c, ass_conso:document.getElementById('impr').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type.");
	}

}

function Retirer_ass_modif(num_c, supp_c){
		
			
	new Ajax.Request(
		'associer_conso_modif.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', num_conso:num_c, supp_ass_conso:supp_c},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					
													
			}
			
		}
	);

}

function Calcul_prix_unitaire_prix_tot(){

	var prix_tot = document.getElementById('prix_tot');
	if(!isNaN(prix_tot.value))
	{
		Calcul_prix_unitaire();
	}
	else
	{
		alert('Le prix total doit etre un nombre');
	}

}

function Calcul_prix_unitaire(){

	var pu = document.getElementById('pu');
	var c_pu = document.getElementById('c_pu');
	var prix_tot = document.getElementById('prix_tot');
	var lot = document.getElementById('lot');
	
	if(prix_tot.value != '')
	{
		var p_tot = parseFloat(prix_tot.value);
		var l = parseInt(lot.value);
		 
		pu.value = (p_tot / l).toFixed(2);
		c_pu.innerHTML = (p_tot / l).toFixed(2);
		c_pu.innerHTML += "&#8364;";
		
		
	}
	
}

function Calcul_prix_unitaire_prix_tot_modif(){

	var prix_tot = document.getElementById('prix_tot');
	var form = document.getElementById('form_aff_conso');
	
	if(!isNaN(prix_tot.value))
	{
		if(form.conso_prix_tot.value != form.prix_tot.value)
		{
			Calcul_prix_unitaire_modif();
					
		}
	}
	else
	{
		alert('Le prix total doit etre un nombre');
		form.prix_tot.value = form.conso_prix_tot.value;
	}

}

function Calcul_prix_unitaire_modif(){

	var pu = document.getElementById('pu');
	var c_pu = document.getElementById('c_pu');
	var prix_tot = document.getElementById('prix_tot');
	var lot = document.getElementById('lot');
	var form = document.getElementById('form_aff_conso');
	
	if(prix_tot.value != '')
	{
		var p_tot = parseFloat(prix_tot.value);
		var l = parseInt(lot.value);
		
		pu.value = p_tot / l;
		c_pu.innerHTML = (p_tot / l).toFixed(2);
		c_pu.innerHTML += "&#8364;";
		
		Modif_conso();
		
	}
	
}

function Changer_select_conso_impr(){

	new Ajax.Request(
		'select_conso_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ref_impr:document.getElementById("impr").value},
			onSuccess: function(http) {
				
				document.getElementById('zone_conso_impr').innerHTML = http.responseText;
				
			}
		}
	);



}

function Changer_select_service(){

	new Ajax.Request(
		'select_service.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_division:document.getElementById("division").value},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_sel_service').innerHTML = http.responseText;
				
			}
		}
	);



}

function Changer_select_service_impr(){

	new Ajax.Request(
		'select_service_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_division:document.getElementById("division").value},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_sel_service').innerHTML = http.responseText;
				
			}
		}
	);



}


function Traiter_demande(num_dem){

	var traiter = false;
	var max = document.getElementById('nb_conso').value;
	for(var i = 0;i < max;i++)
	{
		var donner = document.getElementById('donner_' + i).value;
		var retirer = document.getElementById('retirer_' + i).value;
		if((donner != 0) || (retirer != 0))
		{
			traiter = true;
		}
		
	}
	
	if(traiter)
	{
	
		if(confirm('Voulez vous traiter cette demande ?'))
		{
			
			var fen_demande = new Ext.Window({
				title    : 'Gestion des consommables',
				closable : false,
				width    : 330,
				height   : 130,
				resizable:false,
				modal:true,
				plain    : true,
				layout   : 'anchor',
				html:'<div class="boite_mess_val"><center>Traitement de la demande en cours</center><img src="Image/wait.gif" alt="Validation de la demande en cours" /></div>'
						
				
			});
			
			fen_demande.show();
			
			/*var traiter_bout = document.getElementById('traiter_bout');
			traiter_bout.style.visibility = 'hidden';*/
			
			var etat_dem = document.getElementById('etat_dem');
				
			setTimeout(function(){
			
							new Ajax.Request(
								'traiter_demande_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', num_demande:num_dem},
									onSuccess: function(http) {
										
										if(http.responseText == 'demande traiter')
											etat_dem.innerHTML = 'traitée';
										else
										{
											etat_dem.innerHTML = 'incomplet';
												
											new Ajax.Request(
												'demande_incomplete.php',
												{
													method: 'post',
													parameters: {ajax:'ajax', num_demande:num_dem},
													onSuccess: function(http) {
														
														document.getElementById('zone_demande_incomplete').innerHTML = http.responseText;
																										
													}
												}
											);
											
										}
										
										//alert(http.responseText);
										
										fen_demande.body.dom.innerHTML = '<div class="boite_mess_val"><center>' + http.responseText + '</center></div>';
										
										setTimeout(function(){
														
														fen_demande.close();
														document.getElementById('form_raff').submit();
													},
													2000);
										
									},
									onFailure: function(){
									
										fen_demande.body.dom.innerHTML = '<div class="boite_mess_val"><center>Echec du traitement</center></div>';
										
										setTimeout(function(){
														traiter_bout.style.visibility = 'visible';
														fen_demande.close();
														document.getElementById('form_raff').submit();
													},
													5000);
									
									}
								}
							);
						},
						1000);
		
		
		}
		
	}
	else
	{
		alert('Vous devez choisir de donner ou de retirer un nombre de consommable pour pouvoir traiter la demande.');
	
	}

}


function Souligne(id){
	
	document.getElementById(id).style.textDecoration = 'underline';	
	document.getElementById(id).style.cursor = 'pointer';
	
}

function DeSouligne(id){
	
	document.getElementById(id).style.textDecoration = 'none';	
	
}

function Fenetre_imprimer_conso(page){
	
	var impr_conso = window.open(page, 'Imprimer_conso', 'width=800, height=800, resizable=1, scrollbars=1, location=0, status=0, menubar=1, directories=0');
	impr_conso.moveTo(0, 0);
	
	
}

function Fenetre_imprimer_conso_ind(page){
	
	var impr_conso_ind = window.open(page, 'Imprimer_conso_ind', 'width=640, height=700, resizable=1, scrollbars=1, location=0, status=0, menubar=1, directories=0');
	impr_conso_ind.moveTo(0, 0);
	
	
}

function Suivi_conso_division(){

	var form = document.getElementById('form_per_suivi');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseInt(d[0]), parseInt(d[1]), parseInt(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{
		
		new Ajax.Request(
			'suivi_conso_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', division:document.getElementById("division").value, choix_div:document.getElementById("choix_div").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('suivi_conso').innerHTML = http.responseText;
					
				}
			}
		);
	
	}
	else
	{
		alert(str);
	
	}



}

function Suivi_conso_service(){

	var form = document.getElementById('form_per_suivi');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{

		new Ajax.Request(
			'suivi_conso_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', service:document.getElementById("service").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('suivi_conso').innerHTML = http.responseText;
					
				}
			}
		);
		
	}
	else
	{
		alert(str);
	
	}



}



function Valider_form_ajout_impr(){

	var form = document.getElementById('form_ajout_impr');
	var valide = true;
	var str = '';

	if(form.type_impr.value == '')
	{
		valide = false;
		str = "- Vous devriez ajouter un type d'imprimante\n";
	}
	
	if(form.marque.value == '')
	{
		valide = false;
		str += "- Vous devriez ajouter une marque d'imprimante\n";
	}
	
	if(form.reference.value == '')
	{
		valide = false;
		str += '- La reference est vide.\n';
	}
	else if(form.reference.value.search(/^[A-Z0-9\-]+$/) == -1)
	{
		valide = false;
		str += "- Le champ reference est incorrect(Lettre en majuscule)\n";
	
	}
	else
	{
		//requete synchrone 
		new Ajax.Request(
			'test_ref_impr_saisir.php',
			{
				asynchronous:false,
				method: 'post',
				parameters: {ajax:'ajax', ref_impr:form.reference.value},
				onSuccess: function(http) {
					
					if(http.responseText == 'pris')
					{
						valide = false;
						str += "- La reference est deja prise\n";
					}
					
				},
				
				onFailure: function(http) {
					
					valide = false;
					str += "- Erreur reference\n";
									
				}
			}
		);
	
	}
	
	if(form.designation.value == '')
	{
		valide = false;
		str += "- Le champ designation est vide\n";
	
	}
	
		
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Associer_impr_saisie(){
	
	if(document.getElementById("service").value != '')
	{
	
		new Ajax.Request(
			'associer_impr_saisie.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', id_service:document.getElementById('service').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_impr').innerHTML = http.responseText;
					//alert(http.responseText);
													
				}
			}
		);
	
	}
	else
	{
		alert("Il n'y a aucun service pour cette division.");
	}
	
	
	
	
}

function Retirer_ass_service(index){
		
			
	new Ajax.Request(
		'associer_impr_saisie.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ind:index},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_impr').innerHTML = http.responseText;
					
													
			}
			
		}
	);

}


function Valider_annee(ind){

	var annee = document.getElementById('annee_' + ind);
	
	if(annee.value.search(/^[0-9][0-9][0-9][0-9]$/) == -1)
	{
		alert("L'annee est incorrect");
		var d = new Date();
		annee.value = d.getFullYear();
					
	}
	else
	{
		new Ajax.Request(
			'associer_impr_saisie.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', maj_annee:annee.value, i:ind}
								
			}
		);
	
	
	}


}


function Fenetre_type_impr(page){
	
	var type_impr = window.open(page, 'Type_impr', 'width=580, height=220, resizable=1, scrollbars=1, location=0, status=0, menubar=0, directories=0');
	type_impr.moveTo(0, 0);
	
	
}


function Valider_form_ajout_type_impr(){

	var form = document.getElementById('form_ajout_type_impr');
	var valide = true;
	var str = '';
	
	if(form.lib_type_impr.value == '')
	{
		valide = false;
		str += '- Le libelle de type imprimante est vide.\n';
	}
		
	if(!valide)
		alert(str);
		
	return valide;
	
}

function Valider_form_ajout_marque_impr(){

	var form = document.getElementById('form_ajout_marque_impr');
	var valide = true;
	var str = '';
	
	if(form.marque.value == '')
	{
		valide = false;
		str += '- Le libelle marque est vide.\n';
	}
		
	if(!valide)
		alert(str);
		
	return valide;
	
}


function Associer_impr_modif(){
	
	if(document.getElementById("service").value != '')
	{
	
		new Ajax.Request(
			'associer_impr_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_impr:document.getElementById('ref').value, id_service:document.getElementById('service').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_impr').innerHTML = http.responseText;
																		
				}
			}
		);
	
	}
	else
	{
		alert("Il n'y a aucun service pour cette division.");
	}
	
	
	
	
}

function Retirer_ass_service_modif(index){
		
			
	new Ajax.Request(
		'associer_impr_modif.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', suppr_impr:index, ref_impr:document.getElementById('ref').value},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_impr').innerHTML = http.responseText;
					
													
			}
			
		}
	);

}


function Valider_annee_modif(ind, id){

	var annee = document.getElementById('annee_' + ind);
	var h_annee = document.getElementById('h_annee_' + ind);
	
	if(annee.value.search(/^[0-9][0-9][0-9][0-9]$/) == -1)
	{
		alert("L'annee est incorrect");
		annee.value = h_annee.value;
					
	}
	else
	{
		new Ajax.Request(
			'associer_impr_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', maj_annee:annee.value, id_impr:id}
								
			}
		);
	
		h_annee.value = annee.value;
	
	}


}


function Valider_reference_imprimante(){

	var form = document.getElementById('form_modif_impr');

	if(form.reference.value == '')
	{
		alert('- La reference est vide.');
		form.reference.value = form.hid_ref.value;
	}
	else if(form.reference.value.search(/^[A-Z0-9\-]+$/) == -1)
	{
		alert("- Le champ reference est incorrect(Lettre en majuscule)");
		form.reference.value = form.hid_ref.value;
	
	}
	else
	{
		if(form.hid_ref.value != form.reference.value)
		{
			new Ajax.Request(
				'test_ref_impr_modif.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ref_impr:form.hid_ref.value, nouv_ref:form.reference.value},
					onSuccess: function(http) {
						
						var rep = eval('(' + http.responseText +')');
						if(rep.res == 'pris')
						{
							alert("- La reference est deja prise");
							form.reference.value = form.hid_ref.value;
						}
						else if(rep.res == 'impossible')
						{
							alert("Impossible de modifier la reference de l'imprimante,\n car elle est associé a des services.");
							form.reference.value = form.hid_ref.value;
						
						}
						else
						{
							
							new Ajax.Request(
								'modif_impr.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
									onSuccess:function(http){
									
										form.hid_ref.value = form.reference.value;
									
									},
					
									onFailure: function(http) {
										
										alert("- Erreur lors de l'enregistrement");
										form.reference.value = form.hid_ref.value;
														
									}	
									
								}
														
							);
							
							
						
						
						
						}
						
					},
					
					onFailure: function(http) {
						
						alert("- Erreur reference");
						form.reference.value = form.hid_ref.value;
										
					}
				}
			);
		
		}
	
	}


}


function Valider_designation_imprimante(){

	var form = document.getElementById('form_modif_impr');

	if(form.designation.value == '')
	{
		alert("- Le champ designation est vide");
		form.designation.value = form.hid_des.value;
	
	}
	else
	{
		if(form.designation.value != form.hid_des.value)
		{
			new Ajax.Request(
				'modif_impr.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
					onSuccess:function(http){
					
						form.hid_des.value = form.designation.value;
					
					},
					
					onFailure: function(http) {
						
						alert("- Erreur lors de l'enregistrement");
						form.designation.value = form.hid_des.value;
										
					}
					
				}
										
			);
		
		}
	
	
	}

}


function Valider_marque_imprimante(){

	var form = document.getElementById('form_modif_impr');
		
	new Ajax.Request(
		'modif_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
			onSuccess:function(http){
			
				form.hid_marque.value = form.marque.selectedIndex;
			
			},
			
			onFailure: function(http) {
				
				alert("- Erreur lors de l'enregistrement");
				form.marque.selectedIndex = form.hid_marque.value;
								
			}
			
		}
								
	);
	
}

function Valider_marque_imprimante_fen(){

	var form = opener.document.getElementById('form_modif_impr');
		
	new Ajax.Request(
		'modif_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
			onSuccess:function(http){
			
				form.hid_marque.value = form.marque.selectedIndex;
			
			},
			
			onFailure: function(http) {
				
				alert("- Erreur lors de l'enregistrement");
				form.marque.selectedIndex = form.hid_marque.value;
								
			}
			
		}
								
	);
	
}

function Valider_type_imprimante(){

	var form = document.getElementById('form_modif_impr');
		
	new Ajax.Request(
		'modif_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
			onSuccess:function(http){
			
				form.hid_type_impr.value = form.type_impr.selectedIndex;
			
			},
			
			onFailure: function(http) {
				
				alert("- Erreur lors de l'enregistrement");
				form.type_impr.selectedIndex = form.hid_type_impr.value;
								
			}
			
		}
								
	);
	
}

function Valider_type_imprimante_fen(){

	var form = opener.document.getElementById('form_modif_impr');
		
	new Ajax.Request(
		'modif_impr.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', a_ref_impr:form.hid_ref.value, ref_impr:form.reference.value, des_impr:form.designation.value, marque_impr:form.marque.value, type_impr:form.type_impr.value},
			onSuccess:function(http){
			
				form.hid_type_impr.value = form.type_impr.selectedIndex;
			
			},
			
			onFailure: function(http) {
				
				alert("- Erreur lors de l'enregistrement");
				form.type_impr.selectedIndex = form.hid_type_impr.value;
								
			}
			
		}
								
	);
	
}


function Supprimer_imprimante(){

	if(confirm('Voulez-vous supprimer cette imprimante?'))
	{

		var fen_suppr = new Ext.Window({
			title    : 'Gestion des consommables',
			closable : false,
			width    : 330,
			height   : 130,
			resizable:false,
			modal:true,
			plain    : true,
			layout   : 'anchor',
			html:'<div class="boite_mess_val"><center>Suppression en cours<img src="Image/wait.gif" alt="attente de la suppression" /></center></div>'
					
			
		});
				
		fen_suppr.show();
		
		setTimeout(function(){
					new Ajax.Request(
						'suppr_imprimante.php',
						{
							method: 'post',
							parameters: {ajax:'ajax', ref_impr:document.getElementById('hid_ref').value},
							onSuccess:function(http){
							
								var rep = eval('(' + http.responseText +')');
								if(rep.res == 'supprimer')
								{
									fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression reussie</center></div>';
									
									setTimeout(function(){
													document.getElementById('form_retour').submit();
												},
												1000);
											
								}
								else if(rep.res == 'impossible')
								{
									var str = '<div class="boite_mess_val"><center>La suppression est impossible :</center>';
									str += "<center><ul><li>L'imprimante est associe a un ou plusieurs service</li></ul></center></div>";
									fen_suppr.body.dom.innerHTML = str;
									
									setTimeout(function(){
													fen_suppr.close();
												},
												5000);
								
								}
								
								
								
							
							},
							
							onFailure: function(http) {
								
								fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Erreur lors de la suppression</center></div>';
								setTimeout(function(){
													fen_suppr.close();
												},
												5000);
								
												
							}
							
						}
												
					);
					},
					1000);


	}


}

function Ajouter_conso_type_commande(){

	if(document.getElementById("conso1").value != '')
	{
		new Ajax.Request(
			'conso_commande.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('conso1').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTarget();
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type");
	}
	

}

function Retirer_conso_commande(index){
		
			
	new Ajax.Request(
		'conso_commande.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ind:index},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
				initializeConsoDropTarget();
													
			}
			
		}
	);

}


function Valider_quantite_com(ind){

	var qte = document.getElementById('qte_' + ind);
	
	if(isNaN(qte.value))
	{
		alert('la quantite doit etre un nombre');
		new Ajax.Request(
			'conso_commande.php',
			{
				method: 'post',
				parameters: {ajax:'ajax'},
				onSuccess:function(http){
				
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTarget();
								
				}
								
			}
		);
		
					
	}
	else
	{
		new Ajax.Request(
			'conso_commande.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', maj_qte:qte.value, i:ind},
				onSuccess:function(http){
				
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTarget();
								
				}
								
			}
		);
	
	
	}


}

function Ajouter_conso_ref_des_comm(){

	if(document.getElementById('b_ref').value == "oui")
	{
		new Ajax.Request(
			'conso_commande.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('reference').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTarget();
													
				}
			}
		);
	}
	else
	{
		alert('Vous devez commencer a taper les premiere lettre de la reference, ou de la designation du consommable\n puis le selectionner dans la fenetre qui apparaitra et cliquez sur le bouton Ajouter le consommable,\n ou cliquez sur le consommable de la fenetre et faire glisser le consommable sur le tableau\n contenant les consommables choisies');
		
	}

}


var fen_commande;
function Valider_commande(){

	if(confirm('Voulez-vous valider votre commande ?'))
	{
		
		var num_com = document.getElementById('num_com');
		var date_com = document.getElementById('date_com');
		
		if((num_com.value != '') && (date_com.value != ''))
		{
			var val = true;
			new Ajax.Request(
				'test_num_commande.php',
				{
					asynchronous:false,
					method: 'post',
					parameters: {ajax:'ajax', num_com:num_com.value},
					
					onSuccess : function(http){
						
						if(http.responseText == 'pris')
						{
							val = false;
							alert('Le numero de comande est deja pris.');	
						}
						
					},
					
					onFailure : function(http){
						
						alert('Erreur lors de la validation de la commande');	
						val = false;
												
					}
									
				}
			);
			
			if(val)
			{
			
				fen_commande = new Ext.Window({
					title    : 'Gestion des consommables',
					closable : false,
					width    : 330,
					height   : 130,
					resizable:false,
					modal:true,
					plain    : true,
					layout   : 'anchor',
					html:'<div class="boite_mess_val"><center>Validation de la commande en cours</center><img src="Image/wait.gif" alt="Validation de la demande en cours" /></div>'
							
					
				});
				
				fen_commande.show();
							
			
				setTimeout(function(){
								new Ajax.Request(
									'conso_commande.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', num_com:document.getElementById('num_com').value, date_com:document.getElementById('date_com').value},
										onSuccess: function(http) {
												
											document.getElementById('zone_liste_conso').innerHTML = http.responseText;
											
											fen_commande.body.dom.innerHTML = '<div class="boite_mess_val"><center>Validation reussie de la demande</center></div>';
																					
											setTimeout(function(){
															fen_commande.close();
													   
													   },
													   1000);
											
																				
										},
										
										onFailure: function(){
										
											fen_commande.body.dom.innerHTML = '<div class="boite_mess_val"><center>Echec de la validation</center></div>';
											setTimeout(function(){
															fen_commande.close();
													   
													   },
													   2000);
										
										}
										
									}
								);
						
						  },
						  500);
				
			}
				  
				
				
		}
		else
		{
			var str = '';var val = true;
			if(num_com.value == '')
			{
				str = '-Entrez un numero de commande valide\n';
				val = false;
			}
				
			if(date_com.value == '')
			{
				str += '-Entrez une date de commande valide\n';
				val = false;
			}
			
			if(!val)
				alert(str);
		
			
		
		}
		
	
	}

}

var show = false;
var fen_conso;
function Afficher_fen_conso(){
	
	var ref = document.getElementById("reference");
	
	if(ref.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show)
							fen_conso.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
						
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
										
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								  
								  	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax({i});" onmouseout="Sortie_div_ajax({i});" onclick="Clic_div_ajax({i});" id="{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_com') != 'undefined') && (document.getElementById('id_tab_com') != null) )
							initializeConsoDropTarget();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso.show();
						fen_conso.setPosition(100, 350);
						show = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show)
							fen_conso.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show)
			fen_conso.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}




function initializeConsoDragZone(v) {
    v.dragZone = new Ext.dd.DragZone(v.getEl(), {

//      On receipt of a mousedown event, see if it is within a draggable element.
//      Return a drag data object if so. The data object can contain arbitrary application
//      data, but it should also contain a DOM element in the ddel property to provide
//      a proxy to drag.
        getDragData: function(e) {
            var sourceEl = e.getTarget(v.itemSelector, 10);
            if (sourceEl) {
                d = sourceEl.cloneNode(true);
                d.id = Ext.id();
                return v.dragData = {
                    sourceEl: sourceEl,
                    repairXY: Ext.fly(sourceEl).getXY(),
                    ddel: d,
                    consoData: v.getRecord(sourceEl).data,
					st_enter: false
                }
            }
        },

//      Provide coordinates for the proxy to slide back to on failed drag.
//      This is the original XY coordinates of the draggable element.
        getRepairXY: function() {
            return this.dragData.repairXY;
        }
    });
}


function initializeConsoDropTarget(){

	new Ext.dd.DropTarget(Ext.get('id_tab_com'), {
		
		notifyEnter : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_com')).addClass('tab_commande_h');
			
		},
		
		notifyOut : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_com')).removeClass('tab_commande_h');
			
			
		},
		
		notifyDrop : function(ddSource, e, data){
			
			Ext.fly(Ext.get('id_tab_com')).removeClass('tab_commande_h');
			
			new Ajax.Request(
				'conso_commande.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ref_conso:data.consoData.ref},
					onSuccess: function(http) {
						
						document.getElementById('zone_liste_conso').innerHTML = http.responseText;
						//alert(http.responseText);
						//initializeConsoDropZone();
						initializeConsoDropTarget();
														
					},
					
					onFailure : function(){
						
						alert("Erreur lors de l'ajout du consommable");
						
					}
					
				}
			);
			
			return(true);
		}
	}); 


}



var show_d = false;
var fen_conso_des;
function Afficher_fen_conso_des(){
	
	var des = document.getElementById("designation");
	

	if(des.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_d)
							fen_conso_des.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
			
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
												
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								   	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax(' + "'des_" + "{i}'" + ');" onmouseout="Sortie_div_ajax(' + "'des_" + "{i}'" + ');" onclick="Clic_div_ajax(' + "'des_" + "{i}'" + ');" id="des_{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_com') != 'undefined') && (document.getElementById('id_tab_com') != null) )
							initializeConsoDropTarget();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_des = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_d=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_des.show();
						fen_conso_des.setPosition(300, 350);
						show_d = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_d)
							fen_conso_des.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_d)
			fen_conso_des.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}



var show_r_dem = false;
var fen_conso_r_dem;
function Afficher_fen_conso_dem(){
	
	var ref = document.getElementById("reference");
	
	if(ref.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_r_dem)
							fen_conso_r_dem.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
						
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
						
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								  
								  	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax({i});" onmouseout="Sortie_div_ajax({i});" onclick="Clic_div_ajax({i});" id="{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_dem') != 'undefined') && (document.getElementById('id_tab_dem') != null) )
						{
							initializeConsoDropTargetDem();
							
						}
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_r_dem = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_r_dem.show();
						fen_conso_r_dem.setPosition(100, 350);
						show_r_dem = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_r_dem)
							fen_conso_r_dem.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_r_dem)
			fen_conso_r_dem.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
}



function initializeConsoDropTargetDem(){

	new Ext.dd.DropTarget(Ext.get('id_tab_dem'), {
		
		notifyEnter : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_dem')).addClass('tab_bleu_575_h');
			
		},
		
		notifyOut : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_dem')).removeClass('tab_bleu_575_h');
			
			
		},
		
		notifyDrop : function(ddSource, e, data){
			
			Ext.fly(Ext.get('id_tab_dem')).removeClass('tab_bleu_575_h');
			
			new Ajax.Request(
				'eff_dem_liste_conso.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ref_conso:data.consoData.ref},
					onSuccess: function(http) {
						
						document.getElementById('zone_liste_conso').innerHTML = http.responseText;
						//alert(http.responseText);
						//initializeConsoDropZone();
						initializeConsoDropTargetDem();
														
					},
					
					onFailure : function(){
						
						alert("Erreur lors de l'ajout du consommable");
						
					}
					
				}
			);
			
			return(true);
		}
	}); 


}



var show_d_dem = false;
var fen_conso_des_dem;
function Afficher_fen_conso_des_dem(){
	
	var des = document.getElementById("designation");
	

	if(des.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_d_dem)
							fen_conso_des_dem.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
			
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
												
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								   	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax(' + "'des_" + "{i}'" + ');" onmouseout="Sortie_div_ajax(' + "'des_" + "{i}'" + ');" onclick="Clic_div_ajax(' + "'des_" + "{i}'" + ');" id="des_{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_dem') != 'undefined') && (document.getElementById('id_tab_dem') != null) )
							initializeConsoDropTargetDem();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_des_dem = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_d=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_des_dem.show();
						fen_conso_des_dem.setPosition(300, 350);
						show_d_dem = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_d_dem)
							fen_conso_des_dem.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_d_dem)
			fen_conso_des_dem.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}


function Valider_form_date_com(){

	var form = document.getElementById('form_date_com');
	var valide = true;
	var str = '';
	
	if(form.date_com.value == '')
	{
		valide = false;
		str += '- Le champ date est vide.\n';
	}
	else if(form.date_com.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date_com.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La date est invalide.\n";
		}
	
	}
	
		
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
		
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
				
	if(!valide)
		alert(str);
		
	return valide;
	
}


var show_m = false;
var fen_conso_m;
function Afficher_fen_conso_modif(){
	
	var ref = document.getElementById("reference");
	
	if(ref.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_m)
							fen_conso.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
						
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
										
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								  
								  	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax({i});" onmouseout="Sortie_div_ajax({i});" onclick="Clic_div_ajax({i});" id="{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_com') != 'undefined') && (document.getElementById('id_tab_com') != null) )
							initializeConsoDropTargetModif();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_m = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_m=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_m.show();
						fen_conso_m.setPosition(100, 350);
						show_m = true;
						
					}
					else
					{
						if(show_m)
							fen_conso_m.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_m)
			fen_conso_m.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}



function initializeConsoDropTargetModif(){

	new Ext.dd.DropTarget(Ext.get('id_tab_com'), {
		
		notifyEnter : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_com')).addClass('tab_commande_h');
			
		},
		
		notifyOut : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_com')).removeClass('tab_commande_h');
			
			
		},
		
		notifyDrop : function(ddSource, e, data){
			
			Ext.fly(Ext.get('id_tab_com')).removeClass('tab_commande_h');
			
			new Ajax.Request(
				'conso_commande_modif.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ajout:'ajout', ref_conso:data.consoData.ref, num_com:document.getElementById('num_comh').value},
					onSuccess: function(http) {
						
						document.getElementById('zone_liste_conso').innerHTML = http.responseText;
						initializeConsoDropTargetModif();
														
					},
					
					onFailure : function(){
						
						alert("Erreur lors de l'ajout du consommable");
						
					}
					
				}
			);
			
			return(true);
		}
	}); 


}



function Valider_quantite_com_modif(i, num_com, ref_conso){

	var qte = document.getElementById('qte_' + i).value;
		
	if(isNaN(qte))
	{
		alert('la quantite doit etre un nombre');
		new Ajax.Request(
			'conso_commande_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', num_com:num_com},
				onSuccess:function(http){
				
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTargetModif();
								
				}
								
			}
		);
		
					
	}
	else
	{
		new Ajax.Request(
			'conso_commande_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', maj_qte:qte, num_com:num_com, ref_conso:ref_conso},
				onSuccess:function(http){
				
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTargetModif();
								
				}
								
			}
		);
	
	
	}


}


function Retirer_conso_commande_modif(num_com, ref_conso){
		
	if(confirm('Voulez-vous vraiment supprimer ce consommable de cette commande ?'))
	{
			
		new Ajax.Request(
			'conso_commande_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', suppr:'supprimer', num_com:num_com, ref_conso:ref_conso},
				onSuccess: function(http) {
						
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTargetModif();
														
				}
				
			}
		);
	
	}

}


function Ajouter_conso_type_commande_modif(){

	if(document.getElementById("conso1").value != '')
	{
		new Ajax.Request(
			'conso_commande_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ajout:'ajout', ref_conso:document.getElementById('conso1').value, num_com:document.getElementById('num_com').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetModif();
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type");
	}
	

}


function Ajouter_conso_ref_des_comm_modif(){

	if(document.getElementById('b_ref').value == "oui")
	{
		new Ajax.Request(
			'conso_commande_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ajout:'ajout', ref_conso:document.getElementById('reference').value, num_com:document.getElementById('num_com').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetModif();
													
				}
			}
		);
	}
	else
	{
		alert('Vous devez commencer a taper les premiere lettre de la reference, ou de la designation du consommable\n puis le selectionner dans la fenetre qui apparaitra et cliquez sur le bouton Ajouter le consommable,\n ou cliquez sur le consommable de la fenetre et faire glisser le consommable sur le tableau\n contenant les consommables choisies');
		
	}

}


var show_d_m = false;
var fen_conso_des_m;
function Afficher_fen_conso_des_modif(){
	
	var des = document.getElementById("designation");
	

	if(des.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_d_m)
							fen_conso_des_m.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
			
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
												
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								   	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax(' + "'des_" + "{i}'" + ');" onmouseout="Sortie_div_ajax(' + "'des_" + "{i}'" + ');" onclick="Clic_div_ajax(' + "'des_" + "{i}'" + ');" id="des_{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_com') != 'undefined') && (document.getElementById('id_tab_com') != null) )
							initializeConsoDropTargetModif();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_des_m = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_d_m=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_des_m.show();
						fen_conso_des_m.setPosition(300, 350);
						show_d_m = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_d_m)
							fen_conso_des_m.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_d_m)
			fen_conso_des_m.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}


function Supprimer_commande(){

	if(confirm('Voulez-vous supprimer cette commande ?'))
	{
	
		var fen_suppr = new Ext.Window({
			title    : 'Gestion des consommables',
			closable : false,
			width    : 330,
			height   : 130,
			resizable:false,
			modal:true,
			plain    : true,
			layout   : 'anchor',
			html:'<div class="boite_mess_val"><center>Suppression en cours<img src="Image/wait.gif" alt="attente de la suppression" /></center></div>'
					
			
		});
				
		fen_suppr.show();
	
		setTimeout(function(){
						new Ajax.Request(
							'suppr_commande.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', num_com:document.getElementById('num_comh').value},
								onSuccess: function(http) {
									//alert(http.responseText);
									var rep = eval('(' + http.responseText + ')');
									if(rep.res == 'impossible')
									{
										
										var str = '<div class="boite_mess_val"><center>Suppression impossible :</center>';
										str += '<ul><li>car cette commande correspond a une livraison</li></ul></div>';
										fen_suppr.body.dom.innerHTML = str;
										
										setTimeout(function(){
													fen_suppr.close();
												},5000);
									
									}
									else if(rep.res == 'reussi')
									{
										fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression reussie</div>';
									
										setTimeout(function(){
														document.getElementById('form_retour').submit();
													},1000);
														
									}
								
									
																												
								},
								onFailure: function(){
								
									fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression echoue</div>';
									setTimeout(function(){
													fen_suppr.close();
												},5000);
									
								}
							}
						);
					},1000);
	
	}



}



function Ajouter_conso_commande_livr(){

	if(document.getElementById("conso1").value != '')
	{
		new Ajax.Request(
			'conso_livraison.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('conso1').value, num_com:document.getElementById('num_com').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type");
	}
	

}



function Ajouter_conso_ref_des_comm_livr(){

	if(document.getElementById('b_ref').value == "oui")
	{
		new Ajax.Request(
			'conso_livraison.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ref_conso:document.getElementById('reference').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetLivr();
													
				}
			}
		);
	}
	else
	{
		alert('Vous devez commencer a taper les premiere lettre de la reference, ou de la designation du consommable\n puis le selectionner dans la fenetre qui apparaitra et cliquez sur le bouton Ajouter le consommable,\n ou cliquez sur le consommable de la fenetre et faire glisser le consommable sur le tableau\n contenant les consommables choisies');
		
	}

}



var show_l = false;
var fen_conso_l;
function Afficher_fen_conso_livr(){
	
	var ref = document.getElementById("reference");
	
	if(ref.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_l)
							fen_conso_l.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
						
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
										
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								  
								  	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax({i});" onmouseout="Sortie_div_ajax({i});" onclick="Clic_div_ajax({i});" id="{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_livr') != 'undefined') && (document.getElementById('id_tab_livr') != null) )
							initializeConsoDropTargetLivr();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_l = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_l=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_l.show();
						fen_conso_l.setPosition(100, 350);
						show_l = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_l)
							fen_conso_l.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_l)
			fen_conso_l.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
		
	
}



function initializeConsoDropTargetLivr(){

	new Ext.dd.DropTarget(Ext.get('id_tab_livr'), {
		
		notifyEnter : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_livr')).addClass('tab_commande_h');
			
		},
		
		notifyOut : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_livr')).removeClass('tab_commande_h');
			
			
		},
		
		notifyDrop : function(ddSource, e, data){
			
			Ext.fly(Ext.get('id_tab_livr')).removeClass('tab_commande_h');
			
			new Ajax.Request(
				'conso_livraison.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ref_conso:data.consoData.ref},
					onSuccess: function(http) {
						
						document.getElementById('zone_liste_conso').innerHTML = http.responseText;
						//alert(http.responseText);
						//initializeConsoDropZone();
						initializeConsoDropTargetLivr();
														
					},
					
					onFailure : function(){
						
						alert("Erreur lors de l'ajout du consommable");
						
					}
					
				}
			);
			
			return(true);
		}
	}); 


}




var show_d_l = false;
var fen_conso_des_l;
function Afficher_fen_conso_des_livr(){
	
	var des = document.getElementById("designation");
	

	if(des.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_d_l)
							fen_conso_des_l.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
			
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
												
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								   	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax(' + "'des_" + "{i}'" + ');" onmouseout="Sortie_div_ajax(' + "'des_" + "{i}'" + ');" onclick="Clic_div_ajax(' + "'des_" + "{i}'" + ');" id="des_{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_livr') != 'undefined') && (document.getElementById('id_tab_livr') != null) )
							initializeConsoDropTargetLivr();
						//initializeConsoDropZone();
						//initializeTabDragZone();
						
						fen_conso_des_l = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_d_l=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_des_l.show();
						fen_conso_des_l.setPosition(300, 350);
						show_d_l = true;
						
						/*var l = rep.largeur * 5;
						document.getElementById('cont_rd').style.width = l + 'px';
						
						document.getElementById('reference').focus();*/
						
						
						/*
						div_ajax.innerHTML = http.responseText;
						var w = parseInt(document.getElementById("1").style.width) + 5.1;
						div_ajax.style.width = w + "mm";
						div_ajax.style.visibility = "visible";*/
						//alert(http.responseText);
					}
					else
					{
						if(show_d_l)
							fen_conso_des_l.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_d_l)
			fen_conso_des_l.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}



function Valider_quantite_com_livr(ind){

	var qte = document.getElementById('qte_' + ind);
		
	new Ajax.Request(
		'conso_livraison.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', maj_qte:qte.value, i:ind},
			onSuccess:function(http){
			
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
											
			}
							
		}
	);
	
}



function Retirer_conso_livraison(index){
		
			
	new Ajax.Request(
		'conso_livraison.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', ind:index},
			onSuccess: function(http) {
					
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
				initializeConsoDropTargetLivr();
													
			}
			
		}
	);

}



var fen_livraison;
function Valider_livraison(){

	if(confirm('Voulez-vous valider votre livraison ?'))
	{
		
		var num_livr = document.getElementById('num_livr');
		var date_livr = document.getElementById('date_livr');
		var num_com_livr = document.getElementById('num_com');
		
		if((num_livr.value != '') && (date_livr.value != '') && (num_com_livr.value != 'Choisissez un num de commande'))
		{
			var val = true;
			new Ajax.Request(
				'test_num_livraison.php',
				{
					asynchronous:false,
					method: 'post',
					parameters: {ajax:'ajax', num_livr:num_livr.value},
					
					onSuccess : function(http){
						
						if(http.responseText == 'pris')
						{
							val = false;
							alert('Le numero de livraison est deja pris.');	
						}
						
					},
					
					onFailure : function(http){
						
						alert('Erreur lors de la validation de la livraison');	
						val = false;
												
					}
									
				}
			);
			
			if(val)
			{
			
				fen_livraison = new Ext.Window({
					title    : 'Gestion des consommables',
					closable : false,
					width    : 330,
					height   : 130,
					resizable:false,
					modal:true,
					plain    : true,
					layout   : 'anchor',
					html:'<div class="boite_mess_val"><center>Validation de la livraison en cours</center><img src="Image/wait.gif" alt="Validation de la demande en cours" /></div>'
							
					
				});
				
				fen_livraison.show();
							
			
				setTimeout(function(){
								new Ajax.Request(
									'conso_livraison.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', num_livr:document.getElementById('num_livr').value, date_livr:document.getElementById('date_livr').value, num_com_livr:document.getElementById('num_com').value},
										onSuccess: function(http) {
												
											document.getElementById('zone_liste_conso').innerHTML = http.responseText;
											
											fen_livraison.body.dom.innerHTML = '<div class="boite_mess_val"><center>Validation reussie de la livraison</center></div>';
																					
											setTimeout(function(){
															fen_livraison.close();
													   
													   },
													   1000);
											
																				
										},
										
										onFailure: function(){
										
											fen_livraison.body.dom.innerHTML = '<div class="boite_mess_val"><center>Echec de la validation</center></div>';
											setTimeout(function(){
															fen_livraison.close();
													   
													   },
													   2000);
										
										}
										
									}
								);
						
						  },
						  500);
				
			}
				  
				
				
		}
		else
		{
			var str = '';var val = true;
			if(num_livr.value == '')
			{
				str = '-Entrez un numero de livraison valide\n';
				val = false;
			}
				
			if(date_livr.value == '')
			{
				str += '-Entrez une date de commande valide\n';
				val = false;
			}
			
			if(num_com_livr.value == '')
			{
				str += '-Choisissez un numero de commande ou saisissez votre commande avant.\n';
				val = false;
			}
			
			if(!val)
				alert(str);
		
			
		
		}
		
	
	}

}



function Valider_date_form_livr(id){
	
	var date = document.getElementById(id);
	var valide = true;
	var str = '';
	
	if(date.value == '')
	{
		valide = false;
		str += '- Le champ date est vide.\n';
	}
	else if(date.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = date.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La date est invalide.\n";
		}
	
	}
	
		
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			alert('bissextile');
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
		
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
				
	if(!valide)
		alert(str);
		
	return valide;
	
}



function Retirer_conso_livraison_modif(num_livr, ref_conso){
		
	if(confirm('Voulez-vous vraiment supprimer ce consommable de cette livraison ?'))
	{
			
		new Ajax.Request(
			'conso_livraison_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', suppr:'supprimer', num_livr:num_livr, ref_conso:ref_conso},
				onSuccess: function(http) {
						
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					initializeConsoDropTargetLivrModif();
														
				}
				
			}
		);
	
	}

}


function Valider_quantite_livr_modif(i, num_livr, ref_conso){

	var qte = document.getElementById('qte_' + i).value;
			
	new Ajax.Request(
		'conso_livraison_modif.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', maj_qte:qte, num_livr:num_livr, ref_conso:ref_conso},
			onSuccess:function(http){
			
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
				initializeConsoDropTargetLivrModif();
							
			}
							
		}
	);

	
	


}



function initializeConsoDropTargetLivrModif(){

	new Ext.dd.DropTarget(Ext.get('id_tab_livr'), {
		
		notifyEnter : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_livr')).addClass('tab_commande_h');
			
		},
		
		notifyOut : function(ddSource, e, data) {
			
			Ext.fly(Ext.get('id_tab_livr')).removeClass('tab_commande_h');
			
			
		},
		
		notifyDrop : function(ddSource, e, data){
			
			Ext.fly(Ext.get('id_tab_livr')).removeClass('tab_commande_h');
			
			new Ajax.Request(
				'conso_livraison_modif.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', ajout:'ajout', ref_conso:data.consoData.ref, num_livr:document.getElementById('num_livrh').value},
					onSuccess: function(http) {
						
						document.getElementById('zone_liste_conso').innerHTML = http.responseText;
						//alert(http.responseText);
						//initializeConsoDropZone();
						initializeConsoDropTargetLivrModif();
														
					},
					
					onFailure : function(){
						
						alert("Erreur lors de l'ajout du consommable");
						
					}
					
				}
			);
			
			return(true);
		}
	}); 


}


function Ajouter_conso_type_livraison_modif(){


	if(document.getElementById("conso1").value != '')
	{
		new Ajax.Request(
			'conso_livraison_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ajout:'ajout', ref_conso:document.getElementById('conso1').value, num_livr:document.getElementById('num_livr').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetLivrModif();
													
				}
			}
		);
		
	}
	else
	{
		alert("Il n'y a aucun consommable correspondant à ce type");
	}
	

}


function Ajouter_conso_ref_des_livr_modif(){

	if(document.getElementById('b_ref').value == "oui")
	{
		new Ajax.Request(
			'conso_livraison_modif.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', ajout:'ajout', ref_conso:document.getElementById('reference').value, num_livr:document.getElementById('num_livr').value},
				onSuccess: function(http) {
					
					document.getElementById('zone_liste_conso').innerHTML = http.responseText;
					//alert(http.responseText);
					initializeConsoDropTargetLivrModif();
													
				}
			}
		);
	}
	else
	{
		alert('Vous devez commencer a taper les premiere lettre de la reference, ou de la designation du consommable\n puis le selectionner dans la fenetre qui apparaitra et cliquez sur le bouton Ajouter le consommable,\n ou cliquez sur le consommable de la fenetre et faire glisser le consommable sur le tableau\n contenant les consommables choisies');
		
	}

}



var show_l_m = false;
var fen_conso_l_m;
function Afficher_fen_conso_livr_modif(){
	
	var ref = document.getElementById("reference");
	
	if(ref.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_ref.php',
			{
				method: 'post',
				parameters: {reference:ref.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_l_m)
							fen_conso_l_m.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
						
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
										
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								  
								  	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax({i});" onmouseout="Sortie_div_ajax({i});" onclick="Clic_div_ajax({i});" id="{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_livr') != 'undefined') && (document.getElementById('id_tab_livr') != null) )
							initializeConsoDropTargetLivrModif();
						
						
						fen_conso_l_m = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_l_m=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_l_m.show();
						fen_conso_l_m.setPosition(100, 350);
						show_l_m = true;
						
					}
					else
					{
						if(show_l_m)
							fen_conso_l_m.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_l_m)
			fen_conso_l_m.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
		
	
}



var show_d_l_m = false;
var fen_conso_des_l_m;
function Afficher_fen_conso_des_livr_modif(){
	
	var des = document.getElementById("designation");
	

	if(des.value != '')
	{
		
		new Ajax.Request(
			'div_ajax_des.php',
			{
				method: 'post',
				parameters: {designation:des.value},
				onSuccess: function(http) {
					
					var rep = eval('(' + http.responseText + ')');
					if(rep.res)
					{
						if(show_d_l_m)
							fen_conso_des_l_m.close();
										
						
						var consoRec = Ext.data.Record.create([{
							name: 'ref'
						}, {
							name: 'des'
						}, {
							name: 'i'
						}]);
					
			
						var consoStore = new Ext.data.Store({
							data: rep.conso,
							reader: new Ext.data.JsonReader({
								id: 'ref'
							}, consoRec)
						});
					
												
						var consoView = new Ext.DataView({
							tpl:'<div class="cont_conso_ref_des">' + 
								'<tpl for=".">' +
								   	'<div class="conso_ref_des_cl" onmouseover="Sur_div_ajax(' + "'des_" + "{i}'" + ');" onmouseout="Sortie_div_ajax(' + "'des_" + "{i}'" + ');" onclick="Clic_div_ajax(' + "'des_" + "{i}'" + ');" id="des_{i}">' +
										'{ref} - {des}' + 
									'</div>' +
								 '</tpl>' +
								 '</div>' ,
							itemSelector: 'div.conso_ref_des_cl',
							store: consoStore,
							listeners: {
								render: initializeConsoDragZone
							}
						});
						
						if( (document.getElementById('id_tab_livr') != 'undefined') && (document.getElementById('id_tab_livr') != null) )
							initializeConsoDropTargetLivrModif();
						
						
						fen_conso_des_l_m = new Ext.Window({
							title    : 'Choisissez un consommable',
							closable : true,
							width    : rep.largeur * 10,
							height   : 230,
							resizable:false,
							//autoScroll : true,
							//border : false,
							plain    : true,
							layout   : 'anchor',
							deferredRender : true,
							//autoScroll: true,
							listeners:
							{
								close:function(){show_d_l_m=false;}
							},
							items    : 
							{
								region:'center',
								layout:'anchor',
								items:consoView
							}
							
							
						});
						
						
						fen_conso_des_l_m.show();
						fen_conso_des_l_m.setPosition(300, 350);
						show_d_l_m = true;
						
						
					}
					else
					{
						if(show_d_l_m)
							fen_conso_des_l_m.close();
					
					}
									
				}
			}
		);
		
	}
	else
	{
		if(show_d_l_m)
			fen_conso_des_l_m.close();
	}
	
	

	document.getElementById('b_ref').value = "non";
	
	
	
	
	
	
}



function Supprimer_livraison(){

	if(confirm('Voulez-vous supprimer cette livraison ?'))
	{
	
		var fen_suppr = new Ext.Window({
			title    : 'Gestion des consommables',
			closable : false,
			width    : 330,
			height   : 130,
			resizable:false,
			modal:true,
			plain    : true,
			layout   : 'anchor',
			html:'<div class="boite_mess_val"><center>Suppression en cours<img src="Image/wait.gif" alt="attente de la suppression" /></center></div>'
					
			
		});
				
		fen_suppr.show();
	
		setTimeout(function(){
						new Ajax.Request(
							'suppr_livraison.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', num_livr:document.getElementById('num_livrh').value},
								onSuccess: function(http) {
									//alert(http.responseText);
									var rep = http.responseText;
									if(rep == 'reussi')
									{
										fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression reussie</div>';
									
										setTimeout(function(){
														document.getElementById('form_retour').submit();
													},1000);
														
									}
									else
									{
										alert(rep);
									}
								
									
																												
								},
								onFailure: function(){
								
									fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression echoue</div>';
									setTimeout(function(){
													fen_suppr.close();
												},5000);
									
								}
							}
						);
					},1000);
	
	}



}


function Valider_form_ajout_util(){

	var form = document.getElementById('form_ajout_util');
	var valide = true;
	var str = '';

	if(form.nom.value == '')
	{
		valide = false;
		str = '- Le nom est vide.\n';
	}
	else if(form.nom.value.search(/^[a-zA-Z\-éè]+$/) == -1)
	{
		valide = false;
		str += '- Le champ nom contient des caracteres incorrect.\n';
	}
	
	if(form.prenom.value == '')
	{
		valide = false;
		str += '- Le prenom est vide.\n';
	}
	else if(form.prenom.value.search(/^[a-zA-Z\-éè]+$/) == -1)
	{
		valide = false;
		str += '- Le champ prenom contient des caracteres incorrect.\n';
	}
	
	if(form.login.value == '')
	{
		valide = false;
		str += '- Le login est vide.\n';
	}
	else if(form.login.value.search(/^[a-zA-Z\-_]+$/) == -1)
	{
		valide = false;
		str += '- Le champ login contient des caracteres incorrect.\n';
	}
	
		
	
	if(!valide)
		alert(str);
		
	return valide;

}



function Supprimer_utilisateur(){

	if(confirm('Voulez-vous supprimer cette utilisateur?'))
	{

		var fen_suppr = new Ext.Window({
			title    : 'Gestion des consommables',
			closable : false,
			width    : 330,
			height   : 130,
			resizable:false,
			modal:true,
			plain    : true,
			layout   : 'anchor',
			html:'<div class="boite_mess_val"><center>Suppression en cours<img src="Image/wait.gif" alt="attente de la suppression" /></center></div>'
					
			
		});
				
		fen_suppr.show();
		
		setTimeout(function(){
					new Ajax.Request(
						'suppr_utilisateur.php',
						{
							method: 'post',
							parameters: {ajax:'ajax', id_util:document.getElementById('id_util').value},
							onSuccess:function(http){
								
								var rep = eval('(' + http.responseText +')');
								if(rep.res == 'supprimer')
								{
									fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Suppression reussie</center></div>';
									
									setTimeout(function(){
													document.getElementById('form_retour').submit();
												},
												1000);
											
								}
												
								
							
							},
							
							onFailure: function(http) {
								
								fen_suppr.body.dom.innerHTML = '<div class="boite_mess_val"><center>Erreur lors de la suppression</center></div>';
								setTimeout(function(){
													fen_suppr.close();
												},
												5000);
								
												
							}
							
						}
												
					);
					},
					1000);


	}


}


function Modif_type_util(){
	
	var form = document.getElementById('form_aff_util');
			
	var param = 'id_util=' + document.getElementById('id_util').value + '&nom=' + form.nom.value + '&prenom=' + form.prenom.value + '&login=' + form.login.value + '&service=' + form.service.value + '&tp_util=' + form.tp_util.value;
	
	new Ajax.Request(
		'modif_utilisateur.php',
		{
			method: 'post',
			parameters: param,
			onSuccess:function(http){
				
				form.tp_utilh.value = form.tp_util.selectedIndex;
				
			
			},
			
			onFailure: function(http) {
				
				alert("Erreur lors de l'enregistrement de la modification");
				form.tp_util.selectedIndex = form.tp_utilh.value;
								
			}
			
		}
								
	);
		
		
	
	
	
}


function Modif_service_util(){
	
	var form = document.getElementById('form_aff_util');
	
	
	var param = 'id_util=' + document.getElementById('id_util').value + '&nom=' + form.nom.value + '&prenom=' + form.prenom.value + '&login=' + form.login.value + '&service=' + form.service.value + '&tp_util=' + form.tp_util.value;
	
	new Ajax.Request(
		'modif_utilisateur.php',
		{
			method: 'post',
			parameters: param,
			onSuccess:function(http){
				
				form.serviceh.value = form.service.selectedIndex;
				
			
			},
			
			onFailure: function(http) {
				
				alert("Erreur lors de l'enregistrement de la modification");
				form.service.selectedIndex = form.serviceh.value;
								
			}
			
		}
								
	);
		
		
	
}


function Modif_nom_util(){
	
	var form = document.getElementById('form_aff_util');
	
	if(form.nom.value == '')
	{
		alert('- Le nom est vide.\n');
		form.nom.value = form.nomh.value;
	}
	else if(form.nom.value.search(/^[a-zA-Z\-éè]+$/) == -1)
	{
		alert('- Le champ nom contient des caracteres incorrect.\n');
		form.nom.value = form.nomh.value;
	}
	else
	{
		var param = 'id_util=' + document.getElementById('id_util').value + '&nom=' + form.nom.value + '&prenom=' + form.prenom.value + '&login=' + form.login.value + '&service=' + form.service.value + '&tp_util=' + form.tp_util.value;
		
		if(form.nom.value != form.nomh.value)
		{
	
			new Ajax.Request(
				'modif_utilisateur.php',
				{
					method: 'post',
					parameters: param,
					onSuccess:function(http){
						
						form.nomh.value = form.nom.value;
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de l'enregistrement de la modification");
						form.nom.value = form.nomh.value;
										
					}
					
				}
										
			);
		
		}
		
		
		
		
	}
	
	
	
}


function Modif_prenom_util(){
	
	var form = document.getElementById('form_aff_util');
	
	if(form.prenom.value == '')
	{
		alert('- Le prenom est vide.\n');
		form.prenom.value = form.prenomh.value;
	}
	else if(form.prenom.value.search(/^[a-zA-Z\-éè]+$/) == -1)
	{
		alert('- Le champ prenom contient des caracteres incorrect.\n');
		form.prenom.value = form.prenomh.value;
	}
	else
	{
		var param = 'id_util=' + document.getElementById('id_util').value + '&nom=' + form.nom.value + '&prenom=' + form.prenom.value + '&login=' + form.login.value + '&service=' + form.service.value + '&tp_util=' + form.tp_util.value;
		
		if(form.prenom.value != form.prenomh.value)
		{
	
			new Ajax.Request(
				'modif_utilisateur.php',
				{
					method: 'post',
					parameters: param,
					onSuccess:function(http){
						
						form.prenomh.value = form.prenom.value;
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de l'enregistrement de la modification");
						form.prenom.value = form.prenomh.value;
										
					}
					
				}
										
			);
			
		}
		
		
		
		
	}
		
	
	
}


function Modif_login_util(){
	
	var form = document.getElementById('form_aff_util');
	
	if(form.login.value == '')
	{
		alert('- Le login est vide.\n');
		form.login.value = form.loginh.value;
	}
	else if(form.login.value.search(/^[a-zA-Z\-_]+$/) == -1)
	{
		alert('- Le champ login contient des caracteres incorrect.\n');
		form.login.value = form.loginh.value;
	}
	else
	{
		var param = 'id_util=' + document.getElementById('id_util').value + '&nom=' + form.nom.value + '&prenom=' + form.prenom.value + '&login=' + form.login.value + '&service=' + form.service.value + '&tp_util=' + form.tp_util.value;
		
		if(form.login.value != form.loginh.value)
		{
	
			new Ajax.Request(
				'modif_utilisateur.php',
				{
					method: 'post',
					parameters: param,
					onSuccess:function(http){
						
						form.loginh.value = form.login.value;
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de l'enregistrement de la modification");
						form.login.value = form.loginh.value;
										
					}
					
				}
										
			);
		
		}
				
		
		
	}
		
	
}


function Ajouter_tva(){

	var form = document.getElementById('form_ajout_tva');
	
	if(form.taux_tva.value == '')
	{
		alert('Le taux de tva est vide');
	}
	else if(form.taux_tva.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
	{
		alert('Le taux de tva doit être un nombre.');
		form.taux_tva.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_tva.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', taux_tva:form.taux_tva.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'libre')
					{
						new Ajax.Request(
							'tva_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', taux_tva:form.taux_tva.value},
								onSuccess:function(http){
									
									document.getElementById('zone_tva').innerHTML = http.responseText;
									form.taux_tva.value = '';
								
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de l'enregistrement du taux de tva");
																		
								}
								
							}
													
						);
					
					}
					else if(rep == 'existe')
					{
						alert('Le taux de tva existe déjà.');					
					
					}
					else
					{
						alert(http.responseText);
					
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement du taux de tva");
														
				}
				
			}
									
		);
	
		
		
	
	}


}


function Supprimer_taux_tva(code_tva){

	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(confirm('Voulez-vous vraiment supprimer ce taux de tva'))
		{
			new Ajax.Request(
				'test_suppr_tva.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', code_tva:code_tva},
					onSuccess:function(http){
					
						var rep = http.responseText;
						
						if(rep == 'impossible')
						{
							alert('Suppression impossible car la tva est associé à un consommable');
						}
						else if(rep == 'possible')
						{
							new Ajax.Request(
								'tva_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', suppr:'suppr', code_tva:code_tva},
									onSuccess:function(http){
										
										document.getElementById('zone_tva').innerHTML = http.responseText;
																		
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la suppression du taux de tva");
																			
									}
									
								}
														
							);
							
						
						}
						else
						{
							alert(http.responseText);
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la suppression du taux de tva");
															
					}
					
				}
										
			);
			
		
		
		}

	}
	else
	{
		alert('Si vous voulez supprimer ce taux de tva cliquer sur Modifier TVA');
	}

}


function Modifier_tva(i, code_tva){

	var tva = document.getElementById('taux_tva' + i);
	var tvah = document.getElementById('taux_tva' + i + 'h');
	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(tva.value == '')
		{
			alert('Le taux de tva est vide');
			tva.value = tvah.value;
			
		}
		else if(tva.value.search(/^[0-9]+([.][0-9]+)?$/) == -1)
		{
			alert('Le taux de tva doit être un nombre.');
			tva.value = tvah.value;
		
		}
		else
		{
		
			if(tva.value != tvah.value)
			{
				new Ajax.Request(
					'test_tva.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', taux_tva:tva.value},
						onSuccess:function(http){
							
							var rep = http.responseText;
							
							if(rep == 'libre')
							{
								new Ajax.Request(
									'tva_ajax.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', modif:'modif', nv_taux_tva:tva.value, code_tva:code_tva},
										onSuccess:function(http){
											
											document.getElementById('zone_tva').innerHTML = http.responseText;
											tvah.value = tva.value;
																			
										},
										
										onFailure: function(http) {
											
											alert("Erreur lors de la validation du nouveau taux de tva");
											tva.value = tvah.value;
																				
										}
										
									}
															
								);
								
							
							}
							else if(rep == 'existe')
							{
								alert('Le taux de tva existe déjà.');
								tva.value = tvah.value;					
							
							}
							else
							{
								alert(http.responseText);
								tva.value = tvah.value;
							
							}
							
						
						},
						
						onFailure: function(http) {
							
							alert("Erreur lors de l'enregistrement du taux de tva");
							tva.value = tvah.value;
																
						}
						
					}
											
				);
		
			}
			
		
		}
		
	}
	else
	{
		tva.value = tvah.value;
	}
	

}


function Supprimer_type_conso(id_type){

	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(confirm('Voulez-vous vraiment supprimer ce type de consommable'))
		{
			new Ajax.Request(
				'test_suppr_type_conso.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', id_type:id_type},
					onSuccess:function(http){
					
						var rep = http.responseText;
						
						if(rep == 'impossible')
						{
							alert('Suppression impossible car le type de consommable est associé à un consommable');
						}
						else if(rep == 'possible')
						{
							new Ajax.Request(
								'type_conso_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', suppr:'suppr', id_type:id_type},
									onSuccess:function(http){
										
										document.getElementById('zone_type_conso').innerHTML = http.responseText;
																		
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la suppression du type de consommable");
																			
									}
									
								}
														
							);
							
						
						}
						else
						{
							alert(http.responseText);
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la suppression du type de consommable");
										
															
					}
					
				}
										
			);
			
		
		
		}
		
	}
	else
	{
		alert('Si vous voulez supprimer ce type de consommable cliquer sur Modifier les types de consommables');
	}



}


function Ajouter_type_conso(){

	var form = document.getElementById('form_ajout_type_conso');
	
	if(form.type_conso.value == '')
	{
		alert('Le type de consommable est vide');
	}
	else if(form.type_conso.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
	{
		alert('Le type de consommable contient des caractères incorrects.');
		form.type_conso.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_type_conso.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', lib_type:form.type_conso.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'libre')
					{
						new Ajax.Request(
							'type_conso_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', type_conso:form.type_conso.value},
								onSuccess:function(http){
									
									document.getElementById('zone_type_conso').innerHTML = http.responseText;
									form.type_conso.value = '';
								
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de l'enregistrement du type de consommable");
																		
								}
								
							}
													
						);
					
					}
					else if(rep == 'existe')
					{
						alert('Le type de consommable existe déjà.');					
					
					}
					else
					{
						alert(http.responseText);
					
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement du type de consommable");
																							
				}
				
			}
									
		);
	
		
		
	
	}


}


function Modifier_type_conso(i, id_type){

	var tp_conso = document.getElementById('tp_conso' + i);
	var tp_consoh = document.getElementById('tp_conso' + i + 'h');
	var check = document.getElementById('modifier_check');

	if(check.checked)
	{
	
		if(tp_conso.value == '')
		{
			alert('Le type de consommable est vide');
			tp_conso.value = tp_consoh.value;
			
		}
		else if(tp_conso.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
		{
			alert('Le type de consommable contient des caractères incorrects.');
			tp_conso.value = tp_consoh.value;
		
		}
		else
		{
		
			if(tp_conso.value != tp_consoh.value)
			{
				
				new Ajax.Request(
					'test_type_conso.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', lib_type:tp_conso.value},
						onSuccess:function(http){
							
							var rep = http.responseText;
							
							if(rep == 'libre')
							{
								new Ajax.Request(
									'type_conso_ajax.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', modif:'modif', nv_type_conso:tp_conso.value, id_type:id_type},
										onSuccess:function(http){
											
											document.getElementById('zone_type_conso').innerHTML = http.responseText;
											tp_consoh.value = tp_conso.value;
																			
										},
										
										onFailure: function(http) {
											
											alert("Erreur lors de la validation du nouveau type de consommable");
											tp_conso.value = tp_consoh.value;
																				
										}
										
									}
															
								);
								
							
							}
							else if(rep == 'existe')
							{
								alert('Le type de consommable existe déjà.');
								tp_conso.value = tp_consoh.value;					
							
							}
							else
							{
								alert(http.responseText);
								tp_conso.value = tp_consoh.value;
							
							}
							
						
						},
						
						onFailure: function(http) {
							
							alert("Erreur lors de l'enregistrement du type de consommable");
							tp_conso.value = tp_consoh.value;
																
						}
						
					}
											
				);
		
			}
			
		
		}
		
	}
	else
	{
		tp_conso.value = tp_consoh.value;
	}
	

}


function Ajouter_type_impr(){

	var form = document.getElementById('form_ajout_type_impr');
	
	if(form.type_impr.value == '')
	{
		alert("Le type d'imprimante est vide");
	}
	else if(form.type_impr.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
	{
		alert("Le type d'imprimante contient des caractères incorrects.");
		form.type_impr.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_type_imprimante.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', type_impr:form.type_impr.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'libre')
					{
						new Ajax.Request(
							'type_imprimante_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', type_impr:form.type_impr.value},
								onSuccess:function(http){
									
									document.getElementById('zone_type_impr').innerHTML = http.responseText;
									form.type_impr.value = '';
								
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de l'enregistrement du type d'imprimante");
																		
								}
								
							}
													
						);
					
					}
					else if(rep == 'existe')
					{
						alert("Le type d'imprimante existe déjà.");					
					
					}
					else
					{
						alert(http.responseText);
					
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement du type d'imprimante");
																							
				}
				
			}
									
		);
	
		
		
	
	}


}



function Supprimer_type_impr(id_type){

	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(confirm("Voulez-vous vraiment supprimer ce type d'imprimante ?"))
		{
			new Ajax.Request(
				'test_suppr_type_impr.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', id_type:id_type},
					onSuccess:function(http){
					
						var rep = http.responseText;
						
						if(rep == 'impossible')
						{
							alert("Suppression impossible car le type d'imprimante est associé à une imprimante");
						}
						else if(rep == 'possible')
						{
							new Ajax.Request(
								'type_imprimante_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', suppr:'suppr', id_type:id_type},
									onSuccess:function(http){
										
										document.getElementById('zone_type_impr').innerHTML = http.responseText;
																		
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la suppression du type d'imprimante");
																			
									}
									
								}
														
							);
							
						
						}
						else
						{
							alert(http.responseText);
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la suppression du type d'imprimante");
										
															
					}
					
				}
										
			);
			
		
		
		}
		
	}
	else
	{
		alert("Si vous voulez supprimer un type d'imprimante cliquer sur Modifier les types d'imprimantes");
	}



}



function Modifier_type_impr(i, id_type){

	var tp_impr = document.getElementById('tp_impr' + i);
	var tp_imprh = document.getElementById('tp_impr' + i + 'h');
	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(tp_impr.value == '')
		{
			alert("Le type d'imprimante est vide");
			tp_impr.value = tp_imprh.value;
			
		}
		else if(tp_impr.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
		{
			alert("Le type d'imprimante contient des caractères incorrects.");
			tp_impr.value = tp_imprh.value;
		
		}
		else
		{
		
			if(tp_impr.value != tp_imprh.value)
			{
				
				new Ajax.Request(
					'test_type_imprimante.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', type_impr:tp_impr.value},
						onSuccess:function(http){
							
							var rep = http.responseText;
							
							if(rep == 'libre')
							{
								new Ajax.Request(
									'type_imprimante_ajax.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', modif:'modif', nv_tp_impr:tp_impr.value, id_type:id_type},
										onSuccess:function(http){
											
											document.getElementById('zone_type_impr').innerHTML = http.responseText;
											tp_imprh.value = tp_impr.value;
																			
										},
										
										onFailure: function(http) {
											
											alert("Erreur lors de la validation du nouveau type d'imprimante");
											tp_impr.value = tp_imprh.value;
																				
										}
										
									}
															
								);
								
							
							}
							else if(rep == 'existe')
							{
								alert("Le type d'imprimante existe déjà.");
								tp_impr.value = tp_imprh.value;					
							
							}
							else
							{
								alert(http.responseText);
								tp_impr.value = tp_imprh.value;
							
							}
							
						
						},
						
						onFailure: function(http) {
							
							alert("Erreur lors de l'enregistrement du type d'imprimante");
							tp_impr.value = tp_imprh.value;
																
						}
						
					}
											
				);
		
			}
			
		
		}
		
	}
	else
	{
		tp_impr.value = tp_imprh.value;
	}
	

}



function Ajouter_marque(){

	var form = document.getElementById('form_ajout_marque');
	
	if(form.marque.value == '')
	{
		alert("La marque est vide");
	}
	else if(form.marque.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
	{
		alert("La marque contient des caractères incorrects.");
		form.marque.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_marque.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', marque:form.marque.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'libre')
					{
						new Ajax.Request(
							'marque_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', marque:form.marque.value},
								onSuccess:function(http){
									
									document.getElementById('zone_marque').innerHTML = http.responseText;
									form.marque.value = '';
								
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de l'enregistrement de la marque");
																		
								}
								
							}
													
						);
					
					}
					else if(rep == 'existe')
					{
						alert("La marque existe déjà.");					
					
					}
					else
					{
						alert(http.responseText);
					
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement de la marque");
																							
				}
				
			}
									
		);
	
		
		
	
	}


}


function Supprimer_marque_impr(id_marque){

	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(confirm("Voulez-vous vraiment supprimer cette marque d'imprimante ?"))
		{
			new Ajax.Request(
				'test_suppr_marque.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', id_marque:id_marque},
					onSuccess:function(http){
					
						var rep = http.responseText;
						
						if(rep == 'impossible')
						{
							alert("Suppression impossible car la marque d'imprimante est associé à une imprimante");
						}
						else if(rep == 'possible')
						{
							new Ajax.Request(
								'marque_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', suppr:'suppr', id_marque:id_marque},
									onSuccess:function(http){
										
										document.getElementById('zone_marque').innerHTML = http.responseText;
																		
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la suppression de marque d'imprimante");
																			
									}
									
								}
														
							);
							
						
						}
						else
						{
							alert(http.responseText);
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la suppression de la marque d'imprimante");
										
															
					}
					
				}
										
			);
			
		
		
		}
		
	}
	else
	{
		alert('Si vous voulez supprimer une marque cliquer sur Modifier les marques');
	}



}



function Modifier_marque_impr(i, id_marque){

	var marque = document.getElementById('marque' + i);
	var marqueh = document.getElementById('marque' + i + 'h');
	var check = document.getElementById('modifier_check');

	if(check.checked)
	{

		if(marque.value == '')
		{
			alert("La marque d'imprimante est vide");
			marque.value = marqueh.value;
			
		}
		else if(marque.value.search(/^[a-zA-z\-_éèà' ]+$/) == -1)
		{
			alert("La marque d'imprimante contient des caractères incorrects.");
			marque.value = marqueh.value;
		
		}
		else
		{
		
			if(marque.value != marqueh.value)
			{
				
				new Ajax.Request(
					'test_marque.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', marque:marque.value},
						onSuccess:function(http){
							
							var rep = http.responseText;
							
							if(rep == 'libre')
							{
								new Ajax.Request(
									'marque_ajax.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', modif:'modif', nv_marque:marque.value, id_marque:id_marque},
										onSuccess:function(http){
											
											document.getElementById('zone_marque').innerHTML = http.responseText;
											marqueh.value = marque.value;
																			
										},
										
										onFailure: function(http) {
											
											alert("Erreur lors de la validation de la nouvelle marque d'imprimante");
											marque.value = marqueh.value;
																				
										}
										
									}
															
								);
								
							
							}
							else if(rep == 'existe')
							{
								alert("La marque d'imprimante existe déjà.");
								marque.value = marqueh.value;					
							
							}
							else
							{
								alert(http.responseText);
								marque.value = marqueh.value;
							
							}
							
						
						},
						
						onFailure: function(http) {
							
							alert("Erreur lors de l'enregistrement de la nouvelle marque d'imprimante");
							marque.value = marqueh.value;
																
						}
						
					}
											
				);
		
			}
			
		
		}
	
	}
	else
	{
		marque.value = marqueh.value;
	}
	

}


function select_change_division(){

	var division = document.getElementById('division');

	new Ajax.Request(
		'service_ajax.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_division:division.value},
			onSuccess:function(http){
				
				document.getElementById('zone_service').innerHTML = http.responseText;
																
			},
			
			onFailure: function(http) {
				
				alert("Erreur lors du changement de division");
																	
			}
			
		}
								
	);

}


function Ajouter_service(){

	var form = document.getElementById('form_ajout_service');
	var str = '';
	var valide = true;
	
	if(form.id_service.value == '')
	{
		str = "L'abbréviation du service est vide\n";
		valide = false;
	}
	else if(form.id_service.value.search(/^[A-Z0-9]+$/) == -1)
	{
		str += "L'abbréviation du service contient des caractères incorrects\n";
		valide = false;
		form.id_service.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_service.php',
			{
				asynchronous:false,
				method: 'post',
				parameters: {ajax:'ajax', id_service:form.id_service.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'existe')
					{
						str += "Le service existe déjà\n";					
						valide = false;
						
					}
															
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement du nouveau service");
																							
				}
				
			}
									
		);
	
	
	}
	
	if(form.nom_service.value == '')
	{
		str += "Le libellé de service est vide\n";
		valide = false;
	}
	else if(form.nom_service.value.search(/^[a-zA-z0-9\-_éèà' ]+$/) == -1)
	{
		str += "Le libellé de service contient des caractères incorrects\n";
		valide = false;
		form.nom_service.value = '';
	
	}
	
	if(!valide)
	{
		alert(str);
	
	}
	
	return valide;


}



function Supprimer_service(id_service){
	
	if(confirm("Voulez-vous vraiment supprimer ce service ?"))
	{
		new Ajax.Request(
			'test_suppr_service.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', id_service:id_service},
				onSuccess:function(http){
				
					var rep = http.responseText;
					
					if(rep == 'impossible')
					{
						alert("Suppression impossible car le service possede des utilisateurs ou a des consommations");
					}
					else if(rep == 'possible')
					{
						new Ajax.Request(
							'service_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', suppr:'suppr', service:id_service, id_division:document.getElementById('division').value},
								onSuccess:function(http){
									
									document.getElementById('zone_service').innerHTML = http.responseText;
																	
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de la suppression du service");
																		
								}
								
							}
													
						);
						
					
					}
					else
					{
						alert(http.responseText);
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de la suppression du service");
									
														
				}
				
			}
									
		);
		
	
	
	}
		
	



}

function Modifier_service(i){

	var d = document.getElementById('service' + i);
	var nd = document.getElementById('nom_service' + i);
	d.readOnly = !d.readOnly;
	nd.readOnly = !nd.readOnly;
	
	if(d.readOnly)
	{
		d.style.backgroundColor = "#FFFFFF";
		nd.style.backgroundColor = "#FFFFFF";
	}
	else
	{
		d.style.backgroundColor = "#FBFAA4";
		nd.style.backgroundColor = "#FBFAA4";
	}
	
	d.style.border = "1px solid #9FBEEC";
	nd.style.border = "1px solid #9FBEEC";
}

function Modifier_id_service(i, id_service){

	var service = document.getElementById('service' + i);
	var serviceh = document.getElementById('service' + i + 'h');
	
	if(service.value == '')
	{
		alert("L'abbréviation du service est vide\n");
		service.value = serviceh.value;
	}
	else if(service.value.search(/^[A-Z0-9]+$/) == -1)
	{
		alert("L'abbréviation du service contient des caractères incorrects\n");
		service.value = serviceh.value;
	}
	else
	{
	
		if(service.value != serviceh.value)
		{
			
			new Ajax.Request(
				'test_service.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', id_service:service.value},
					onSuccess:function(http){
						
						var rep = http.responseText;
						
						if(rep == 'libre')
						{
							
							new Ajax.Request(
								'service_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', modif_id:'modif_id', nv_service:service.value, service:id_service, id_division:document.getElementById('division').value},
									onSuccess:function(http){
										
										document.getElementById('zone_service').innerHTML = http.responseText;
										serviceh.value = service.value;
																		
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la validation du nouveau service");
										service.value = serviceh.value;
																			
									}
									
								}
														
							);
							
						
						}
						else if(rep == 'existe')
						{
							alert("Le service existe déjà.");
							service.value = serviceh.value;					
						
						}
						else
						{
							alert(http.responseText);
							service.value = serviceh.value;
						
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de l'enregistrement du nouveau service");
						service.value = serviceh.value;
															
					}
					
				}
										
			);
	
		}
		
	
	}
		
	
	

}



function Modifier_nom_service(i, id_service){

	var service = document.getElementById('nom_service' + i);
	var serviceh = document.getElementById('nom_service' + i + 'h');
	
	if(service.value == '')
	{
		alert("Le libellé du service est vide\n");
		service.value = serviceh.value;
	}
	else if(service.value.search(/^[a-zA-z0-9\-_éèà' ]+$/) == -1)
	{
		alert("Le libellé du service contient des caractères incorrects\n");
		service.value = serviceh.value;
	}
	else
	{
	
		if(service.value != serviceh.value)
		{
			new Ajax.Request(
				'service_ajax.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', modif_nom:'modif_nom', nom_service:service.value, service:id_service, id_division:document.getElementById('division').value},
					onSuccess:function(http){
						
						document.getElementById('zone_service').innerHTML = http.responseText;
						serviceh.value = service.value;
														
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la validation du libellé du service");
						service.value = serviceh.value;
															
					}
					
				}
										
			);
								
			
		}
		
	
	}
		
	
	

}


function Ajouter_division(){

	var form = document.getElementById('form_ajout_division');
	var str = '';
	var valide = true;
	
	if(form.id_division.value == '')
	{
		str = "L'abbréviation de la division est vide\n";
		valide = false;
	}
	else if(form.id_division.value.search(/^[A-Z0-9]+$/) == -1)
	{
		str += "L'abbréviation de la division contient des caractères incorrects\n";
		valide = false;
		form.id_division.value = '';
	
	}
	else
	{
		new Ajax.Request(
			'test_division.php',
			{
				asynchronous:false,
				method: 'post',
				parameters: {ajax:'ajax', id_division:form.id_division.value},
				onSuccess:function(http){
					
					var rep = http.responseText;
					
					if(rep == 'existe')
					{
						str += "La division existe déjà.\n";					
						valide = false;
					}
									
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de l'enregistrement de la nouvelle division");
																							
				}
				
			}
									
		);
	
	}
	
	if(form.nom_division.value == '')
	{
		str += "Le libellé de division est vide\n";
		valide = false;
	}
	else if(form.nom_division.value.search(/^[a-zA-z0-9\-_éèà' ]+$/) == -1)
	{
		str += "Le libellé de division contient des caractères incorrects\n";
		valide = false;
		form.nom_division.value = '';
	
	}
	
	if(valide)
	{
		
		
	}
	else
		alert(str);
	
	return valide;


}



function Supprimer_division(id_division){
	
	if(confirm("Voulez-vous vraiment supprimer cette division ?"))
	{
		new Ajax.Request(
			'test_suppr_division.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', id_division:id_division},
				onSuccess:function(http){
				
					var rep = http.responseText;
					
					if(rep == 'impossible')
					{
						alert("Suppression impossible car la division a des services");
					}
					else if(rep == 'possible')
					{
						var suppr_archive = 0;
						if(confirm("Voulez-vous supprimer la division des archives ?"))
						{
							suppr_archive = 1;
						}
					
						new Ajax.Request(
							'division_ajax.php',
							{
								method: 'post',
								parameters: {ajax:'ajax', suppr:'suppr', id_division:id_division, suppr_archive:suppr_archive},
								onSuccess:function(http){
									
									document.getElementById('zone_division').innerHTML = http.responseText;
																											
								},
								
								onFailure: function(http) {
									
									alert("Erreur lors de la suppression de la division");
																		
								}
								
							}
													
						);
						
					
					}
					else
					{
						alert(http.responseText);
					}
					
				
				},
				
				onFailure: function(http) {
					
					alert("Erreur lors de la suppression de la division");
									
														
				}
				
			}
									
		);
		
	
	
	}
		

}


function Modifier_division(i){

	var d = document.getElementById('division_' + i);
	var nd = document.getElementById('nom_division' + i);
	d.readOnly = !d.readOnly;
	nd.readOnly = !nd.readOnly;
	
	if(d.readOnly)
	{
		d.style.backgroundColor = "#FFFFFF";
		nd.style.backgroundColor = "#FFFFFF";
	}
	else
	{
		d.style.backgroundColor = "#FBFAA4";
		nd.style.backgroundColor = "#FBFAA4";
	}
	
	d.style.border = "1px solid #9FBEEC";
	nd.style.border = "1px solid #9FBEEC";
}


function Modifier_id_division(i, id_division){

	var division = document.getElementById('division_' + i);
	var nom_division = document.getElementById('nom_division' + i);
	var divisionh = document.getElementById('division_' + i + 'h');
	
	
	if(division.value == '')
	{
		alert("L'abbréviation de la division est vide\n");
		division.value = divisionh.value;
	}
	else if(division.value.search(/^[A-Z0-9]+$/) == -1)
	{
		alert("L'abbréviation de la division contient des caractères incorrects\n");
		division.value = divisionh.value;
	}
	else
	{
	
		if(division.value != divisionh.value)
		{
			var modif_archive = 0;
			if(confirm("Voulez-vous enregistrer la modification dans les archives ?"))
			{
				modif_archive = 1;
				if(confirm("Si vous voulez archiver le nouveau nom(nouvelle archive), cliquer sur OK\nSinon si vous voulez juste modifier le nom de la division dans les archives sans créer une nouvelle archive cliquer sur Annuler"))
				{
					modif_archive = 2;
				}
			}
			
			new Ajax.Request(
				'test_division.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', id_division:division.value},
					onSuccess:function(http){
						
						var rep = http.responseText;
						
						if(rep == 'libre')
						{
							
							new Ajax.Request(
								'division_ajax.php',
								{
									method: 'post',
									parameters: {ajax:'ajax', modif_id:'modif_id', nv_division:division.value, id_division:id_division, nom_division:nom_division.value, modif_archive:modif_archive},
									onSuccess:function(http){
										
										document.getElementById('zone_division').innerHTML = http.responseText;
										divisionh.value = division.value;
																												
									},
									
									onFailure: function(http) {
										
										alert("Erreur lors de la validation de la nouvelle division");
										division.value = divisionh.value;
																			
									}
									
								}
														
							);
							
						
						}
						else if(rep == 'existe')
						{
							alert("La division existe déjà.");
							division.value = divisionh.value;					
						
						}
						else
						{
							alert(http.responseText);
							division.value = divisionh.value;
						
						}
						
					
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de l'enregistrement de la nouvelle division");
						division.value = divisionh.value;
															
					}
					
				}
										
			);
	
		}
		
	
	}
		
		

}



function Modifier_nom_division(i, id_division){

	var division = document.getElementById('nom_division' + i);
	var divisionh = document.getElementById('nom_division' + i + 'h');
	
	if(division.value == '')
	{
		alert("Le libellé de la division est vide\n");
		division.value = divisionh.value;
	}
	else if(division.value.search(/^[a-zA-z0-9\-_éèà' ]+$/) == -1)
	{
		alert("Le libéllé de la division contient des caractères incorrects\n");
		division.value = divisionh.value;
	}
	else
	{
	
		if(division.value != divisionh.value)
		{
			var modif_archive = 0;
			if(confirm("Voulez-vous enregistrer la modification dans les archives ?"))
			{
				modif_archive = 1;
			}
							
			new Ajax.Request(
				'division_ajax.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', modif_nom:'modif_nom', nom_division:division.value, id_division:id_division, modif_archive:modif_archive},
					onSuccess:function(http){
						
						document.getElementById('zone_division').innerHTML = http.responseText;
						divisionh.value = division.value;
														
					},
					
					onFailure: function(http) {
						
						alert("Erreur lors de la validation du nom de la division");
						division.value = divisionh.value;
															
					}
					
				}
										
			);
		
		
		}
							
						
						
		
	
	}
	
	
	
	

}


function Fusionner_division(){

	var form = document.getElementById('form_fusionner_division');
	var str = '';
	var val = true;
	
		
	if( (form.division1.selectedIndex == 0) && (form.division2.selectedIndex == 0) )
	{
		str += "Choisissez les divisions à fusionner.\n";
		val = false;
	
	}
	else
	{
	
		if(form.division1.value == form.division2.value)
		{
			str += "Les deux divisions à fusionner doivent être différente.\n";
			val = false;
		
		}
		
		/*if((form.division3.value == form.division1.value) || (form.division3.value == form.division2.value))
		{
			str += "La divisions issu de la fusion doit être différente des deux division à fusionner.\n";
			val = false;
		
		}*/
		
		if(form.division3.selectedIndex == 0)
		{
			str += "Choisissez la division à fusionner.\n";
			val = false;
		
		}

				
	}
	
	if(val)
	{
		return confirm('Voulez-vous vraiment fusionner la division ' + form.division1.value + ' avec la division ' + form.division2.value + ' en la division ' + form.division3.value + '?\nVous ne pourrez plus revenir en arrière après cette fusion, la fusion est définitive.');
				
	}
	else
	{
		alert(str);
		return false;
	
	}
		
	
	

}


function Afficher_division_archive(){

	var div = document.getElementById('divisiona');
	
	new Ajax.Request(
		'division_archive_ajax.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', id_division:div.value},
			onSuccess:function(http){
				
				document.getElementById('zone_division').innerHTML = http.responseText;
				
												
			},

			onFailure:function(){
			
				alert("Erreur lors de l'affichage de la division");
			
			}
		}
								
	);



}

function RAZ_donner(i){

	var ret = document.getElementById('retirer_' + i);
	//alert(ret.value + " " + i);
	new Ajax.Request(
		'demander_session.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', i:i, retirer:ret.value},
			onSuccess:function(http){
				
				//alert(http.responseText);
				
												
			},
			onFailure:function(){
			
				alert("Erreur lors du changement de valeur");
			
			}
								
		}
								
	);
	
	document.getElementById('donner_' + i).selectedIndex = 0;

}


function RAZ_retirer(i){
	
	var don = document.getElementById('donner_' + i);
	//alert(don.value + " " + i);
	new Ajax.Request(
		'demander_session.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', i:i, donner:don.value},
			onSuccess:function(http){
				
				//alert(http.responseText);
				
												
			},
			onFailure:function(){
			
				alert("Erreur lors du changement de valeur");
			
			}
								
		}
								
	);
	
	document.getElementById('retirer_' + i).selectedIndex = 0;

}


function Archiver_demande(){

	var form = document.getElementById('form_archiver');
	var valide = true;
	var str = '';
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

			
	function Est_Valide(jour, mois, annee){
		
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(confirm('Voulez-vous vraiment archiver ces demandes?'))
	{
		if(form.date1.value == '')
		{
			valide = false;
			str += '- Le premier champ date est vide.\n';
		}
		else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
		{
			valide = false;
			str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
		}
		else
		{
			var d = form.date1.value.split("/");
			if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
			{
				valide = false;
				str += "- La premiere date est invalide.\n";
			}
		
		}
		
		if(form.date2.value == '')
		{
			valide = false;
			str += '- Le deuxieme champ date est vide.\n';
		}
		else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
		{
			valide = false;
			str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
		}
		else
		{
			var d = form.date2.value.split("/");
			if( !Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])) )
			{
				valide = false;
				str += "- La deuxieme date est invalide.\n";
			}
		
		}
		
		
		
		if(valide && !Date_Compris_Entre())
		{
			valide = false;
			str += "- La deuxieme date doit etre superieur a la premiere date.\n";
		
		}
		
		if(valide)
		{
				
			var fen_demande = new Ext.Window({
				title    : 'Gestion des consommables',
				closable : false,
				width    : 330,
				height   : 130,
				resizable:false,
				modal:true,
				plain    : true,
				layout   : 'anchor',
				html:'<div class="boite_mess_val"><center>Archivage des demandes en cours</center><img src="Image/wait.gif" alt="Validation de la demande en cours" /></div>'
						
				
			});
			
			fen_demande.show();

			new Ajax.Request(
				'archiver_demande_ajax.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
					onSuccess: function(http) {
						
						var rep = http.responseText;
						var str = '';
						if(rep == 0)
						{
							str = "Aucune demande archivée";
						}
						else
						{
							if(rep == 1)
								str = rep + ' demande a été archivée';
							else
								str = rep + ' demandes ont été archivées';
						}
						fen_demande.body.dom.innerHTML = '<div class="boite_mess_val"><center>' + str + '</center></div>';
						
						setTimeout(function(){
										fen_demande.close()
									}, 2000);
						
						
					},
					
					onFailure: function(){
					
						fen_demande.body.dom.innerHTML = '<div class="boite_mess_val"><center>' + "Erreur lors de l'archivage" + '</center></div>';
						
						setTimeout(function(){
										fen_demande.close()
									}, 5000);
					
					}
				}
			);
		
		}
		else
		{
			alert(str);
		
		}
		
	}

}


function Changer_select_conso_livraison(){

	new Ajax.Request(
		'select_conso_livraison.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', num_com:document.getElementById("num_com").value},
			onSuccess: function(http) {
				
				document.getElementById('zone_conso').innerHTML = http.responseText;
				
			}
		}
	);
	
	new Ajax.Request(
		'conso_livraison.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', raz:'raz'},
			onSuccess: function(http) {
				
				document.getElementById('zone_liste_conso').innerHTML = http.responseText;
				
			}
		}
	);



}


function Diagramme_pagination_division(page, date1, date2, division, choix){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, division:division, choix:choix, sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_pagination_service(page, date1, date2, service){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, service:service, choix:'service', sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_changer_type_div(page, date1, date2, division, choix){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, division:division, choix:choix, sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_changer_type_ser(page, date1, date2, service){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, service:service, choix:'service', sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}


function Camembert_conso_division(date1, date2, division, val, choix){

	new Ajax.Request(
		'camembert_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam_conso').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_conso_service(date1, date2, service, val){

	new Ajax.Request(
		'camembert_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:'service'},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam_conso').innerHTML = http.responseText;
				
			}
		}
	);



}


function Changer_etat_diag(){

	var etat = document.getElementById('etat');
	
	if(etat.value == 3)
	{
		document.getElementById('sel_tr1').style.visibility = 'visible';
		document.getElementById('sel_tr2').style.visibility = 'visible';
		
	}
	else
	{
		document.getElementById('sel_tr1').style.visibility = 'hidden';
		document.getElementById('sel_tr2').style.visibility = 'hidden';
		
	}



}


function Camembert_conso_division_etat(date1, date2, division, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;

	new Ajax.Request(
		'camembert_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam_conso').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_conso_service_etat(date1, date2, service, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;

	new Ajax.Request(
		'camembert_suivi_conso.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam_conso').innerHTML = http.responseText;
				
			}
		}
	);



}


function Camembert_conso_zoom(date1, date2, ds, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;
		
	var param = 'ajax=ajax' + '&zoom=zoom' +  '&date1=' + date1 + '&date2=' + date2 + '&val=' + val +  '&choix=' + choix + '&etat=' + etat.value + '&sel_tr=' + sel_tr;
	if((choix == 'division') || (choix == 'division_service'))
		param += '&division=' + ds;
	else if(choix == 'service')
		param += '&service=' + ds;
		
	new Ajax.Request(
		'camembert_suivi_conso.php',
		{
			method: 'post',
			parameters: param,
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam_conso').innerHTML = http.responseText;
				
			}
		}
	);



}



function Cout_achat_division(){

	var form = document.getElementById('form_per_cout_achat');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseInt(d[0]), parseInt(d[1]), parseInt(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{
		new Ajax.Request(
			'cout_achat_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', division:document.getElementById("division").value, choix_div:document.getElementById("choix_div").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('cout_achat').innerHTML = http.responseText;
					
				}
			}
		);
	
	}
	else
	{
		alert(str);
	
	}



}


function Cout_achat_service(){

	var form = document.getElementById('form_per_cout_achat');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{

		new Ajax.Request(
			'cout_achat_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', service:document.getElementById("service").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('cout_achat').innerHTML = http.responseText;
					
				}
			}
		);
		
	}
	else
	{
		alert(str);
	
	}



}


function Diagramme_pagination_division_ca(page, date1, date2, division, choix){

	new Ajax.Request(
		'diagramme_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, division:division, choix:choix},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_pagination_service_ca(page, date1, date2, service){

	new Ajax.Request(
		'diagramme_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, service:service, choix:'service'},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}


function Camembert_ca_division_etat(date1, date2, division, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;

	new Ajax.Request(
		'camembert_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_ca_service_etat(date1, date2, service, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;

	new Ajax.Request(
		'camembert_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}


function Camembert_ca_zoom(date1, date2, ds, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;
		
	var param = 'ajax=ajax' + '&zoom=zoom' +  '&date1=' + date1 + '&date2=' + date2 + '&val=' + val +  '&choix=' + choix + '&etat=' + etat.value + '&sel_tr=' + sel_tr;
	if((choix == 'division') || (choix == 'division_service'))
		param += '&division=' + ds;
	else if(choix == 'service')
		param += '&service=' + ds;
		
	new Ajax.Request(
		'camembert_cout_achat.php',
		{
			method: 'post',
			parameters: param,
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}


function Camembert_ca_division(date1, date2, division, val, choix){

	new Ajax.Request(
		'camembert_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_ca_service(date1, date2, service, val){

	new Ajax.Request(
		'camembert_cout_achat.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:'service'},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}



function Evolution_demande_division(){

	var form = document.getElementById('form_per_evo_dem');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseInt(d[0]), parseInt(d[1]), parseInt(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{
		new Ajax.Request(
			'evolution_demande_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', division:document.getElementById("division").value, choix_div:document.getElementById("choix_div").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('evolution_dem').innerHTML = http.responseText;
					
				}
			}
		);
	
	}
	else
	{
		alert(str);
	
	}



}



function Evolution_demande_service(){

	var form = document.getElementById('form_per_evo_dem');
	var valide = true;
	var str = '';
	
	if(form.date1.value == '')
	{
		valide = false;
		str += '- Le premier champ date est vide.\n';
	}
	else if(form.date1.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le premier champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date1.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La premiere date est invalide.\n";
		}
	
	}
	
	if(form.date2.value == '')
	{
		valide = false;
		str += '- Le deuxieme champ date est vide.\n';
	}
	else if(form.date2.value.search(/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/) == -1)
	{
		valide = false;
		str += "- Le deuxieme champ date n'est pas au bon format JJ/MM/AAAA ex:01/01/2009.\n";
	}
	else
	{
		var d = form.date2.value.split("/");
		if(!Est_Valide(parseFloat(d[0]), parseFloat(d[1]), parseFloat(d[2])))
		{
			valide = false;
			str += "- La deuxieme date est invalide.\n";
		}
	
	}
	
	function bisx(annee) {

		 if ((annee % 100 == 0) && (annee % 400 == 0)) 
			return true;
		 else if ((annee % 4) == 0) 
			return true;
		 
		 return false;
		 
	}

	function Est_Valide(jour, mois, annee){
	
		var jm = Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if(bisx(annee))
		{
			jm[1] = 29;
		}
		
		if( (mois < 1) || (mois > 12) )
		{	
			return false;
		}
			
		if( (jour < 1) || (jour > jm[mois-1]) )
		{
			return false;
		}	
		
		return true;
	
	}
	
	function Date_Compris_Entre(){
	
		var d1 = form.date1.value.split("/");
		var d2 = form.date2.value.split("/");
		
		if(d2[2] < d1[2])
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] < d1[1]) )
			return false;
		else if( (d2[2] == d1[2]) && (d2[1] == d1[1]) && (d2[0] < d1[0]) )
			return false;
			
		return true;
	
	}
	
	if(valide && !Date_Compris_Entre())
	{
		valide = false;
		str += "- La deuxieme date doit etre superieur a la premiere date.\n";
	
	}
	
	if(valide)
	{

		new Ajax.Request(
			'evolution_demande_ajax.php',
			{
				method: 'post',
				parameters: {ajax:'ajax', service:document.getElementById("service").value, date1:document.getElementById('date1').value, date2:document.getElementById('date2').value},
				onSuccess: function(http) {
					
					document.getElementById('evolution_dem').innerHTML = http.responseText;
					
				}
			}
		);
		
	}
	else
	{
		alert(str);
	
	}



}


function Diagramme_pagination_division_ev(page, date1, date2, division, choix){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, division:division, choix:choix, sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_pagination_service_ev(page, date1, date2, service){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, service:service, choix:'service', sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_changer_type_div_ev(page, date1, date2, division, choix){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, division:division, choix:choix, sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}

function Diagramme_changer_type_ser_ev(page, date1, date2, service){

	var sel_type = document.getElementById('sel_type').value;

	new Ajax.Request(
		'diagramme_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax_d:'ajax', page:page, date1:date1, date2:date2, service:service, choix:'service', sel_type:sel_type},
			onSuccess: function(http) {
				
				document.getElementById('zone_diag_conso').innerHTML = http.responseText;
				
			}
		}
	);


}


function Camembert_ev_division(date1, date2, division, val, choix){

	new Ajax.Request(
		'camembert_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_ev_service(date1, date2, service, val){

	new Ajax.Request(
		'camembert_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:'service'},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}


function Camembert_ev_division_etat(date1, date2, division, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;
		
	var som_qte = document.getElementById('som_qte').value;
	
	new Ajax.Request(
		'camembert_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, division:division, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr, sel_som_qte:som_qte},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}

function Camembert_ev_service_etat(date1, date2, service, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;
		
	var som_qte = document.getElementById('som_qte').value;

	new Ajax.Request(
		'camembert_evolution_dem.php',
		{
			method: 'post',
			parameters: {ajax:'ajax', date1:date1, date2:date2, service:service, val:val, choix:choix, etat:etat.value, sel_tr:sel_tr, sel_som_qte:som_qte},
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}


function Camembert_ev_zoom(date1, date2, ds, val, choix){

	var etat = document.getElementById('etat');
	
	var sel_tr = 0;
	if(etat.value == 3)
		sel_tr = document.getElementById('selection').value;
		
	var som_qte = document.getElementById('som_qte').value;
		
	var param = 'ajax=ajax' + '&zoom=zoom' +  '&date1=' + date1 + '&date2=' + date2 + '&val=' + val +  '&choix=' + choix + '&etat=' + etat.value + '&sel_tr=' + sel_tr + '&sel_som_qte=' + som_qte;
	if((choix == 'division') || (choix == 'division_service'))
		param += '&division=' + ds;
	else if(choix == 'service')
		param += '&service=' + ds;
		
	new Ajax.Request(
		'camembert_evolution_dem.php',
		{
			method: 'post',
			parameters: param,
			onSuccess: function(http) {
				//alert(http.responseText);
				document.getElementById('zone_cam').innerHTML = http.responseText;
				
			}
		}
	);



}


function Supprimer_division_archive(){

	if(confirm('Voulez - vous vraiment supprimer cette division des archives ?'))
		return true;
	else	
		return false

}







