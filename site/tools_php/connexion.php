<?php 
//Exemple de connexion
//se connecter à la base de données
$hostname="localhost";
$username="clementgerson";
$password="2801";
$dbname='clementgerson';
$usertable="tablecontenu";

echo "bonjourdimitri <br/>";

$pdo = new PDO('mysql:host='.$hostname.';port=3306;dbname='.$dbname.'', $username, $password);
$pdo->exec("SET CHARACTER SET utf8");
$stmt = $pdo->prepare("SELECT * FROM tablecontenu");
$stmt->execute();
$res = $stmt->fetchAll();
var_dump($res);
foreach ( $res as $row ) {
	echo "<br/>";
	echo $row['Titre'];
	echo "<br/>";
	echo $row["Sujet"];
	echo "<br/>";
}
$pdo = null;
try {
$pdo = new PDO('mysql:host='.$hostname.';port=3306;dbname='.$dbname.'', $username, $password);
$pdo->exec("SET CHARACTER SET utf8");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS post ( id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, titre VARCHAR(100),date DATE,texte VARCHAR(255))");
$stmt->execute();
echo "Table post créée !";
}
catch(PDOException $e) {
	echo "Erreur : " . $e->getMessage();
}
try {
	$pdo = new PDO('mysql:host='.$hostname.';port=3306;dbname='.$dbname.'',$username, $password);
	$pdo->exec("SET CHARACTER SET utf8");
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$stmta = $pdo->prepare("INSERT INTO post (titre,date,texte) VALUES ('bob',NOW(),'lolo')");
	$stmta->execute();
	echo "Nouvelle ligne dans la table post !";
}
catch(PDOException $e) {
	echo "Erreur : " . $e->getMessage() . "<br/>";
}
try {
	$pdo = null;
	$pdo = new PDO('mysql:host='.$hostname.';port=3306;dbname='.$dbname.'',$username, $password);
	$pdo->exec("SET CHARACTER SET utf8");
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare("SELECT * FROM post");
	$stmt->execute();
	echo "Requête executée ! <br/>";
	$liste =$stmt->fetchAll();
	foreach ($liste as $row) {
		echo "<br/>" .$row[titre]. " " .$row[texte]. " " .$row[date]."<br/>";
	}
}
catch(PDOException $e) {
	echo "Erreur : " . $e->getMessage() . "<br/>";
}

$con =new mysqli('localhost','clementgerson','2801');
if ($con ->connect_error) {
	die("Connection failed:" . $con->connect_error);
}
echo "Connected successfully<br/>";

#or die ("<html>script language='JavaScript'>alert('Impossible de se connecter à la base de données ! Réessayez plus tard.'),history.go(-1)/script></html>");
var_dump($con);
mysqli_select_db("clementgerson", $con);
echo "bonjour <br/>";
# Vérifier si des enregistrements existent

$query = "SELECT Titre FROM tablecontenu";

$result = $con->query("SHOW TABLES");
echo "<br/>";
	
var_dump($result);
echo "bob";
if($result){
	while($row = mysqli_fetch_array($result)){
		$name = $row[0];
		echo "Name: ".$name."<br/>";
		}
	}	
?>

