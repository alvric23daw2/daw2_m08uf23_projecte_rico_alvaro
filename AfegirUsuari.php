php
Copiar código
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $num_id = $_POST['num_id'];
    $grup = $_POST['grup'];
    $dir_pers = $_POST['dir_pers'];
    $sh = $_POST['sh'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['nom'];
    $mobil = $_POST['mobil'];
    $adressa = $_POST['adressa'];
    $telefon = $_POST['telefon'];
    $titol = $_POST['titol'];
    $descripcio = $_POST['descripcio'];
    $objcl = ['inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top'];
    
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-alrigu.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);

    try {
        $ldap->bind();
        
        $nova_entrada = [];
        Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
        Attribute::setAttribute($nova_entrada, 'uid', $uid);
        Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
        Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
        Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
        Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
        Attribute::setAttribute($nova_entrada, 'cn', $cn);
        Attribute::setAttribute($nova_entrada, 'sn', $sn);
        Attribute::setAttribute($nova_entrada, 'givenName', $nom);
        Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
        Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
        Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
        Attribute::setAttribute($nova_entrada, 'title', $titol);
        Attribute::setAttribute($nova_entrada, 'description', $descripcio);
        
        $dn = 'uid='.$uid.',ou=usuaris,dc=fjeclot,dc=net';
        
        if ($ldap->add($dn, $nova_entrada)) {
            echo "Usuario creado correctamente";
        } else {
            echo "Error al crear el usuario";
        }
    } catch (\Laminas\Ldap\Exception\LdapException $e) {
        echo "Error al conectar con LDAP: " . $e->getMessage();
    }
}
?>

<html>
<head>
    <title>Añadir usuario</title>
</head>
<body>
    <h2>Añadir usuario</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Form fields -->
        <label for="uid">UID:</label>
        <input type="text" id="uid" name="uid" required><br><br>
        
        <label for="num_id">uidNumber:</label>
        <input type="text" id="num_id" name="num_id" required><br><br>
        
        <label for="grup">gidNumber:</label>
        <input type="text" id="grup" name="grup" required><br><br>
        
        <label for="dir_pers">homeDirectory:</label>
        <input type="text" id="dir_pers" name="dir_pers" required><br><br>
        
        <label for="sh">loginShell:</label>
        <input type="text" id="sh" name="sh" required><br><br>
        
        <label for="cn">cn:</label>
        <input type="text" id="cn" name="cn" required><br><br>
        
        <label for="sn">sn:</label>
        <input type="text" id="sn" name="sn" required><br><br>
        
        <label for="nom">givenName:</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="mobil">mobile:</label>
        <input type="text" id="mobil" name="mobil" required><br><br>
        
        <label for="adressa">postalAddress:</label>
        <input type="text" id="adressa" name="adressa" required><br><br>
        
        <label for="telefon">telephoneNumber:</label>
        <input type="text" id="telefon" name="telefon" required><br><br>
        
        <label for="titol">title:</label>
        <input type="text" id="titol" name="titol" required><br><br>
        
        <label for="descripcio">description:</label>
        <input type="text" id="descripcio" name="descripcio" required><br><br>
        
        <input type="submit" value="Añadir usuario">
    </form>
    <br><br>
    <h4><a href="http://localhost/crud_ldap/menu.php">Tornar al Menu</a></h4>
</body>
</html>
