<section id="about">
    <div class="box">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="section-title">Erreur - Page introuvable</h2>
                <p class="lead">Vous ne vous trouvez certainement pas au bon endroit...</p>
                <p>Cette erreur persiste, vous pouvez la signaler à l'administrateur du site ci-dessous.</p>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="clearfix"></div>
        <div class="form-container">
            <div class="response alert alert-success"></div>
            <form class="" action="/contact" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-row text-input-row name-field">
                                <label>Nom</label>
                                <input type="text" name="name" value="<?php if (isset($_SESSION['contactForm'])) : echo $_SESSION['contactForm']['name']; endif; ?>"
                                       class="text-input defaultText required" placeholder="Entrez votre nom"/>
                                <?php if (isset($_SESSION['contactErrors']['name'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['contactErrors']['name']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row email-field">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php if (isset($_SESSION['contactForm'])) : echo $_SESSION['contactForm']['email']; endif; ?>"
                                       class="text-input defaultText required email" placeholder="Entrez votre adresse email"/>
                                <?php if (isset($_SESSION['contactErrors']['email'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['contactErrors']['email']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Sujet</label>
                                <input type="text" name="subject" value="<?php if (isset($_SESSION['contactForm'])) : echo $_SESSION['contactForm']['subject']; endif; ?>"
                                       class="text-input defaultText" placeholder="Entrez le sujet du contact"/>
                                <?php if (isset($_SESSION['contactErrors']['subject'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['contactErrors']['subject']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-row text-area-row">
                                <label>Message</label>
                                <textarea name="message" class="text-area required"
                                          placeholder="Entrez le message"><?php if (isset($_SESSION['contactForm'])) : echo $_SESSION['contactForm']['message']; endif; ?></textarea>
                                <?php if (isset($_SESSION['contactErrors']['message'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['contactErrors']['message']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="button-row pull-right">
                                <input type="submit" value="Envoyer" name="contact" class="btn btn-submit bm0"/>
                                <?php unset($_SESSION['contactForm']); ?>
                                <?php unset($_SESSION['contactErrors']); ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <!-- /.form-container -->
</section>
<!-- /#about -->