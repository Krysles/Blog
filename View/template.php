<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/style/images/favicon.png">
    <title><?php echo $title . ' - Jean Forteroche'; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style/css/plugins.css" rel="stylesheet">
    <link href="/style/css/prettify.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
    <link href="/style/css/color/blue.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,700,600,500,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
    <link href="/style/type/fontello.css" rel="stylesheet">
    <link href="/style/type/budicons.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/style/js/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="full-layout">
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>
<div class="body-wrapper">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header"><a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
            <div class="navbar-brand text-center"><a href="/"><img src="/style/images/logo.png" alt="" data-src="/style/images/logo.png" data-ret="/style/images/logo@2x.png"
                                                                   class="retina"/></a></div>
            <!-- /.navbar-brand -->
        </div>
        <!-- /.navbar-header -->

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="current"><a href="./#home" class="hint--right" data-hint="Accueil"><i class="budicon-home-1"></i><span>Accueil</span></a></li>
                <!-- Portfolio
                <li><a href="#portfolio" class="hint--right" data-hint="pas util"><i class="budicon-image"></i><span>Portfolio</span></a></li>
                -->
                <li><a href="./#about" class="hint--right" data-hint="Résumé du livre"><i class="budicon-note-9"></i><span>Résumé du livre</span></a></li>
                <li><a href="blog.php" class="hint--right" data-hint="Lire le livre"><i class="budicon-book-1"></i><span>Lire le livre</span></a></li>
                <li><a href="./#contact" class="hint--right" data-hint="Contact"><i class="budicon-profile"></i><span>Contact</span></a></li>
                <!-- Remplacer le li si dessous par un lien de déconnexion direct -->
                <li><a href="./#register" class="hint--right" data-hint="Inscription"><i class="budicon-author"></i><span>Inscription</span></a></li>
                <li><a href="./#connexion" class="hint--right" data-hint="Connexion"><i class="budicon-lock"></i><span>Connexion</span></a></li>
                <!-- modifier le chemin pour l'admin vers admin.php par ex... et afficher ce li si l'utilisateur est connecté -->
                <li><a href="elements.html" class="hint--right" data-hint="Mon compte"><i class="budicon-setting"></i><span>Mon compte</span></a></li>
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


    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div id="error">
                <div class="response alert alert-<?php echo $type; ?>">
                    <?php echo $message; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>


    <!-- Chargement de la vue -->
    <?php echo $content; ?>

</div>
<!-- /.body-wrapper -->
<script src="/style/js/jquery.min.js"></script>
<script src="/style/js/bootstrap.min.js"></script>
<script src="/style/js/jquery.themepunch.tools.min.js"></script>
<script src="/style/js/classie.js"></script>
<script src="/style/js/plugins.js"></script>
<script src="/style/js/scripts.js"></script>
<script>
    $.backstretch(["/style/images/art/background.jpg"]);
</script>
</body>
</html>
