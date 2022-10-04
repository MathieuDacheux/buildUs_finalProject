<div class="backToHome">
        <a href="/accueil"><i class="fa-solid fa-arrow-left"></i></a> 
    </div>
    <div class="formContainer flexCenterColumn">
        <div class="formContent">
            <div class="formContentTitle flexCenterCenter">
                <h3>Mot de passe oublié ? <strong class="important">Facile</strong></h3>
            </div>
            <form method="POST">
                <div class="formInput flexCenterCenterColumn">
                    <input type="mail" placeholder="example@app.com" name="userLogin" value="<?= $userLogin ?? '' ?>" required>
                    <p class="errorMessage"><?= (array_key_exists('userLogin', $errorForgot)) ? $errorForgot['userLogin'] : '' ?></p>
                </div>
                <div class="registerButton flexCenterCenter">
                    <button type="submit" name="connexion">Reinitialiser</button>
                </div>
            </form>
        </div>
        <h4>Connectez vous à votre compte <a href="/connexion">Cliquez ici</a></h4>
    </div>

    <!-- CDN Font Awesome -->

    <script src="https://kit.fontawesome.com/d067b7d25c.js" crossorigin="anonymous"></script>