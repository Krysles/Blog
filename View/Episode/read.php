<?php $this->title = $ticket['title']; ?>

<div class="container inner">
    <div class="single blog row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="post-title"><?php echo $ticket['title']; ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <div class="meta">
                                <span class="category"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></span>
                                <span class="date"><?php echo $ticket['date'] ?></span>
                                <span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>
                                <?php if ($ticket['publish'] == 0) : ?>
                                    <span class="publish">Non publié</span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($ticket['imgUrl'])) : ?>
                                <figure class="frame pull-right" style="width: 30%; margin-left: 20px; margin-bottom: 20px;">
                                    <img src="<?php echo $ticket['imgUrl']; ?>" alt=""/>
                                </figure>
                            <?php endif; ?>
                            <p><?php echo htmlspecialchars_decode($ticket['content']); ?></p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>

                <div class="divide20"></div>

                <?php if (isset($comments) && !empty($comments)) : ?>
                    <div id="comments" class="box">
                        <h3>Commentaires</h3>
                        <ol id="singlecomments" class="commentlist">
                            <?php foreach ($comments as $comment) : ?>
                                <li>
                                    <div class="message" id="comment-<?php echo $comment->id; ?>">
                                        <div class="info">
                                            <h2><?php echo $comment->firstname . ' ' . $comment->lastname; ?></h2>
                                            <div class="meta">
                                                <div class="date"><?php echo $comment->date; ?></div>
                                                <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                                                    <button class="reply" data-id="<?php echo $comment->id; ?>">répondre</button>
                                                    <?php if ($comment->report == 0) : ?>
                                                        <a href="/comment/<?php echo $comment->id; ?>/report" class="report">signaler</a>
                                                    <?php else : ?>
                                                        <span><em>Commentaire déjà signalé</em></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <p><?php echo $comment->content; ?></p>
                                    </div>
                                    <?php include 'Inc/comment.php'; ?>
                                </li>

                            <?php endforeach; ?>
                        </ol>
                    </div>
                <?php endif; ?>

                <div class="divide20"></div>

                <div class="comment-form-wrapper box">
                    <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                        <h5 id="comment-0">Laissez votre commentaire - <a class="reply" data-id="0">Commenter l'épisode</a></h5>
                        <form class="comment-form" name="form_name" action="/comment/create" method="post" id="form-comment">
                            <p>Tout commentaire non approprié sera supprimé et l'utilisateur sera restreint.</p>
                            <div class="field">
                                <input type="text" id="content" name="content" placeholder="Entrez votre commentaire" required="required"
                                       value="<?php if (isset($_SESSION['commentManagerForm'])) : echo $_SESSION['commentManagerForm']->getContent(); endif; ?>"/>
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>"/>
                                <input type="hidden" name="ticket_number" value="<?php echo $ticket['number']; ?>"/>
                                <input type="hidden" name="comment_id" value="0" id="comment_id"/>
                            </div>
                            <?php if (isset($_SESSION['commentManagerErrors']['content'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['commentManagerErrors']['content']; ?></p>
                            <?php endif; ?>
                            <button type="submit" value="submit" name="comment" class="btn btn-submit">Valider</button>
                            <?php unset($_SESSION['commentManagerForm']); ?>
                            <?php unset($_SESSION['commentManagerErrors']); ?>
                        </form>
                    <?php else : ?>
                        <h5>Veuillez vous connecter pour commenter l'épisode.</h5>
                    <?php endif; ?>
                </div>
                <!-- /.comment-form-wrapper -->

            </div>
        </div>
        <!-- /.content -->

        <aside class="col-md-4 col-sm-12 sidebar">
            <!--
                        <div class="sidebox box widget">
                            <h3 class="widget-title section-title">Derniers commentaires</h3>
                            <ul class="post-list">
                                <li>
                                    <figure class="frame pull-left">
                                        <div class="icon-overlay"><a href="blog-post.html"><img src="/style/images/art/a1.jpg" alt=""/> </a></div>
                                    </figure>
                                    <div class="meta"><em><span class="date">3 Oct 2012</span><span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span></em>
                                        <h5><a href="blog-post.html">Magna Mollis Ultricies</a></h5>
                                    </div>
                                </li>
                                <li>
                                    <figure class="frame pull-left">
                                        <div class="icon-overlay"><a href="blog-post.html"><img src="/style/images/art/a2.jpg" alt=""/> </a></div>
                                    </figure>
                                    <div class="meta"><em><span class="date">28 Sep 2012</span><span class="comments"><a href="#">5 <i class="icon-chat-1"></i></a></span></em>
                                        <h5><a href="blog-post.html">Ornare Nullam Risus</a></h5>
                                    </div>
                                </li>
                                <li>
                                    <figure class="frame pull-left">
                                        <div class="icon-overlay"><a href="blog-post.html"><img src="/style/images/art/a3.jpg" alt=""/> </a></div>
                                    </figure>
                                    <div class="meta"><em><span class="date">15 Aug 2012</span><span class="comments"><a href="#">9 <i class="icon-chat-1"></i></a></span></em>
                                        <h5><a href="blog-post.html">Euismod Nullam</a></h5>
                                    </div>
                                </li>
                            </ul>
                            <!-- /.post-list -->


            <!-- /.widget -->

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Episodes adjacents</h3>
                <ul class="circled">
                    <?php foreach ($adjacentTickets as $adjacentTicket) : ?>
                        <li>
                            <a href="/episode/<?php echo $adjacentTicket['number']; ?>">
                                <?php echo '(' . $adjacentTicket['number'] . ') ' . $adjacentTicket['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.widget -->

            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                <div class="sidebox box widget">
                    <h3 class="widget-title section-title">Accès rapide</h3>
                    <ul class="tag-list">
                        <li><a href="#comment-0" class="btn">Commenter l'épisode</a></li>
                        <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                            <li><a href="/episode/<?php echo $ticket['number']; ?>/update" class="btn">Editer l'épisode</a></li>
                            <li><a href="/episode/create" class="btn">Créer un épisode</a></li>
                            <li><a href="/episode/<?php echo $ticket['number']; ?>/delete" class="btn">Supprimer l'épisode</a></li>
                        <?php endif; ?>
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

