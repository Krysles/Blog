<?php $this->title = "Récupération d'accès" ?>

<section id="home" class="naked">
    <div class="fullscreenbanner-container revolution">
        <div class="fullscreenbanner">
            <ul>
                <li data-transition="fade"><img src="/style/images/dummy.png" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat">
                    <h1 class="tp-caption caption large sfb" data-x="center" data-y="200" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100"
                        data-easing="Sine.easeOut" style="font-size: 50px; text-shadow: 1px 1px 1px black;">Récupération d'accès</h1>
                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="300" data-voffset="25" data-speed="100"
                         data-start="1500"
                         data-easing="Power4.easeOut"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.03"
                         data-endelementdelay="0"
                         data-endspeed="100"
                         data-endeasing="Power1.easeOut"
                         style="z-index: 3; font-size: 35px; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 1px 1px 1px black;">Vous pouvez maintenant saisir votre nouveau mot de passe...
                    </div>
                    <div class="arrow smooth"><a href="#recovery"><i class="icon-down-open-big"></i></a></div>
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
    <section id="recovery">
        <div class="box">
            <h2 class="section-title">Saisissez votre nouveau mot de passe</h2>
            <div class="divide20"></div>
            <div class="form-container">
                <div class="response alert alert-success"></div>
                <form class="" action="/recovery/update" method="post">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-push-3 col-sm-6">
                                <div class="form-row text-input-row password-field">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                </div>
                                <div class="form-row text-input-row password-field">
                                    <label>Confirmation du mot de passe</label>
                                    <input type="password" name="confirmPassword" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                    <?php if (isset($_SESSION['recoveryErrors']['password'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['recoveryErrors']['password']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-row text-input-row role-field">
                                    <input type="hidden" name="role" class="text-input defaultText required" value="visitor" />
                                </div>
                                <div class="button-row pull-right tm31">
                                    <button type="submit" name="recovery" value="submit" class="btn btn-submit bm0">Valider</button>
                                    <?php unset($_SESSION['recoveryErrors']); ?>
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