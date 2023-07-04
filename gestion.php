<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=bddportfolio;charset=utf8', 'root');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    try {
        $requete = $bdd->prepare('DELETE FROM formulaire WHERE id = :id');
        $requete->execute(['id' => $id]);

        header("Location: gestion.php");
        exit();
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $sujet = isset($_POST['sujet']) ? $_POST['sujet'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";

    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        try {
            $requete = $bdd->prepare('INSERT INTO formulaire (prenom, nom, email, sujet, message) VALUES (?, ?, ?, ?, ?)');
            $requete->execute([$prenom, $nom, $email, $sujet, $message]);

            header("Location: gestion.php");
            exit();
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
}

$requete = $bdd->query('SELECT id, prenom, nom, email, sujet, message FROM formulaire');
echo '
<table border>
<tr>
<th>Prenom</th>
<th>Nom</th>
<th>Email</th>
<th>Sujet</th>
<th>Message</th>
<th>Supprimer</th>
</tr>
';

while ($donnees = $requete->fetch()) {
    echo '<tr>
    <td>'.$donnees['prenom'].'</td>
    <td>'.$donnees['nom'].'</td>
    <td>'.$donnees['email'].'</td>
    <td>'.$donnees['sujet'].'</td>
    <td>'.$donnees['message'].'</td>
    <td><a href="?delete_id='.$donnees['id'].'">Supprimer</a></td>
    </tr>';
}

echo '</table>';

?>