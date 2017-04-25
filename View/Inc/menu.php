<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header"><a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
        <div class="navbar-brand text-center"><a href="/"><img src="/style/images/logo.png" alt="" data-src="/style/images/logo.png" data-ret="/style/images/logo@2x.png"
                                                               class="retina"/></a></div>
        <!-- /.navbar-brand -->
    </div>
    <!-- /.navbar-header -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="current"><a href="/#home" class="hint--right" data-hint="Accueil"><i class="budicon-home-1"></i><span>Accueil</span></a></li>
            <li><a href="/#about" class="hint--right" data-hint="Résumé du livre"><i class="budicon-note-9"></i><span>Résumé du livre</span></a></li>
            <!-- Portfolio
            <li><a href="#portfolio" class="hint--right" data-hint="pas util"><i class="budicon-image"></i><span>Portfolio</span></a></li>
            -->
            <li><a href="/page" class="hint--right" data-hint="épisodes"><i class="budicon-book-1"></i><span>épisodes</span></a></li>
            <li><a href="/#contact" class="hint--right" data-hint="Contact"><i class="budicon-profile"></i><span>Contact</span></a></li>

            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                <li><a href="/admin" class="hint--right" data-hint="Tableau de bord"><i class="budicon-setting"></i><span>Tableau de bord</span></a></li>
                <li><a href="/deconnexion" class="hint--right" data-hint="Déconnexion"><i class="budicon-cancel-1"></i><span>Déconnexion</span></a></li>
            <?php else : ?>
                <li><a href="/#register" class="hint--right" data-hint="Inscription"><i class="budicon-author"></i><span>Inscription</span></a></li>
                <li><a href="/#connexion" class="hint--right" data-hint="Connexion"><i class="budicon-lock"></i><span>Connexion</span></a></li>

            <?php endif; ?>
            <li><a href="#elsewhere" class="hint--right fancybox-inline" data-hint="Retrouvez-moi" data-fancybox-width="325" data-fancybox-height="220"><i
                        class="icon-heart-empty-1"></i><span>Retrouvez-moi</span></a></li>
        </ul>
        <!-- /.navbar-nav -->
    </div>

    <!-- /.navbar-collapse -->
    <div id="elsewhere" style="display:none;">
        <h1>Rejoignez-moi</h1>
        <div class="divide20"></div>
        <ul class="social">
            <li><a href="#"><i class="icon-s-twitter"></i></a></li>
            <li><a href="#"><i class="icon-s-facebook"></i></a></li>
            <li><a href="#"><i class="icon-s-instagram"></i></a></li>
            <li><a href="#"><i class="icon-s-flickr"></i></a></li>
            <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
            <li><a href="#"><i class="icon-s-linkedin"></i></a></li>
        </ul>
    </div>
    <!-- /#elsewhere -->
</nav>
<!-- /.navbar -->