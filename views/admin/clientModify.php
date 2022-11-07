<main>
    <?php if (isset($client)) : ?>
        <?php foreach($client as $information) : ?>
            <div class="formContent">
                <div class="formContentTitle flexCenterCenter">
                    <h3>Modifier un client</h3>
                </div>
                <form method="POST">
                    <div class="formInput flexCenterCenterColumn">
                        <div class="formName flexCenterBetween">
                            <div class="flexCenterCenterColumn">
                                <input type="text" placeholder="Nom*" name="lastname" value="<?= $information->lastname ?? '' ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('lastname', $errorsRegistration)) ? $errorsRegistration['lastname'] : '' ?></p>
                            </div>
                            <div class="flexCenterColumn">
                                <input type="text" placeholder="Prénom*" name="firstname" value="<?= $information->firstname ?? '' ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('firstname', $errorsRegistration)) ? $errorsRegistration['firstname'] : '' ?></p>
                            </div>
                        </div>
                        <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $information->email ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                        <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $information->phone ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('phone', $errorsRegistration)) ? $errorsRegistration['phone'] : '' ?></p>
                        <input type="mail" placeholder="SIRET*" name="siret" value="<?= $information->siret ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('siret', $errorsRegistration)) ? $errorsRegistration['siret'] : '' ?></p>
                        <input type="text" placeholder="Adresse" name="adress" value="<?= $information->adress ?? '' ?>">
                        <p class="errorMessage"><?= (array_key_exists('adress', $errorsRegistration)) ? $errorsRegistration['adress'] : '' ?></p>
                    </div>
                
                    <!-- Button to submit form -->
                
                    <div class="registerButton flexCenterCenter">
                        <button type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>