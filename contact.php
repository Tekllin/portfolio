<?php
$host = 'localhost';
$dbname = 'bddportfolio';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $sujet = isset($_POST['sujet']) ? $_POST['sujet'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";

    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        $requete = $bdd->prepare('INSERT INTO formulaire (prenom, nom, email, sujet, message) VALUES (?, ?, ?, ?, ?)');
        $requete->execute([$prenom, $nom, $email, $sujet, $message]);

        header("Location: contact.php");
        exit();
    } else {
        $erreur = "Veuillez remplir tous les champs obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Contact</title>
  </head>
  <body>
    <header>
      <nav class="header-container">
        <div class="header-logo-container">
          <figure>
            <a href="index.html">
              <img
                src="image/logoweb.svg"
                class="header-logo"
                alt="Logo"
                height="80%"
            /></a>
          </figure>
        </div>
        <a href="cv-telecharger/CVNathanielFavario-dev.pdf" target="_blank">
          <p class="header-txt">Mon CV</p>
        </a>
      </nav>
    </header>
    <main class="main-contact">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="form_contact">
        <div id="nom-prenom">
          <input
          id="nom"
            type="text"
            name="nom"
            placeholder="Nom"
            autocomplete="off"
            class="nomprenom"
            required
          />
          <input
          id="prenom"
            type="text"
            name="prenom"
            placeholder="Prénom"
            autocomplete="off"
            class="nomprenom"
            required
          />
        </div>
        <input
        id="email"
          type="email"
          name="email"
          placeholder="Email"
          autocomplete="off"
          class="info_form"
          required
        />
        <input
        id="sujet"
          type="text"
          name="sujet"
          placeholder="Objet"
          autocomplete="off"
          class="info_form"
          required
        />
        <input
        id="message"
          type="text"
          name="message"
          placeholder="Votre message"
          autocomplete="off"
          class="message"
          rows="10"
          required
        />
     <button type="submit" class="button-violet">Envoyer</button>
        <div class="rgpd">
          <input type="checkbox" class="checkbox" required />
          <p class="msg-rgpd">
            En soumettant ce formulaire, j'accepte que les informations saisies
            soient exploité <br />dans le cadre de la demande et de la relation
            commerciale qui peut en découler
          </p>
        </div>
      </form>
    </main>
    <footer>
      <div class="background-footer">
        <img
          src="image/logosstxtblanc.svg"
          alt="logo-tekllin"
          class="footer-logo"
        />
      </div>
      <nav>
        <ul class="container-footer">
          <li>
            <img src="image/github.png" alt="github" class="logo-github" />
          </li>
          <li>
            <img
              src="image/linkedin.svg"
              alt="linkedin"
              class="logo-linkedin"
            />
          </li>
        </ul>
      </nav>
    </footer>
  </body>
</html>
