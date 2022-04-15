var action1 = '';
var action2 = '';

Ext.onReady(function(){

	 action1 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
        handler:function(){
		 
			Ajouter_conso_type_livraison_modif();
		
		 
		}
    });
	
	/*action2 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
		handler:function(){
		 
			Ajouter_conso_ref_des_livr_modif();
		 
		}
    });
	
	var tab_com;
	//requete synchrone 
	new Ajax.Request(
		'json_commande.php',
		{
			asynchronous:false,
			method: 'post',
			parameters: {ajax:'ajax'},
			onSuccess: function(http) {
				//alert(http.responseText);
				var rep = eval('(' + http.responseText + ')');
				tab_com = rep.commande;
								
			},
			
			onFailure: function(http) {
				
				tab_com = [['Aucune'], ['Aucune']];
				alert('Erreur lors du chargement des numeros de commandes');
								
			}
			
			
		}
	);
	
	var store = new Ext.data.SimpleStore({
        fields: ['num_com', 'numero_com'],
        data : tab_com 
    });
	
	var comb = new Ext.form.ComboBox({
		id:'num_com_livr',
		store: store,
		fieldLabel: 'Num commande',
		typeAhead: true,
		forceSelection: false,
		triggerAction: 'all',
		displayField:'numero_com',
		valueField:'num_com',
		mode:'local',
		//editable:false,
		hiddenId:'num_comm',
		//emptyText:'Choisissez un num de commande',
		selectOnFocus:true,
		width:200
	});
   */
	
	var form_pan = new Ext.FormPanel({
		region:'north',
		id:'form_pan',
		frame: true,
		collapsible:true,
		labelWidth: 100,
		items:[{
			
			xtype: 'textfield',
			fieldLabel: 'Num livraison',
			id: 'num_livr', 
			name: 'num_commande', 
			width:200
												
		},
		{
			xtype:'datefield',
			id: 'date_livr',
			fieldLabel: 'Date',
			format:'d/m/Y',
			readOnly:true
		
		}
		]
			
	});

	var pan_c = new Ext.Panel({
		region:'center',
		title: 'Choisir le consommable en fonction du n° de commande',
		collapsible:false,
		renderTo: 'conso_type',
		height:100,
		autoLoad:'choisir_conso_livraison_modif.php?num_com=' + document.getElementById('num_com_livrh').value,
		bbar:[action1]
	
	
	});
	
	
	

	var p = new Ext.Panel({
		title: 'Modifier ou supprimer votre Livraison',
        collapsible:false,
        renderTo: 'commande',
	    width:575,
		height:190,
		labelAlign: 'left',
		items:[
			form_pan,  
			pan_c
		]//fin item
        
    });
	
	Ext.get('num_livr').dom.value = document.getElementById('num_livrh').value;
	Ext.get('date_livr').dom.value = document.getElementById('date_livrh').value;
	//Ext.get('num_com_livr').dom.innerHTML  = document.getElementById('num_com_livrh').value;
	
	Ext.get('num_livr').on('blur', function(){
		
		if(Ext.get('num_livr').getValue().search(/^[A-Z0-9\-]+$/) == -1)
		{
			alert('Numero de commande incorrect format:Lettre majuscule + chiffre + tiret');
			Ext.get('num_livr').dom.value = '';
		}
		else if(Ext.get('num_livr').getValue().length > 50)
		{
			alert('Numero de commande trop grand');
			Ext.get('num_livr').dom.value = '';
		}
		else
		{
		
			if(Ext.get('num_livr').dom.value != document.getElementById('num_livrh').value)
			{
		
				new Ajax.Request(
					'test_num_livraison.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', num_livr:document.getElementById('num_livr').value},
						onSuccess: function(http) {
						
							var rep = http.responseText;
							if(rep == 'libre')
							{
								new Ajax.Request(
									'conso_livraison_modif.php',
									{
										method: 'post',
										parameters: {ajax:'ajax', maj_num_livr:Ext.get('num_livr').dom.value, num_livr:document.getElementById('num_livrh').value},
										onSuccess: function(http) {
											
											document.getElementById('num_livrh').value = Ext.get('num_livr').dom.value;
																														
										},
										onFailure: function(){
										
											alert('Erreur lors de la validation du nouveau numero');
											Ext.get('num_livr').dom.value = document.getElementById('num_livrh').value;
								
										
										}
									}
								);
							
							}
							else if(rep == 'pris')
							{
								alert('Le numero de commande est deja pris');
								Ext.get('num_livr').dom.value = document.getElementById('num_livrh').value;
							}
							
															
						},
						
						onFailure : function(){
							
							alert("Erreur lors de la validation du numero de commande");
							Ext.get('num_livr').dom.value = document.getElementById('num_livrh').value;
								
							
						}
						
					}
				);
				
			}
		
		
		}
			
			
	});
	
		
	Ext.get('date_livr').on('mousedown', function(){
			
			alert('Choisissez la date en cliquant sur le bouton date a cote du champ');
			
	});
	
	Ext.get('date_livr').on('blur', function(){
	
			if(Ext.get('date_livr').dom.value != document.getElementById('num_livrh').value)
			{
			
				new Ajax.Request(
					'conso_livraison_modif.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', maj_date_livr:Ext.get('date_livr').dom.value, num_livr:document.getElementById('num_livrh').value},
						onSuccess: function(http) {
							
							document.getElementById('date_livrh').value = Ext.get('date_livr').dom.value;
																										
						},
						onFailure: function(){
						
							alert('Erreur lors de la validation de la nouvelle date de livraison');
							Ext.get('date_livr').dom.value = document.getElementById('date_livrh').value;
						}
					}
				);
			
			}
			
	});
	
	/*
	Ext.get('num_com_livr').on('blur', function(){
	
			if(Ext.get('num_com_livr').dom.value != document.getElementById('num_com_livrh').value)
			{
			
				new Ajax.Request(
					'conso_livraison_modif.php',
					{
						method: 'post',
						parameters: {ajax:'ajax', maj_num_com_livr:Ext.get('num_com_livr').dom.value, num_com_livr:document.getElementById('num_com_livrh').value, num_livr:document.getElementById('num_livrh').value},
						onSuccess: function(http) {
							
							document.getElementById('num_com_livrh').value = Ext.get('num_com_livr').dom.value;
																										
						},
						onFailure: function(){
						
							alert('Erreur lors de la validation de la nouvelle date de livraison');
							Ext.get('num_com_livr').dom.value = document.getElementById('num_com_livrh').value;
						}
					}
				);
			
			}
			
	});
	*/
	
	
	
});

