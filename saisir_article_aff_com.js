var action1 = '';
var action2 = '';

Ext.onReady(function(){

	 action1 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
        handler:function(){
		 
			Ajouter_conso_type_commande_modif();
		 
		}
    });
	
	action2 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
		handler:function(){
		 
			Ajouter_conso_ref_des_comm_modif();
		 
		}
    });
	
	

	
	var form_pan = new Ext.FormPanel({
		region:'north',
		id:'form_pan',
		frame: true,
		collapsible:true,
		labelWidth: 100,
		items:[{
			
			xtype: 'textfield',
			fieldLabel: 'Num commande',
			id: 'num_com', 
			name: 'num_commande', 
			width:200
												
		},
		{
			xtype:'datefield',
			id: 'date_com',
			fieldLabel: 'Date',
			format:'d/m/Y',
			readOnly:true
		
		}]
			
	});

	
	

	var p = new Ext.Panel({
		title: 'Modifier ou supprimer votre Commande',
        collapsible:false,
        renderTo: 'commande',
	    width:575,
		height:218,
		labelAlign: 'left',
		items:[
			form_pan,  
			new Ext.TabPanel({
				region:'south',
				renderTo: 'tab_conso',
				width:575,
				height:128,
				activeTab: 0,
				frame:true,
				deferredRender:false,
				items:[
					{contentEl:'conso_type',
					 title: 'Type',
					 items:
					 {
						region:'center',
						title: 'Choisir le consommable par type',
						collapsible:false,
						renderTo: 'conso_type',
						height:100,
						autoLoad:'choisir_type.php',
						bbar:[action1]
						
					 }
					},
					{contentEl:'conso_ref_des', 
					 title: 'Reference',
					 items:
					 {
						region:'center',
						title: 'Choisir le consommable par la reference ou la designation',
						collapsible:false,
						renderTo: 'conso_ref_des',
						height:100,
						autoLoad:'choisir_ref_des_com_modif.php',
						bbar:[action2]
						
					 }
					 
					}
				]
			})//fin tabpannel
		]//fin item
        
    });
	
	Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
	Ext.get('date_com').dom.value = document.getElementById('date_comh').value;
	
	Ext.get('num_com').on('blur', function(){
			
			if(Ext.get('num_com').getValue().search(/^[A-Z0-9\-]+$/) == -1)
			{
				alert('Numero de commande incorrect format:Lettre majuscule + chiffre + tiret');
				Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
								
			}
			else if(Ext.get('num_com').getValue().length > 50)
			{
				alert('Numero de commande trop grand');
				Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
								
			}
			else
			{
			
				if(Ext.get('num_com').dom.value != document.getElementById('num_comh').value)
				{
			
					new Ajax.Request(
						'test_num_commande_modif.php',
						{
							method: 'post',
							parameters: {ajax:'ajax', nouv_num_com:document.getElementById('num_com').value, num_com:document.getElementById('num_comh').value},
							onSuccess: function(http) {
							
								var rep = eval('(' + http.responseText + ')');
								if(rep.res == 'impossible')
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
									
									fen_modif.show();
									
									var str = '<div class="boite_mess_val">Vous ne pouvez pas modifier la reference de ce consommable :';
									str += '<ul><li>car cette commande correspond a une livraison</li></ul></div>';
									fen_modif.body.dom.innerHTML = str;
																	
									setTimeout(function(){
													fen_modif.close();
													
												},5000);
												
									Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
									
									
								}
								else if(rep.res == 'libre')
								{
									new Ajax.Request(
										'conso_commande_modif.php',
										{
											method: 'post',
											parameters: {ajax:'ajax', maj_num_com:Ext.get('num_com').dom.value, num_com:document.getElementById('num_comh').value},
											onSuccess: function(http) {
												
												document.getElementById('num_comh').value = Ext.get('num_com').dom.value;
																															
											},
											onFailure: function(){
											
												alert('Erreur lors de la validation du nouveau numero');
												Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
									
											
											}
										}
									);
								
								}
								else if(rep.res == 'pris')
								{
									alert('Le numero de commande est deja pris');
									Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
								}
								
																
							},
							
							onFailure : function(){
								
								alert("Erreur lors de la validation du numero de commande");
								Ext.get('num_com').dom.value = document.getElementById('num_comh').value;
									
								
							}
							
						}
					);
					
				}
			
			
			}
			
			
	});
	
		
	Ext.get('date_com').on('mousedown', function(){
			
			alert('Choisissez la date en cliquant sur le bouton date a cote du champ');
			
	});

	Ext.get('date_com').on('blur', function(){
			
			new Ajax.Request(
				'conso_commande_modif.php',
				{
					method: 'post',
					parameters: {ajax:'ajax', maj_date_com:Ext.get('date_com').dom.value, num_com:document.getElementById('num_comh').value},
					onSuccess: function(http) {
						
						document.getElementById('date_comh').value = Ext.get('date_com').dom.value;
																									
					},
					onFailure: function(){
					
						alert('Erreur lors de la validation de la nouvelle date de commande');
						Ext.get('date_com').dom.value = document.getElementById('date_comh').value;
					}
				}
			);
			
	});
	
	
		
	/*
	new Ext.dd.DragZone(Ext.get('zone_liste_conso'), {

//      On receipt of a mousedown event, see if it is within a draggable element.
//      Return a drag data object if so. The data object can contain arbitrary application
//      data, but it should also contain a DOM element in the ddel property to provide
//      a proxy to drag.
        getDragData: function(e) {
            var sourceEl = e.getTarget('.class_zone_liste_conso');
            if (sourceEl) {
                d = sourceEl.cloneNode(true);
                d.id = Ext.id();
                return {
                    sourceEl: sourceEl,
                    repairXY: Ext.fly(sourceEl).getXY(),
                    ddel: d
                    
                }
            }
        },

//      Provide coordinates for the proxy to slide back to on failed drag.
//      This is the original XY coordinates of the draggable element.
        getRepairXY: function() {
            return this.dragData.repairXY;
        }
    });
	*/
	
	
	
	
/*
    var tabs = new Ext.TabPanel({
        renderTo: 'tab_conso',
        width:575,
		height:128,
        activeTab: 0,
        frame:true,
		deferredRender:false,
		items:[
            {contentEl:'conso_type',
			 title: 'Type',
			 items:
			 {
				region:'center',
				title: 'Choisir le consommable par type',
				collapsible:false,
				renderTo: 'conso_type',
				height:100,
				autoLoad:'choisir_type.php',
				bbar:[{
					 text: 'Ajouter le consommable',
					 cls:'tool_bout',
					 handler:function(){
					 
						alert(document.getElementById('num_com').value);
					 
					 }
				
				}]
				
			 }
			},
			{contentEl:'conso_ref_des', 
			 title: 'Reference',
			 items:
			 {
				region:'center',
				title: 'Choisir le consommable par la reference ou la designation',
				collapsible:false,
				renderTo: 'conso_ref_des',
				height:100,
				autoLoad:'choisir_ref_des.php',
				bbar:[{
					 text: 'Ajouter le consommable',
					 cls:'tool_bout',
					 handler:function(){
					 
						alert('oui');
					 
					 }
				
				}]
				
			 }
			 
			}
        ]
    });
	*/
	
});

