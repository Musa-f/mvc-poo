<h2>Entrez le nom de votre personnage</h2>

<?php if(isset($message)):?>
    <p><?= $message?></p>
<?php endif ?>


    <form action="" method="post">
        <label for="">Nom</label>
        <input type="text" name="nom">
        <br><br>
        <input type="submit" name="creer" value="Créer un personnage">
        <input type="submit" name="utiliser" value="Utiliser un personnage">
    </form>