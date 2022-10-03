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
                    <input type="text" placeholder="example@app.com" name="mail" required>
                    <div class="formName flexCenterBetween">
                        <input type="text" placeholder="Nom" name="lastname" required>
                        <input type="text" placeholder="Prénom" name="firstname" required>
                    </div>
                    <input type="password" placeholder="Mot de passe" name="password" required>
                    <div class="passwordIndication hidden">
                        <p>Il doit contenir :</p>
                        <ul>
                            <li>Une lettre majuscule</li>
                            <li>Un chiffre minimum</li>
                            <li>Un caractère spécial</li>
                            <li>8 caractères minimum</li>
                        </ul>
                    </div>
                    <input type="password" placeholder="Mot de passe (confirmation)" name="passwordConfirm" required>
                    <div class="formCheckboxContainer">
                        <div class="formCheckbox">
                            <input type="checkbox" name="CGU[]" id="termServices" name="termServices" required>
                            <label for="termServices">J'accepte les <a href="">conditions d'utitilisations</a></label>
                        </div>
                        <div class="formCheckbox">
                            <input type="checkbox" name="CGU[]" id="privacyPolicy" name="privacyPolicy" required>
                            <label for="privacyPolicy">J'accepte la <a href="">politique de confidentialité</a></label>
                        </div>
                        <div class="formCheckbox">
                            <input type="checkbox" name="CGU[]" id="newsletter" name="newsletter">
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

        <h4>Vous possédez un compte ? <a href="connexion.html">Cliquez ici</a></h4>
    </div>

    <!-- CDN Font Awesome -->

    <script src="https://kit.fontawesome.com/d067b7d25c.js" crossorigin="anonymous"></script>