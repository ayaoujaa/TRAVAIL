<?php 
include '_conf.php';
?>

<?php

if($bdd= mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD))
{
    echo "la connexion BDD réussie !";
}
else 
{
    echo "Erreur";
}

?>

<DOCTYPE html>
    <form method="post">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required>
        <br><br>
        <label for="Mot de passe">Mot de passe :</label>
        <input type="text" id="mdp" name="mdp" required>
        <br><br>
        <p class>mot de passe perdu ? <a href="oubli.php">Mdp oublié</a></p>
    </form>
</html>
      
