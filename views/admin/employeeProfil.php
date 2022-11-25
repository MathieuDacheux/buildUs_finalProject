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
                    <a class="deleteClient <?= $information->Id_users ?>">Supprimer</a>
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
                    <?php if (isset($invoicesDisplay)) : ?>
                        <?php foreach ($invoicesDisplay as $invoice) : ?>
                            <div class="invoices">
                                <div class="containerAdd flexCenterCenter">
                                    <a href="/dashboard/profil-employe?id=<?= $invoice->Id_users ?>&amp;pdf=<?= $invoice->Id_bills ?>"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <a href="/public/uploads/<?= $invoice->Id_users ?>/<?= $invoice->url ?>.pdf" download><i class="fa-regular fa-file-pdf"></i></a>
                                <p><?= str_replace('_', ' ', $invoice->url)  ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <form method="POST" enctype="multipart/form-data" class="flexCenterBetween">
                    <label for="bills">Déposer un nouveau document</label>
                    <input type="file" name="bills" id="bills">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal $error -->
    <?php if (isset($error)) : ?>
        <div class="showResult visible">
            <p class="resultFormText badResult"><?= $error ?></p>
        </div>
    <?php endif; ?>

    <!-- Modal $success -->
    <?php if (isset($success)) : ?>
        <div class="showResult visible">
            <p class="resultFormText goodResult"><?= $success ?></p>
        </div>
    <?php endif; ?>

    <div class="containerDeleteSelected"></div>
</main>