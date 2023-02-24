
<h2>Bienvenue <?= $user->getNom() ?></h2>
<form>
    <fieldset>
        <legend> Mes informations </legend>
        <label>Nom: <?= $user->getNom() ?></label>
        <br>
        <label>Dégâts: <?= $user->getDegats() ?></label>
    </fieldset>
    <fieldset>
        <legend> Qui frapper ? </legend>
        <p><?= $message ?></p>
        <?php foreach ($persos as $perso): ?>
            <a href="?frapper=<?= $perso->getNom() ?>">
                <?= $perso->getNom() ?> 
            </a>
            (Dégâts: <?= $perso->getDegats() ?>)
            <br>
        <?php endforeach; ?>
    </fieldset>
</form>

<a href="../controller/controller.logout.php">Se déconnecter</a>
