<?php $this->title = "Accueil" ?>

<section id="home" class="naked">
    <div class="fullscreenbanner-container revolution">
        <div class="fullscreenbanner">
            <ul>
                <li data-transition="fade"><img src="/style/images/dummy.png" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat">
                    <h1 class="tp-caption caption large sfb" data-x="center" data-y="400" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100"
                        data-easing="Sine.easeOut" style="font-size: 50px; text-shadow: 1px 1px 1px black;"><?php echo $configuration->getTitle(); ?></h1>
                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="500" data-voffset="25" data-speed="100"
                         data-start="1500"
                         data-easing="Power4.easeOut"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.03"
                         data-endelementdelay="0"
                         data-endspeed="100"
                         data-endeasing="Power1.easeOut"
                         style="z-index: 3; font-size: 35px; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 1px 1px 1px black;"><?php echo $configuration->getSubtitle(); ?>
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
    <?php include 'Inc/summary.php'; ?>
    <?php include 'Inc/contact.php'; ?>
    <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
        <!-- On pourrai envisager de faire apparaitre des marques pages -->
    <?php else : ?>
        <?php include 'Inc/register.php'; ?>
        <?php include 'Inc/connexion.php'; ?>
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