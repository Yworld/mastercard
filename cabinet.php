<!DOCTYPE HTML>
<title>MasterCard</title>
<meta charset="utf-8">
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
	background: repeat-y #99FF99;
	margin-left: 15px;
	margin-right: 15px;
	}
</style>
<div id="hat"><table><tr><td><a href="/"><img src="http://images.all-free-download.com/images/graphiclarge/mastercard_logo_29764.jpg" width="80px"></a></td><td><a style="color:#000000;" href="help.php">Помощь</a></td></tr></table></div></br>
<?php
$magic = array("'",'"');
$num = $_POST['num'];
$num = str_replace($magic,"",$num);
$cvc = $_POST['cvc'];
$cvc = str_replace($magic,"",$cvc);
if(!$num){
exit('<div id="warning">Нет номера счёта</div><center><div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div></center>');
}
if(!$cvc){
exit('<div id="warning">Нет CVC!</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div>
</center>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISC FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($isnum);

$stmt->fetch();

$stmt->close();
}
if(!$isnum){
exit('<div id="warning">Такого счёта не существует.</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div>
</center>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT CVV FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($cvv);

$stmt->fetch();

$stmt->close();
}
if($cvc!=$cvv){
exit('<div id="warning">CVC2 неверен.</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div>
</center>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT BLOCK FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($isblock);

$stmt->fetch();

$stmt->close();
}
if($block>0){
exit('<div id="warning">Ваш счёт заблокирован.</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="button" class="btn btn-primary btn-lg btn-block" onclick="loadreg();" value="Регистрация">
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</form>
</div>
</center>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EURO FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($eur);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("INSERT INTO sessions(NUM,CVV) VALUES('$num','$cvc');")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT SID FROM sessions WHERE NUM='$num' ORDER BY SID LIMIT 0,1;")) {

$stmt->execute();

$stmt->bind_result($sid);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISS FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($iss);

$stmt->fetch();

$stmt->close();
}
if($iss==1){
goto iss;
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT SERVICES FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($services);

$stmt->fetch();

$stmt->close();
}
echo("<center><h2>{$eur} EUR</h2></center>");
?>
<center>
<div class="btn-group" role="toolbar" aria-label="Card options">
<input type="button" class="btn btn-primary" value="C2C" onclick="loadc2c();">
<input type="button" class="btn btn-primary" value="Дополнительно" onclick="sup();">
<button class="btn btn-primary" onclick="pop();">Пополнение <img src="http://budus.pl/images/layout/hit-icon.gif" width="15px" height="15px"></button>
<?php
if($services<3){
echo('<input type="button" class="btn btn-primary" onclick="newservice();" value="Новая услуга">');
} else {
echo('<input type="button" class="btn btn-primary disabled" value="Новая услуга">');
}
?>
</div>
</center>
</br><center>
<div id="program-window" style="width:400px; height:300px;">
</div>
</center>
<script>
function loadc2c()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/c2c.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
<?php
echo("xmlhttp.send('sid={$sid}');");
?>
var some = 1;
}
function j()
{
if(some==1){
co();
} else {
}
}
function co()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/null.txt",true);
xmlhttp.send();
var some = 0;
}
<?php
echo("var sid = {$sid};\r");
?>
function c2c()
{
var to = document.getElementById("to").value;
var sum = document.getElementById("sum").value;
var cvc = document.getElementById("cvc").value;
var comm = document.getElementById("comm").value;
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
    document.getElementById("transfer").innerHTML=xmlhttp.responseText;
    }
  }
var request = "sid=" + sid + "&to=" + to + "&sum=" + sum + "&cvc=" + cvc + "&comm=" + comm;
xmlhttp.open("POST","/c2check.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(request);
}
function newservice()
{
if(some==1){
co();
} else {
}
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/newservice.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("sid=" + sid);
var some = 1;
}
function makeservice()
{
var name = document.getElementById('n').value;
var logo = document.getElementById('l').value;
console.log(name);
console.log(logo);
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/makeservice.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid + "&name=" + name + "&logo=" + logo;
xmlhttp.send(request);
}
function history()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/history.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function hto()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/hto.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function sup()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/sup.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function support()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/support.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function my()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/myq.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function sendq()
{
var theme = document.getElementById('theme').value;
var quest = document.getElementById('qi').value;
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/sup3.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid + "&theme=" + theme + "&q=" + quest;
xmlhttp.send(request);
}
function viewq(id)
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/qq.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid + "&q=" + id;
xmlhttp.send(request);
}
function vreq()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/vipq.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function faq()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/faq.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
function pop()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/pop.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
function pf()
{
var code = document.getElementById('code').value;
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","pf.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid + "&code=" + code;
xmlhttp.send(request);
}
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
function c2cb()
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
    document.getElementById("program-window").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","/c2m.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var request = "sid=" + sid;
xmlhttp.send(request);
}
</script>
<?php
exit();
iss:
?>
<div class="btn-group" role="toolbar" aria-label="Card options">
<input type="button" class="btn btn-primary" value="S2M" onclick="c2cb();">
<input type="button" class="btn btn-primary" value="История" onclick="hto();">