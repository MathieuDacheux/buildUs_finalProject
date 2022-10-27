<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du client</h3>
            </div>
            <div class="containerContent">
                <div class="containerName">
                    <p>
                        Mathieu
                    </p>
                    <p>
                        Dacheux
                    </p>
                </div>
                <p>
                    mathieu.dacheux@icloud.com
                </p>
                <p>
                    06 12 34 56 78
                </p>
                <p>
                    12345678912345
                </p>
                <p>
                    123 rue de la paix
                </p>
            </div>
            <div class="containerButton flexCenterCenter">
                <a href="/dashboard/profil-client?id=">Modifier le client</a>
            </div>
        </div>
        <div class="containerForm">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Facture du client</h3>
            </div>
            <div class="formContent">
                <div class="containerBills">

                </div>
                <form method="POST" enctype="multipart/form-data" class="flexCenterCenter">
                    <label for="bills">Déposez une nouvelle facture</label>
                    <input type="file" name="bills" id="bills">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</main>