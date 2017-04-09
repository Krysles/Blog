<?php $this->title = $title ?>

<div class="container inner">
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">

                <?php foreach ($tickets as $ticket) : ?>
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="post-title"><a href="/episode/<?php echo $ticket['number']; ?>"><?php echo $ticket['title'] ?></a></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 post-content">
                                <div class="meta">
                                    <span class="category"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></span>
                                    <span class="date"><?php echo $ticket['date'] ?></span>
                                    <span class="comments">
                                        <a href="#">8 <i class="icon-chat-1"></i></a>
                                    </span>
                                </div>
                                <p><?php echo substr(strip_tags(htmlspecialchars_decode($ticket['content'])), 0, 150) . '...'; ?></p>
                                <p><a href="/episode/<?php echo $ticket['number']; ?>"><b>lire la suite</b></a></p>
                            </div>
                            <!-- /column -->
                            <div class="col-sm-4">

                                <figure class="frame">
                                    <a href="/episode/<?php echo $ticket['number']; ?>">
                                        <div class="text-overlay">
                                            <div class="info">
                                                <span>Lire la suite</span>
                                            </div>
                                        </div>
                                        <img src="<?php echo $ticket['url']; ?>" alt=""/>
                                    </a>
                                </figure>
                            </div>

                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                    </div>
                <?php endforeach; ?>
                <!-- /.post -->

            </div>
            <!-- /.blog-posts -->

            <?php echo $paginator; ?>
            <!-- /.pagination -->

        </div>
        <!-- /.content -->
        <aside class="col-md-4 col-sm-12 sidebar">

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Derniers épisodes</h3>
                <ul class="circled">
                    <?php foreach ($lastTickets as $ticket) : ?>
                        <li>
                            <a href="/episode/<?php echo $ticket['number']; ?>">
                                <?php echo $ticket['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.widget -->

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Episodes non publiés</h3>
                <ul class="circled">
                    <?php foreach ($ticketsNoPublish as $ticket) : ?>
                        <li>
                            <a href="/episode/<?php echo $ticket['number']; ?>">
                                <?php echo $ticket['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.widget -->
            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Accès rapide</h3>
                <ul class="tag-list">
                    <li><a href="/episode/create" class="btn">Créer un épisode</a></li>
                </ul>
                <!-- /.tag-list -->
            </div>
            <?php endif; ?>
            <!-- /.widget -->

        </aside>
        <!-- /column .sidebar -->
    </div>
    <!-- /.blog -->
</div>
<!-- /.container -->