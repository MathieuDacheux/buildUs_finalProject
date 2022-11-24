<main>
    <?php if (isset($admin)): ?>
        <?php foreach ($admin as $information) : ?>
            <div class="containerForm flexCenterColumn">
                <div class="formContentTitle flexCenterCenter">
                    <h3>Modifier votre profil</h3>
                </div>
                <form method="POST">
                    <div class="formInput flexCenterCenterColumn">
                        <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $information->email ?? '' ?>" pattern="<?= REGEX_MAIL ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                        <div class="formName flexCenterBetween">
                            <div class="flexCenterCenterColumn">
                                <input type="text" placeholder="Nom*" name="lastname" value="<?= $information->lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('lastname', $errorsRegistration)) ? $errorsRegistration['lastname'] : '' ?></p>
                            </div>
                            <div class="flexCenterColumn">
                                <input type="text" placeholder="Prénom*" name="firstname" value="<?= $information->firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('firstname', $errorsRegistration)) ? $errorsRegistration['firstname'] : '' ?></p>
                            </div>
                        </div>
                    </div>
            
                    <!-- Button to submit form -->
            
                    <div class="registerButton flexCenterCenterColumn">
                        <button type="submit">Modifier</button>
                        <p class="deleteClient <?= $information->Id_users ?>">Supprimer</p>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="containerDeleteSelected"></div>
</main>