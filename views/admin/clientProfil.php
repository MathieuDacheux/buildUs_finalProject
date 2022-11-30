<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du client</h3>
            </div>
            <?php if (isset($client)) : ?>
                <div class="containerContent">
                    <div class="containerName">
                        <p>
                            <?= $client->lastname ?>
                        </p>
                        <p>
                            <?= $client->firstname ?>
                        </p>
                    </div>
                    <a href="mailto:<?= $client->email ?>">
                        <?= $client->email ?>
                    </a>
                    <a href="tel:<?= $client->phone ?>">
                        <?= $client->phone ?>
                    </a>
                    <p>
                        <?= $client->siret ?>
                    </p>
                    <p>
                        <?= $client->adress ?>
                    </p>
                </div>
                <div class="containerButtons flexCenterAround">
                    <div class="containerButton flexCenterCenter">
                        <a class="deleteClient <?= $client->Id_users ?>">Supprimer</a>
                    </div>
                    <div class="containerButton flexCenterCenter">
                        <a href="/dashboard/profil-client?id=<?= $client->Id_users ?>&amp;modify=true">Modifier le client</a>
                    </div>
                </div>
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