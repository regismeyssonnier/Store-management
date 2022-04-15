Ext.onReady(function(){
					 
	 action1 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
        handler:function(){
		 
			Ajouter_conso_eff_dem_select();
		 
		}
    });
	
	action2 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
		handler:function(){
		 
			Ajouter_conso_eff_dem_impr();
		 
		}
    });
	
	action3 = new Ext.Action({
        text: 'Ajouter le consommable',
		cls:'tool_bout',
		handler:function(){
		 
			Ajouter_conso_eff_dem_liste();
		 
		}
    });
	
	
	var p = new Ext.Panel({
		title: 'Effectuer votre demande',
        collapsible:false,
        renderTo: 'demande',
	    width:575,
		height:153,
		items:[
			new Ext.TabPanel({
				region:'center',
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
					{contentEl:'conso_impr',
					 title: 'Imprimante',
					 items:
					 {
						region:'center',
						title: "Choisir le consommable en fonction de l'imprimante",
						collapsible:false,
						renderTo: 'conso_impr',
						height:100,
						autoLoad:'choisir_impr.php',
						bbar:[action2]
						
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
						autoLoad:'choisir_ref_des_dem.php',
						bbar:[action3]
						
					 }
					 
					}
				]
			})//fin tabpannel
		]//fin item
        
    });















});