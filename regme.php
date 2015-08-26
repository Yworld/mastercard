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
	background: repeat-y #99FF99;
	margin-left: 15px;
	margin-right: 15px;
	}
</style>
<div id="hat"><table><tr><td><img src="http://images.all-free-download.com/images/graphiclarge/mastercard_logo_29764.jpg" width="80px"></td><td><a style="color:#000000;" href="help.php">Помощь</a></td></tr></table></div></br>
<?php
$magic = array("'",'"');
$reg = $_POST['reg'];
$ip = $_SERVER["REMOTE_ADDR"];
$name = $_POST["name"];
$name = str_replace($magic,"",$name);
$cvc = $_POST["cvc"];
$cvc = str_replace($magic,"",$cvc);
$email = $_POST["mail"];
$email = str_replace($magic,"",$email);
echo("<script>
console.log('{$reg}{$name}{$cvc}{$email}');
</script>");
if(!$reg){
goto end;
}
if(!$name){
exit('<div id="warning">Введите имя!</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/regme.php">
<input type="text" class="form-control" name="name" placeholder="ФИО">
<input type="email" class="form-control" placeholder="E-mail" name="mail">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="hidden" name="reg" value="649385">
<input type="submit" class="btn btn-primary btn-lg btn-block" value="Регистрация">
</form>
</div>');
}
if(!$email){
exit('<div id="warning">Введите e-mail!</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/regme.php">
<input type="text" class="form-control" name="name" placeholder="ФИО">
<input type="email" class="form-control" placeholder="E-mail" name="mail">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="hidden" name="reg" value="649385">
<input type="submit" class="btn btn-primary btn-lg btn-block" value="Регистрация">
</form>
</div>');
}
if(!ctype_digit($cvc)){
exit('<div id="warning">CVC должен состоять из 3 цифр!</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/regme.php">
<input type="text" class="form-control" name="name" placeholder="ФИО">
<input type="email" class="form-control" placeholder="E-mail" name="mail">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="hidden" name="reg" value="649385">
<input type="submit" class="btn btn-primary btn-lg btn-block" value="Регистрация">
</form>
</div>');
} elseif($cvc>999) {
exit('<div id="warning">CVC должен состоять из 3 цифр!</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/regme.php">
<input type="text" class="form-control" name="name" placeholder="ФИО">
<input type="email" class="form-control" placeholder="E-mail" name="mail">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="hidden" name="reg" value="649385">
<input type="submit" class="btn btn-primary btn-lg btn-block" value="Регистрация">
</form>
</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISC FROM comfortcard WHERE IP='$ip';")) {

$stmt->execute();

$stmt->bind_result($isip);

$stmt->fetch();

$stmt->close();
}
if($isip){
echo('<div id="warning">Для регистрации второй карты обратитесь в сервисный центр.</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</div>
</form>
</center>');
} else {
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("INSERT INTO comfortcard(NAME,CVV,EMAIL,IP,LOGO) VALUES('$name','$cvc','$email','$ip','http://images.all-free-download.com/images/graphiclarge/mastercard_logo_29764.jpg');")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT `NUM` FROM`comfortcard` WHERE `IP`='$ip';")) {

$stmt->execute();

$stmt->bind_result($number);

$stmt->fetch();

$stmt->close();
}
printf('<div id="ok">Номер Вашего счёта-%s</div>
<center>
<div class="utm-patented" style="width:301px;">
<form method="POST" action="/cabinet.php">
<input type="text" class="form-control" name="num" placeholder="Номер счёта">
<input type="password" class="form-control" placeholder="CVC2" name="cvc"></br>
<input type="submit" class="btn btn-success btn-lg btn-block" value="Вход">
</div>
</form>
</center>',$number);
}
end:
?>