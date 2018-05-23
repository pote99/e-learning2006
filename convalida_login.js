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
    return true;
}