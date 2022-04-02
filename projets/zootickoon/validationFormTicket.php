<?php
session_start();
$serveur = "localhost";
$port = "3306";
$dbname = "zootickoon";
$user = "root";
$pass = "";


function valid_donnees($donnees){
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}

#var_dump($_POST);
#var_dump($prenom);
#var_dump($mail);
$identifiant = valid_donnees($_POST["identifiant"]);
$sujet = valid_donnees($_POST["sujet"]);
$description = valid_donnees($_POST["description"]);
$priorite = valid_donnees($_POST["priorite"]);
$secteur = valid_donnees($_POST["secteur"]);


    try{
      //On se connecte à la bdd
      $dbco = new PDO("mysql:host=$serveur; port=$port; dbname=$dbname", $user, $pass);
      $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      //On insère les données reçues
      $sth = $dbco->prepare("
        INSERT INTO ticket(identifiant, sujet, description, priorite, secteur)
        VALUES(:identifiant, :sujet, :description, :priorite, :secteur)");
      $sth->bindParam(':identifiant',$identifiant);
      $sth->bindParam(':sujet',$sujet);
      $sth->bindParam(':description',$description);
      $sth->bindParam(':priorite',$priorite);
      $sth->bindParam(':secteur',$secteur);
      $sth-> execute();

      //On renvoie vers la page finformulaire
      header("Location:finformulaire.html");
    }
    catch(PDOException $e){
      echo 'Erreur : '.$e->getMessage();
    }
  /*}else{
    echo '<html>Echec</html>';
    #header("Location:formTicket.php");
  }*/
?>