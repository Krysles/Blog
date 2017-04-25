<section id="connexion">
    <div class="box">
        <h2 class="section-title">Connexion</h2>
        <div class="divide20"></div>
        <div class="form-container">
            <div class="response alert alert-success"></div>
            <form class="" action="/connexion" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-row text-input-row email-field">
                                <label>Email</label>
                                <input type="email" name="email" class="text-input defaultText required email" placeholder="Entrez votre adresse email"/>
                                <?php if (isset($_SESSION['connexionErrors']['email'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['connexionErrors']['email']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-row text-input-row password-field">
                                <label>Mot de passe</label><a style="font-size: 13px;" class="pull-right" href="/recovery"><em>(mot de passe oublié ?)</em></a>
                                <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                <?php if (isset($_SESSION['connexionErrors']['password'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['connexionErrors']['password']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="button-row pull-right tm31">
                                <button type="submit" name="connexion" value="submit" class="btn btn-submit bm0">Connexion</button>
                                <?php unset($_SESSION['connexionErrors']); ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- /.form-container -->
    </div>
    <!-- /.box -->
</section>