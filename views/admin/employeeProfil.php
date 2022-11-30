<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du salarié</h3>
            </div>
            <?php if (isset($employee)) : ?>
                <div class="containerContent">
                    <div class="containerName">
                        <p>
                            <?= $employee->lastname ?>
                        </p>
                        <p>
                            <?= $employee->firstname ?>
                        </p>
                    </div>
                    <a href="mailto:<?= $employee->email ?>">
                        <?= $employee->email ?>
                    </a>
                    <a href="tel:<?= $employee->phone ?>">
                        <?= $employee->phone ?>
                    </a>
                    <p>
                        <?= $employee->salaries ?> €
                    </p>
                    <p>
                        <?= $employee->adress ?>
                    </p>
                </div>
                <div class="containerButtons flexCenterBetween">
                    <div class="containerButton flexCenterCenter">
                    <a class="deleteClient <?= $employee->Id_users ?>">Supprimer</a>
                    </div>
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-employee?id=<?= $employee->Id_users ?>&amp;modify=true">Modifier le salarié</a>
                    </div>
                </div>
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
                                <a href="/public/uploads/<?= $invoice->Id_users ?>/<?= $invoice->url ?>.pdf" download><i class="fa-regular fa-file-pdf"></i></a>
                                <p class="clampMessage"><?= str_replace('_', ' ', $invoice->url)  ?> </p><i class="fa-solid fa-check <?= ($invoice->state == 0) ? 'bad' : 'good' ;?>"></i>
                                <div class="containerMore flexCenterCenter">
                                    <a class="moreInformations <?= $invoice->url ?>  <?= $invoice->Id_users ?> <?= $invoice->state ?> <?= $invoice->Id_bills ?>">Voir plus</a>
                                </div>
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