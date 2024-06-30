function validerFormVide(formulaire){
		donnees=$('#' + formulaire).serialize();
		d=donnees.split('&');
		vide=0;
		for(i=0;i< d.length;i++){
				controles=d[i].split("=");
				if(controles[1]=="A" || controles[1]==""){
					vide++;
				}
		}
		return vide;
	}