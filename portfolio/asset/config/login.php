<?php
include('init.php');
session_start(); 
if (isset($_POST['connecter'])){
    // if (isset($_POST['password'], $_POST['admin'])) {
        $admin = $_POST['admin'];
        $password = $_POST['password'];
        // extract($_POST);
    // Utiliser une requête préparée pour éviter les injections SQL
    $query = "SELECT * FROM admin WHERE nom = :nom";
    $pdostatement = $pdo->prepare($query);
    $pdostatement->bindParam(':nom', $admin, PDO::PARAM_STR);
    $pdostatement->execute();


    $result = $pdostatement->fetch(PDO::FETCH_ASSOC);
    print_r($result);
    var_dump($result);
    if ($result && password_verify($password, $result['password']) && $result['id'] == 1) {
        // Authentification réussie
        $_SESSION['id'] = $result['id'];
        $_SESSION['nom'] = $result['nom'];
        print_r($result);
        var_dump($result);
        header("Location: ./back-office.php"); // Redirection vers la page protégée
        exit();
        // include('../../admin./admin.php');

    } else {
        header("Location: ./../../index.php");
    }
// } else {
//     echo "Veuillez remplir tous les champs du formulaire.";
// }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice</title>
    <link rel="stylesheet" href="../css/components/backstyle.css">
</head>
<body id="loginBody">
    <header>
        <h1>Se Connecter</h1>
        <p><a href="../../index.php" id="portfolioAccess">Accéder au portfolio</a></p>
    </header>
    <section id="bodyForm1" data-aos="zoom-out">
        <div class="boxForm">
            <form method="post" action="">
                <h2 id="contact" style="color:white">Contact</h2>

                <div class="inputBox" id="identifiantForm">
                    <input type="text" name="admin" value="" required>
                    <span>Votre identifiant</span>
                    <i></i>
                </div>

                <div class="inputBox" id="inputBoxMsg">
                    <input type="password" id="passwordForm" name="password" placeholder="" required>
                    <span id="span2">Votre mot de passe</span>
                    <i></i>
                </div>

                <input type="submit" name='connecter' value='Se connecter'>
            </form>
        </div>
    </section>
    <!-- <div id="background"></div> -->
    <script src="../js/back.js"></script>
</body>
</html>



<?
// Pour créer le compte :


// Check if the form is submitted
// if (isset($_POST['connect'])) {
//     // Sanitize and validate user inputs
//     $admin = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
//     $password = filter_var($_POST['mdp'], FILTER_SANITIZE_SPECIAL_CHARS);

//     $success = '';
//     $erreur = '';

//     // Validate admin name
//     if (empty($admin)) {
//         $erreur .= "Veuillez renseigner votre nom";
//     } elseif (strlen($admin) > 75) {
//         $erreur .= "Votre nom est trop long";
//     }

//     // Validate password
//     if (empty($password)) {
//         $erreur .= "Veuillez renseigner votre mot de passe";
//     } else {
//         // Hash the password using PASSWORD_DEFAULT
//         $password = password_hash($password, PASSWORD_DEFAULT);
//     }

//     // If there are no errors, insert into the database
//     if (empty($erreur)) {
//         $req = $pdo->prepare("INSERT INTO admin(id, nom, password) VALUES (null, :nom, :password)");
//         $req->bindParam(':nom', $admin, PDO::PARAM_STR);
//         $req->bindParam(':password', $password, PDO::PARAM_STR);
//         $req->execute();

//         $success .= "Votre compte a bien été créé";
//     } else {
//         // Redirect back to the form with an error message
//         header("Location: votre_page_de_connexion.php?erreur=");
//         exit();
//     }
// }