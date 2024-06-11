<?php
session_start();

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

if ($_POST['cts'] && $_POST['adm']){
    $opciones = [
        'host' => 'zend-alrigu.fjeclot.net',
        'username' => "cn=admin,dc=fjeclot,dc=net",
        'password' => 'clottfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opciones);
    $dn='cn='.$_POST['adm'].',dc=fjeclot,dc=net';
    $ctsnya=$_POST['cts'];
    try{
        $ldap->bind($dn,$ctsnya);
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $_POST['adm'];
        header("location: menu.php");
        exit;
    } catch (Exception $e){
        echo "<b>Contrasenya incorrecta</b><br><br>";
    }
}
?>
<html>
	<head>
		<title>
			AUTENTICACIÓ AMB LDAP 
		</title>
	</head>
	<body>
		<a href="http://localhost/crud_ldap/menu.php">Torna a la pàgina inicial</a>
	</body>
</html>
