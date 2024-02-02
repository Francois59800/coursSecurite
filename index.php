
<!-- 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        injection SQL
    </h1>





</body>
</html>
-->
 
<!-- 
// if(isset($_POST['sigin'])){
// echo('hello world');
// } 
// $_POST[''] -->

<!-- Version sans protecion : -->

<?php
 /*
if(isset($_POST['signin'])){
    
    $pdo = new PDO("mysql:host=localhost;dbname=securite", 'root', '');
    $login = $_POST['username'];
    $pwd = $_POST['password'];
    $selectall = $pdo->query("select * from user where login = '$login' AND password='$pwd'");
    $result = $selectall->fetch();
    $counttable = count((is_countable($result)?$result:[]));
    if($counttable != 0){
        echo 'connexion réussie';
    }
    else{
        echo 'utilisateur non reconnu';
    }
}
*/
?>


<!--version avec protection -->

<?php

if (isset($_POST['signin'])) {

    $pdo = new PDO("mysql:host=localhost;dbname=securite", 'root', '');

    // Utilisation de la fonction trim pour enlever les espaces inutiles
    $login = trim($_POST['username']);
    $pwd = trim($_POST['password']);

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':password', $pwd, PDO::PARAM_STR);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification des résultats
        if ($result) {
            echo 'connexion réussie';
        } else {
            echo 'utilisateur non reconnu';
        }
    } else {
        // Gestion de l'erreur d'exécution de la requête
        echo 'Une erreur est survenue lors de la tentative de connexion.';
    }
}

?>
<?php

if (isset($_POST['signin'])) {

    $pdo = new PDO("mysql:host=localhost;dbname=securite", 'root', '');

    // Utilisation de la fonction trim pour enlever les espaces inutiles
    $login = trim($_POST['username']);
    $pwd = trim($_POST['password']);

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':password', $pwd, PDO::PARAM_STR);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification des résultats
        if ($result) {
            echo 'connexion réussie';
        } else {
            echo 'utilisateur non reconnu';
        }
    } else {
        // Gestion de l'erreur d'exécution de la requête
        echo 'Une erreur est survenue lors de la tentative de connexion.';
    }
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 80px;
        }

        .login-container {
            max-width: 300px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #5b401b;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Injection SQL</h1>

    <div class="login-container">
        <h2>Login</h2>
        <form action="#" method="post">
            <label for="username">Nom utilisateur :</label>
            <input type="text" id="username" name="username" placeholder="Entrer votre nom" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" >

            <button type="submit"name="signin">soumettre</button>
        </form>
        <p> Essayer avec le login <strong>' OR 1=1 OR 1='<strong> : la connexion fontionne:-(</p>
    </div>
</body>

</html>