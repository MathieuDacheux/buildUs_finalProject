    <div class="backToHome">
        <a href="/accueil"><i class="fa-solid fa-arrow-left"></i></a> 
    </div>
    <div class="formContainer flexCenterColumn">
        <div class="formContent">
            <div class="formContentTitle flexCenterCenter">
                <?php if (isset($succes)) : ?>
                    <?php if ($succes == true) : ?>
                        <h3>Votre compte a bien été <strong class="important">validé</strong></h3>
                    <?php elseif ($succes == false) : ?>
                        <h3>Une <strong class="important">erreur</strong> est survenue</h3>
                    <?php endif; ?>
                <?php else : ?>
                    <h3>Retrouvez <strong class="important">BuildUs</strong></h3>
                <?php endif; ?>
            </div>
            <form method="POST">
                <div class="formInput flexCenterCenterColumn">
                    <input type="mail" placeholder="example@app.com" name="userLogin" value="<?= $userLogin ?? '' ?>" required>
                    <p class="errorMessage"><?= (array_key_exists('userLogin', $errorConnexion)) ? $errorConnexion['userLogin'] : '' ?></p>
                    <input type="password" placeholder="Mot de passe" name="userPassword" required>
                    <p>Mot de passe oublié ? <a href="/reinitialiser">Cliquez ici</a></p>
                </div>
                <div class="registerButton flexCenterCenter">
                    <button type="submit" name="connexion">Se connecter</button>
                </div>
            </form>
        </div>
        <h4>Vous souhaitez créer un compte ? <a href="/inscription">Cliquez ici</a></h4>
    </div>

    <!-- CDN Font Awesome -->

    <script src="https://kit.fontawesome.com/b274073d83.js" crossorigin="anonymous"></script>