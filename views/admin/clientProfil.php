<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du client</h3>
            </div>
            <?php if (isset($client)) : ?>
                <?php foreach($client as $information) : ?>
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
                        <?= $information->siret ?>
                    </p>
                    <p>
                        <?= $information->adress ?>
                    </p>
                </div>
                <div class="containerButtons flexCenterBetween">
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-client?id=<?= $information->Id_users ?>&amp;delete=true">Supprimer le client</a>
                    </div>
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-client?id=<?= $information->Id_users ?>&amp;modify=true">Modifier le client</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="containerForm">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Facture du client</h3>
            </div>
            <div class="formContent">
                <div class="containerBills">
                    <?php if (isset($invoicesDisplay)) : ?>
                        <?php foreach ($invoicesDisplay as $invoice) : ?>
                            <div class="invoices">
                                <div class="containerAdd flexCenterCenter">
                                    <a href="/dashboard/profil-client?id=<?= $invoice->Id_users ?>&amp;pdf=<?= $invoice->Id_bills ?>"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <a href="/public/uploads/bills/<?= $invoice->url ?>.pdf" download><i class="fa-regular fa-file-pdf"></i></a>
                                <p><?= $invoice->url ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <form method="POST" enctype="multipart/form-data" class="flexCenterBetween">
                    <label for="bills">Déposez une nouvelle facture</label>
                    <input type="file" name="bills" id="bills">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</main>