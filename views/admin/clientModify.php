<main>
    <div class="formContent">
        <div class="formContentTitle flexCenterCenter">
            <h3>Modifier un client</h3>
        </div>
        <form method="POST">
            <div class="formInput flexCenterCenterColumn">
                <div class="formName flexCenterBetween">
                    <div class="flexCenterCenterColumn">
                        <input type="text" placeholder="Nom*" name="lastname" value="<?= $lastname ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('lastname', $errorsRegistration)) ? $errorsRegistration['lastname'] : '' ?></p>
                    </div>
                    <div class="flexCenterColumn">
                        <input type="text" placeholder="Prénom*" name="firstname" value="<?= $firstname ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('firstname', $errorsRegistration)) ? $errorsRegistration['firstname'] : '' ?></p>
                    </div>
                </div>
                <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $mail ?? '' ?>" required>
                <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $phone ?? '' ?>" required>
                <p class="errorMessage"><?= (array_key_exists('phone', $errorsRegistration)) ? $errorsRegistration['phone'] : '' ?></p>
                <input type="mail" placeholder="SIRET*" name="siret" value="<?= $siret ?? '' ?>" required>
                <p class="errorMessage"><?= (array_key_exists('siret', $errorsRegistration)) ? $errorsRegistration['siret'] : '' ?></p>
                <input type="text" placeholder="Adresse" name="address" value="<?= $address ?? '' ?>" required>
                <p class="errorMessage"><?= (array_key_exists('adress', $errorsRegistration)) ? $errorsRegistration['adress'] : '' ?></p>
            </div>
        
            <!-- Button to submit form -->
        
            <div class="registerButton flexCenterCenter">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>
</main>