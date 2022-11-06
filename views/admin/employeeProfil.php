<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du salarié</h3>
            </div>
            <?php if (isset($employee)) : ?>
                <?php foreach($employee as $information) : ?>
                <div class="containerContent">
                    <div class="containerName">
                        <p>
                            <?= $information->lastname ?>
                        </p>
                        <p>
                            <?= $information->firstname ?>
                        </p>
                    </div>
                    <p>
                        <?= $information->email ?>
                    </p>
                    <p>
                        <?= $information->phone ?>
                    </p>
                    <p>
                        <?= $information->salaries ?> €
                    </p>
                    <p>
                        <?= $information->adress ?>
                    </p>
                </div>
                <div class="containerButtons flexCenterBetween">
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-employee?id=<?= $information->Id_users ?>&amp;delete=true">Supprimer le salarié</a>
                    </div>
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-employee?id=<?= $information->Id_users ?>&amp;modify=true">Modifier le salarié</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="containerForm">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Fiches de paies</h3>
            </div>
            <div class="formContent">
                <div class="containerBills">

                </div>
                <form method="POST" enctype="multipart/form-data" class="flexCenterCenter">
                    <label for="bills">Déposez un nouveau bulletin</label>
                    <input type="file" name="bills" id="bills">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</main>