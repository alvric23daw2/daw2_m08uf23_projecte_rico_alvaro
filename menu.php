<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.php"); 
    exit;
}

?>
<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
		</title>
	</head>
	<body>
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
		<br><br>
		<h3><a href="http://localhost/crud_ldap/VisualizarDatos.php">Visualitzar dades usuari</a></h3>
		<h3><a href="http://localhost/crud_ldap/AfegirUsuari.php">Afegir usuari</a></h3>
		<h3><a href="http://localhost/crud_ldap/EliminarUser.php">Esborrar usuari</a></h3>
		<h3><a href="http://localhost/crud_ldap/ModificarUser.php">Modificar usuari</a></h3>
		<br><br>
		<a href="http://localhost/crud_ldap/index.php">Torna a la pàgina inicial</a>
		<br>
		<a href="logout.php">Cerrar sesión</a>	
	</body>
	
</html>
