<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.php"); 
    exit;
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

$opciones = [
    'host' => 'zend-alrigu.fjeclot.net',
    'username' => 'cn=admin,dc=fjeclot,dc=net',
    'password' => 'clotfje',
    'bindRequiresDn' => true,
    'accountDomainName' => 'fjeclot.net',
    'baseDn' => 'dc=fjeclot,dc=net',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['atributo']) && !empty($_POST['atributo'])) {
        $uid = $_POST['uid'];
        $unorg = $_POST['unidad'];
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        
        $atributo = $_POST['atributo'];
        $nuevo_contenido = $_POST['nuevo_contenido'];
        
        $ldap = new Ldap($opciones);
        $ldap->bind();
        
        $entrada = $ldap->getEntry($dn);
        
        if ($entrada) {
            Attribute::setAttribute($entrada, $atributo, $nuevo_contenido);
            $ldap->update($dn, $entrada);
            echo "Atributo modificado correctamente.";
            echo `<br><br>`;
        } else {
            echo "<b>Esta entrada no existe</b><br><br>";
        }
    } else {
        echo "Por favor, selecciona un atributo a modificar.";
    }
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    UID: <input type="text" name="uid"><br><br>
    Unidad Organizativa: <input type="text" name="unidad"><br><br>
    Atributo a modificar:
    <select name="atributo">
        <option value="uidNumber">uidNumber</option>
        <option value="gidNumber">gidNumber</option>
        <option value="homeDirectory">Directorio personal</option>
        <option value="loginShell">Shell</option>
        <option value="cn">cn</option>
        <option value="sn">sn</option>
        <option value="givenName">givenName</option>
        <option value="postalAddress">Postal Address</option>
        <option value="mobile">mobile</option>
        <option value="telephoneNumber">telephoneNumber</option>
        <option value="title">title</option>
        <option value="description">description</option>
    </select><br><br>
    Nuevo Contenido: <input type="text" name="nuevo_contenido"><br><br>
    <input type="submit" value="Modificar Atributo">
    <br><br>
    <h4><a href="http://localhost/crud_ldap/menu.php">Tornar al Menu</a></h4>
</form>
