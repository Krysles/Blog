<?php $this->title = "Récupération d'identifiant" ?>

<section id="home" class="naked">
    <div class="fullscreenbanner-container revolution">
        <div class="fullscreenbanner">
            <ul>
                <li data-transition="fade"><img src="/style/images/dummy.png" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat">
                    <h1 class="tp-caption caption large sfb" data-x="center" data-y="200" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100"
                        data-easing="Sine.easeOut" style="font-size: 50px; text-shadow: 1px 1px 1px black;">Mot de passe oublié ?</h1>
                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="300" data-voffset="25" data-speed="100"
                         data-start="1500"
                         data-easing="Power4.easeOut"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.03"
                         data-endelementdelay="0"
                         data-endspeed="100"
                         data-endeasing="Power1.easeOut"
                         style="z-index: 3; font-size: 35px; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 1px 1px 1px black;">Suivez le guide...
                    </div>
                    <div class="arrow smooth"><a href="#lostpassword"><i class="icon-down-open-big"></i></a></div>
                </li>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
        <!-- /.fullscreenbanner -->
    </div>
    <!-- /.revolution -->
</section>
<!-- /#home -->
<div class="container">
    <section id="lostpassword">
        <div class="box">
            <h2 class="section-title">Mot de passe oublié ?</h2>
            <div class="divide20"></div>
            <p>Saisissez votre adresse mail afin de recevoir un lien qui permettra la saisie d'un nouveau mot de passe après vérification.</p>
            <div class="form-container">
                <div class="response alert alert-success"></div>
                <form class="" action="/recovery" method="post">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-push-1 col-sm-6">
                                <div class="form-row text-input-row email-field">
                                    <label>Email</label>
                                    <!-- mettre email après les tests -->
                                    <input type="text" name="email" class="text-input defaultText required email" value="<?php if (isset($_SESSION['lostpasswordForm'])) : echo $_SESSION['lostpasswordForm']->getEmail(); endif; ?>" placeholder="Entrez votre adresse email"/>
                                    <?php if (isset($_SESSION['lostpasswordErrors']['email'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['lostpasswordErrors']['email']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="button-row pull-right tm31">
                                    <!--<input type="submit" value="Inscription" name="submit" class="btn btn-submit bm0"/>-->
                                    <button type="submit" name="lostpassword" value="submit" class="btn btn-submit bm0">Récupérer mon accès</button>
                                    <?php unset($_SESSION['lostpasswordForm']); ?>
                                    <?php unset($_SESSION['lostpasswordErrors']); ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- /.form-container -->
            <div class="clearfix"></div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /#lostpassword -->

    <footer class="footer box" style="margin-top: 0;">
        <p class="pull-left">© 2015 Lumos. All rights reserved. Theme by <a href="http://elemisfreebies.com">elemis</a>.</p>
        <ul class="social pull-right">
            <li><a href="#"><i class="icon-s-rss"></i></a></li>
            <li><a href="#"><i class="icon-s-twitter"></i></a></li>
            <li><a href="#"><i class="icon-s-facebook"></i></a></li>
            <li><a href="#"><i class="icon-s-dribbble"></i></a></li>
            <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
            <li><a href="#"><i class="icon-s-instagram"></i></a></li>
            <li><a href="#"><i class="icon-s-vimeo"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer -->
</div>
<!-- /.container -->