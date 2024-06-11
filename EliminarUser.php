<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.php");
    exit;
};

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $unorg = $_POST['unidad'];
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    
    $opciones = [
        'host' => 'zend-alrigu.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opciones);
    $ldap->bind();
    
    try {
        $ldap->delete($dn);
        echo "<b>Entrada eliminada</b><br>";
    } catch (Exception $e) {
        echo "<b>Esta entrada no existe</b><br>";
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    UID: <input type="text" name="uid"><br><br>
    Unidad Organizativa: <input type="text" name="unidad"><br><br>
    <input type="submit" value="Eliminar Usuario">
    <br><br>
    <h4><a href="http://localhost/crud_ldap/menu.php">Tornar al Menu</a></h4>
</form>
