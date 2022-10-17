    <!-- Comeback to the landing page -->

    <div class="backToHome">
        <a href="/accueil"><i class="fa-solid fa-arrow-left"></i></a> 
    </div>

    <!-- Container registration -->

    <div class="formContainer flexCenterColumn">
        <div class="formContent">

            <!-- Container title -->

            <div class="formContentTitle flexCenterCenter">
                <h3>C'est rapide et <strong class="important">facile</strong></h3>
            </div>

            <!-- Form -->

            <form method="POST">
                <div class="formInput flexCenterCenterColumn">
                    <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $mail ?? '' ?>" required>
                    <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
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
                    <input type="password" placeholder="Mot de passe*" name="password" required>
                    <p class="errorMessage"><?= (array_key_exists('password', $errorsRegistration)) ? $errorsRegistration['password'] : '' ?></p>
                    <div class="passwordIndication hidden">
                        <p>Il doit contenir :</p>
                        <ul>
                            <li>- Une lettre majuscule</li>
                            <li>- Un chiffre minimum</li>
                            <li>- Un caractère spécial</li>
                            <li>- 8 caractères minimum</li>
                        </ul>
                    </div>
                    <input type="password" placeholder="Mot de passe (confirmation)*" name="passwordConfirm" required>
                    <div class="formCheckboxContainer">
                        <div class="formCheckbox">
                            <input type="checkbox" name="CGU[]" id="termServices" name="termServices" value="1" <?= (!empty($cgu) && in_array('1', $cgu)) ? 'checked' : '' ?> required>
                            <label for="termServices">J'accepte les <a href="/cgu" target="_blank">conditions d'utitilisations</a></label>
                            <p class="errorMessage"><?= (array_key_exists('password', $errorsRegistration)) ? $errorsRegistration['password'] : '' ?></p>
                        </div>
                        <div class="formCheckbox">
                            <input type="checkbox" name="CGU[]" id="privacyPolicy" name="privacyPolicy" value="2" <?= (!empty($cgu) && in_array('2', $cgu)) ? 'checked' : '' ?> required>
                            <label for="privacyPolicy">J'accepte la <a href="/confidentialite" target="_blank">politique de confidentialité</a></label>
                            <p class="errorMessage"><?= (array_key_exists('password', $errorsRegistration)) ? $errorsRegistration['password'] : '' ?></p>
                        </div>
                        <div class="formCheckbox">
                            <input type="checkbox" name="newsletter" id="newsletter" name="newsletter" value="1" <?= (!empty($newsletter)) ? 'checked' : '' ?> >
                            <label for="newsletter">J'accepte de recevoir la newsletter de <strong class="important">BuildUs</strong></label>
                        </div>
                    </div>
                </div>

                <!-- Button to submit form -->

                <div class="registerButton flexCenterCenter">
                    <button type="submit">S'inscrire</button>
                </div>
            </form>
        </div>

        <!-- Call to action -->

        <h4>Vous possédez un compte ? <a href="/connexion">Cliquez ici</a></h4>
    </div>

    <!-- CDN Font Awesome -->

    <script src="https://kit.fontawesome.com/b274073d83.js" crossorigin="anonymous"></script>