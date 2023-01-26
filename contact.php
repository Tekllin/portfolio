<?php
    if (isset($_POST['message'])) {
        
        $message = "Nom : " . $_POST['nom'] . "
        Email : " . $_POST['email'] . "
        Message : " . $_POST['message'];

        $envoi_mail = mail("nathaniel.favario@gmail.com", $_POST['objet'], $_POST['message'],"Reply-to:" . $_POST['email']);
        if ($envoi_mail) {
            echo "<p>Envoyé</p>";
        }
    }
?>
</body>
</html>