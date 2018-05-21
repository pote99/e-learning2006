function convalida(miaform) 
{
	if(miaform.username.value=="") 
	{
		alert("manca username");
		return false;
	}
	if(miaform.password.value=="") 
	{
		alert("manca password");
		return false;
	}
	if(miaform.password.value!==miaform.repeat.value) 
	{
		alert("la ripetizione password non corrisponde");
		return false;
	}
	if(miaform.cognome.value=="") 
	{
		alert("manca cognome");
		return false;
	}
	if(miaform.nome.value=="") 
	{
		alert("manca nome");
		return false;
	}
	if(miaform.email.value=="") 
	{
		alert("manca email");
		return false;
	}
	if(miaform.cod_comune.options[miaform.cod_comune.selectedIndex].value=="0000")
	{
		alert("Selezionare il comune di residenza");
		return false;
	}
	if(miaform.cod_istituto.options[miaform.cod_istituto.selectedIndex].value=="0000000000") 
	{
		alert("Selezionare l'istituto");
		return false;
	}
	return true;
}