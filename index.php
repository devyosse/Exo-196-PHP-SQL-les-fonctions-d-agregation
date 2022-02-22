<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'exo196';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT MIN(age) as minimun FROM user");

        $state = $stmt->execute();
        if ($state){
            $min = $stmt->fetch();
            echo "<pre>";
            print_r($min);
            echo "</pre>";
        }
        echo "<br>";

        $stmt2 = $conn->prepare("SELECT MAX(age) as maximun FROM user");
        $state2 = $stmt2->execute();

        if ($state2){
            $max = $stmt2->fetch();
            echo "<pre>";
            print_r($max);
            echo "</pre>";
        }

        echo "<br>";

        $stmt3 = $conn->prepare("SELECT count(*) as number FROM user");
        $state3 = $stmt3->execute();

        if ($state3){
            $count = $stmt3->fetch();
            echo "<pre>";
            print_r($count);
            echo "</pre>";
        }

        $stmt4 = $conn->prepare("SELECT * from user WHERE numero >= 5");
        $state4 = $stmt4->execute();

        if ($state4){
            $street = $stmt4->fetch();
            echo "<pre>";
            print_r($street);
            echo "</pre>";
        }

        $stmt5 = $conn->prepare("SELECT AVG(age) as moyenne_age FROM user");
        $state5 = $stmt5->execute();

        if ($state5){
            $mediumAge = $stmt5->fetch();
            echo "<pre>";
            print_r($mediumAge);
            echo "</pre>";
        }

        $stmt6 = $conn->prepare("SELECT SUM(numero) as somme_num FROM user");
        $state6 = $stmt6->execute();

        if ($state6){
            $sommeNum = $stmt6->fetch();
            echo "<pre>";
            print_r($sommeNum);
            echo "</pre>";
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>
</body>
</html>

