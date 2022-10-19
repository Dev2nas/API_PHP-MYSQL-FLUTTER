<?php 

/*
*01:40:00 - 19/10/2022
*by devnas
*Web developer/Mobile-Designer
*devnas.inc@gmail.com
*+227 99 32 63 08
*/

// Création d'un API de connexion PHP/MYSQL pour Flutter

// création des attributs du server
$host="localhost"; //server
$username="root"; //nom d'utilisateur du server
$password=""; //mot de passe
$db="FlutterDB"; //base de données
$table="personal"; //table

$action=$_POST["action"]; //Input nom de la table


//création de la connexion
$conn=new mysqli($host,$usernamen,$password,$db);
if($conn->connect_error){
    die("connection failed:".$conn->connection_error);
    return;
}

// Si la connexion est ok
if('CREATE TABLE'==$action){
    $sql="CREATE TABLE IF NOT EXISTS $table(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        prenom VARCHAR(30) NOT NULL,
        
        )";
}

if ($conn->query($sql)==TRUE){
        echo 'sucess';
}else{
    echo 'error';
}
$conn->close();
return;

//Affichage des données de la table
if ("GET_ALL"==$action){
    $db_data=array();
    $sql="SELECT id,nom,prenom from $table ORDER BY id DESC";
    $result=$conn->query($sql);
    if ($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $db_data[]=$row;
        }
        echo json_decode($db_data);
    }else{
        echo 'error';
    }
    $conn->close();
    return;
}

//Script d'ajout
if("ADD"==$action){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $sql="INSERT INTO $table(nom,prenom) VALUES('$nom','$prenom')";
    $result=$conn->query($sql);
    echo 'sucesss';
    $conn->close();
    return;
}

// script de modification
if("UPDATE"==$action){
    $id=$_POST["id"];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $sql="UPDATE $table SET nom='$nom', prenom='$prenom' WHERE id='$id'";
    if($conn->query($sql)===true){
        echo 'sucess';
    }else{
        'error';
    }
    $conn->close();
    return;
}

// script de suppression
if("DELETE"==$action){
    $id=$_POST["id"];
    $sql="DELETE FROM $table  WHERE id='$id'";
    if($conn->query($sql)===true){
        echo 'sucess';
    }else{
        'error';
    }
    $conn->close();
    return;
}


?>
