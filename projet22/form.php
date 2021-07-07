<?php
    
    $serveur = "localhost";
    $dbname = "accident";
    $user = "root";
    $pass = "";
    
    function securisation($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}
        $victime = securisation($_POST["victime"]);
        $lieu = securisation($_POST["lieu"]);
        $date = securisation($_POST["date"]);
        $cause = securisation($_POST["cause"]);

    function miniscule($data){
        $data =  strtolower($data );
        return $data;
}
    
    $lieu = miniscule($lieu);
    $cause = miniscule($cause);

    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        if(!empty($victime)  && !empty($lieu) && !empty($date) && !empty($cause))
    
        $sth = $dbco->prepare("
            INSERT INTO form(victime, lieu, date, cause)
            VALUES(:victime, :lieu, :date, :cause)");
        $sth->bindParam(':victime',$victime);
        $sth->bindParam(':lieu',$lieu);
        $sth->bindParam(':date',$date);
        $sth->bindParam(':cause',$cause);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:merci.html");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }

    
?>