<div class="backToHome">
        <a href="/accueil"><i class="fa-solid fa-arrow-left"></i></a> 
    </div>
    <div class="formContainer flexCenterColumn">
        <div class="formContent">
            <div class="formContentTitle flexCenterCenter">
                <?php if (isset($_GET['token'])) : ?>
                    <?php if (isset($success) && $success == true) : ?>
                        <h3>Mot de passe <strong class="important">modifié</strong></h3>
                    <?php else : ?>
                        <h3>Mot de passe oublié ? <strong class="important">Facile</strong></h3>
                    <?php endif ; ?>
                <?php else : ?>
                    <?php if (isset($success) && $success == true) :?>
                        <h3>Mail de réinitialisation <strong class="important">envoyé</strong></h3>
                    <?php else : ?>
                        <h3>Mot de passe oublié ? <strong class="important">Facile</strong></h3>
                    <?php endif ; ?>
                <?php endif ; ?>
            </div>
            <form method="POST">
                <?php if (isset($_GET['token'])) : ?>
                    <div class="formInput flexCenterCenterColumn">
                        <input type="password" placeholder="Mot de passe*" class="passwordReini"name="password" pattern="<?= REGEX_PASSWORD ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('password', $errorForgot)) ? $errorForgot['password'] : '' ?></p>
                        <div class="passwordIndication hidden">
                            <p>Il doit contenir :</p>
                            <ul>
                                <li>- Une lettre majuscule</li>
                                <li>- Un chiffre minimum</li>
                                <li>- Un caractère spécial</li>
                                <li>- 8 caractères minimum</li>
                            </ul>
                        </div>
                        <input type="password" placeholder="Mot de passe (confirmation)*" name="passwordConfirm" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                <?php else : ?>
                    <div class="formInput flexCenterCenterColumn">
                        <input type="mail" placeholder="example@app.com" name="userLogin" value="<?= $userLogin ?? '' ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('userLogin', $errorForgot)) ? $errorForgot['userLogin'] : '' ?></p>
                    </div>
                    <?php endif ; ?>
                    <div class="registerButton flexCenterCenter">
                        <button type="submit" name="connexion">Reinitialiser</button>
                    </div>
            </form>
        </div>
        <h4>Connectez vous à votre compte ? <a href="/connexion">Cliquez ici</a></h4>
    </div>

    <!-- CDN Font Awesome -->

    <script src="https://kit.fontawesome.com/b274073d83.js" crossorigin="anonymous"></script>