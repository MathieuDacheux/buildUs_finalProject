<main>
    <div class="containerForm flexCenterColumn">
        <div class="formContentTitle flexCenterCenter">
            <h3>Modifier votre profil</h3>
        </div>
        <form method="POST">
            <div class="formInput flexCenterCenterColumn">
                <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $mail ?? '' ?>" pattern="<?= REGEX_MAIL ?>" required>
                <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                <div class="formName flexCenterBetween">
                    <div class="flexCenterCenterColumn">
                        <input type="text" placeholder="Nom*" name="lastname" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('lastname', $errorsRegistration)) ? $errorsRegistration['lastname'] : '' ?></p>
                    </div>
                    <div class="flexCenterColumn">
                        <input type="text" placeholder="Prénom*" name="firstname" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('firstname', $errorsRegistration)) ? $errorsRegistration['firstname'] : '' ?></p>
                    </div>
                </div>
            </div>
    
            <!-- Button to submit form -->
    
            <div class="registerButton flexCenterCenter">
                <button type="submit">Modifier</button>
            </div>
        </form>
    </div>
</main>