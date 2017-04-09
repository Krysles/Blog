<?php $this->title = "Accueil" ?>

<section id="home" class="naked">
    <div class="fullscreenbanner-container revolution">
        <div class="fullscreenbanner">
            <ul>
                <li data-transition="fade"><img src="/style/images/dummy.png" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat">
                    <h1 class="tp-caption caption large sfb" data-x="center" data-y="400" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100"
                        data-easing="Sine.easeOut" style="font-size: 50px; text-shadow: 1px 1px 1px black;"><?php echo $config->title; ?></h1>
                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="500" data-voffset="25" data-speed="100"
                         data-start="1500"
                         data-easing="Power4.easeOut"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.03"
                         data-endelementdelay="0"
                         data-endspeed="100"
                         data-endeasing="Power1.easeOut"
                         style="z-index: 3; font-size: 35px; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 1px 1px 1px black;"><?php echo $config->subtitle; ?>
                    </div>
                    <div class="arrow smooth"><a href="#about"><i class="icon-down-open-big"></i></a></div>
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
    <section id="about">
        <div class="box">
            <div class="row">
                <div class="col-md-5 col-md-push-7 col-sm-12">
                    <figure class="frame"><img src="<?php echo '/' . $book->url; ?>" alt=""/></figure>
                </div>
                <!-- /column -->
                <div class="col-md-7 col-md-pull-5 col-sm-12">
                    <h2 class="section-title"><a href="/page"><?php echo $book->title; ?></a></h2>
                    <p class="lead"><?php echo $book->subtitle; ?></p>
                    <p><?php echo $book->summary; ?></p>
                    <p class="text-right"><?php echo $book->firstname . ' ' . $book->lastname; ?></p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="clearfix"></div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /#about -->
    <!-- Ajout du portfolio présentant les livres -->
    <section id="contact">
        <div class="box">
            <h2 class="section-title">Contact</h2>
            <p>C'est ici que l'on va pouvoir se connecter pour ajouter des commentaires. Il faut qu'après la connexion cette section disparaisse et change avec un bouton de
                déconnexion. Il ne faut pas oublier d'ajouter une option pour s'inscrire.</p>
            <div class="divide20"></div>
            <div class="row text-center services-2">
                <div class="col-md-3 col-sm-6"><i class="budicon-map"></i>
                    <p>Moon Street Light Avenue <br/>
                        14/05 Jupiter, JP 80630</p>
                </div>
                <div class="col-md-3 col-sm-6"><i class="budicon-telephone"></i>
                    <p>00 (123) 456 78 90 <br/>
                        00 (987) 654 32 10 </p>
                </div>
                <div class="col-md-3 col-sm-6"><i class="budicon-mobile"></i>
                    <p>00 (123) 456 78 90 <br/>
                        00 (987) 654 32 10 </p>
                </div>
                <div class="col-md-3 col-sm-6"><i class="budicon-mail"></i>
                    <p><a class="nocolor" href="mailto:#">manager@email.com</a> <br/>
                        <a class="nocolor" href="mailto:#">asistant@email.com</a></p>
                </div>
            </div>
            <!-- /.services-2 -->
            <div class="divide30"></div>
            <div class="form-container">
                <div class="response alert alert-success"></div>
                <form class="formssssssssss" action="contact/form-handler.php" method="post">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-row text-input-row name-field">
                                    <label>Nom</label>
                                    <input type="text" name="name" class="text-input defaultText required" />
                                </div>
                                <div class="form-row text-input-row email-field">
                                    <label>Email</label>
                                    <input type="text" name="email" class="text-input defaultText required email"/>
                                </div>
                                <div class="form-row text-input-row subject-field">
                                    <label>Sujet</label>
                                    <input type="text" name="subject" class="text-input defaultText"/>
                                </div>
                            </div>
                            <div class="col-sm-6 lp5">
                                <div class="form-row text-area-row">
                                    <label>Message</label>
                                    <textarea name="message" class="text-area required"></textarea>
                                </div>
                                <div class="form-row hidden-row">
                                    <input type="hidden" name="hidden" value=""/>
                                </div>
                                <div class="nocomment">
                                    <label for="nocomment">Leave This Field Empty</label>
                                    <input id="nocomment" value="" name="nocomment"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="button-row pull-right">
                                    <input type="submit" value="Send Message" name="submit" class="btn btn-submit bm0"/>
                                </div>
                            </div>
                            <div class="col-sm-6 lp5">
                                <div class="button-row pull-left">
                                    <input type="reset" value="Clear Message" name="reset" class="btn btn-submit bm0"/>
                                </div>
                            </div>
                            <input type="hidden" name="v_error" id="v-error" value="Required"/>
                            <input type="hidden" name="v_email" id="v-email" value="Enter a valid email"/>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- /.form-container -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /#contact -->
    <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
    <!-- Faire marque parge -->
    <?php else : ?>
    <section id="register">
        <div class="box">
            <h2 class="section-title">Inscription</h2>
            <div class="divide20"></div>
            <div class="form-container">
                <div class="response alert alert-success"></div>
                <form class="" action="/register" method="post">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-row text-input-row name-field">
                                    <label>Nom</label>
                                    <input type="text" name="lastname" class="text-input defaultText required"
                                           value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getLastname(); endif; ?>" placeholder="Entrez votre nom"/>
                                    <?php if (isset($_SESSION['registerErrors']['lastname'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['lastname']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-row text-input-row name-field">
                                    <label>Prénom</label>
                                    <input type="text" name="firstname" class="text-input defaultText required"
                                           value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getFirstname(); endif; ?>"
                                           placeholder="Entrez votre prénom"/>
                                    <?php if (isset($_SESSION['registerErrors']['firstname'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['firstname']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-row text-input-row email-field">
                                    <label>Email</label>
                                    <!-- mettre email après les tests -->
                                    <input type="text" name="email" class="text-input defaultText required email"
                                           value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getEmail(); endif; ?>"
                                           placeholder="Entrez votre adresse email"/>
                                    <?php if (isset($_SESSION['registerErrors']['email'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['email']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-row text-input-row password-field">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                </div>
                                <div class="form-row text-input-row password-field">
                                    <label>Confirmation du mot de passe</label>
                                    <input type="password" name="confirmPassword" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                    <?php if (isset($_SESSION['registerErrors']['password'])) : ?>
                                        <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['password']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-row text-input-row role-field">
                                    <input type="hidden" name="role" class="text-input defaultText required" value="visitor" />
                                </div>
                                <div class="button-row pull-right tm31">
                                    <button type="submit" name="register" value="submit" class="btn btn-submit bm0">Inscription</button>
                                    <?php unset($_SESSION['registerForm']); ?>
                                    <?php unset($_SESSION['registerErrors']); ?>
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
    <!-- /#register -->
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
                                    <!-- mettre email après les tests -->
                                    <input type="text" name="email" class="text-input defaultText required email" placeholder="Entrez votre adresse email"/>
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
    <?php endif; ?>
    <!-- /#connexion -->
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