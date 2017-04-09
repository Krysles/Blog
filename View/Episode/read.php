<div class="container inner">
    <div class="single blog row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">

                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="post-title"><a href="/episode/<?php echo $ticket['number']; ?>"><?php echo $ticket['title'] ?></a></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <div class="meta">
                                <span class="category"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></span>
                                <span class="date"><?php echo $ticket['date'] ?></span>
                                <span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>
                                <span class="publish"><?php echo $ticket['publish'] . 'publié ou non'; ?></span>
                            </div>
                            <figure class="frame pull-right" style="width: 30%; margin-left: 20px; margin-bottom: 20px;">
                                <img src="<?php echo $ticket['url']; ?>" alt=""/>
                            </figure>
                            <p><?php echo htmlspecialchars_decode($ticket['content']); ?></p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>

                <div class="divide20"></div>

                <div id="comments" class="box">
                    <h3>4 Comments</h3>
                    <ol id="singlecomments" class="commentlist">
                        <li>
                            <div class="user frame"><img alt="" src="/style/images/art/u1.jpg" class="avatar"/></div>
                            <div class="message">
                                <div class="info">
                                    <h2><a href="#">Connor Gibson</a></h2>
                                    <div class="meta">
                                        <div class="date">January 14, 2010</div>
                                        <a class="reply-link" href="#">Reply</a></div>
                                </div>
                                <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula,
                                    eget
                                    lacinia odio sem nec elit. Sed posuere consectetur est at lobortis. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.
                                    Vestibulum
                                    id ligula porta felis euismod semper.</p>
                            </div>
                        </li>
                        <li>
                            <div class="user frame"><img alt="" src="/style/images/art/u2.jpg" class="avatar"/></div>
                            <div class="message">
                                <div class="info">
                                    <h2><a href="#">Nikolas Brooten</a></h2>
                                    <div class="meta">
                                        <div class="date">February 21, 2010</div>
                                        <a class="reply-link" href="#">Reply</a></div>
                                </div>
                                <p>Quisque tristique tincidunt metus non aliquam. Quisque ac risus sit amet quam sollicitudin vestibulum vitae malesuada libero. Mauris magna elit,
                                    suscipit non ornare et, blandit a tellus. Pellentesque dignissim ornare elit, quis mattis eros sodales ac.</p>
                            </div>
                            <ul class="children">
                                <li class="bypostauthor">
                                    <div class="user frame"><img alt="" src="/style/images/art/u3.jpg" class="avatar"/></div>
                                    <div class="message">
                                        <div class="bypostauthor">
                                            <div class="info">
                                                <h2><a href="#">Pearce Frye</a></h2>
                                                <div class="meta">
                                                    <div class="date">February 22, 2010</div>
                                                    <a class="reply-link" href="#">Reply</a></div>
                                            </div>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta
                                                sem
                                                malesuada magna mollis euismod. Maecenas sed diam eget risus varius blandit non magna.</p>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li>
                                            <div class="user frame"><img alt="" src="/style/images/art/u2.jpg" class="avatar"/></div>
                                            <div class="message">
                                                <div class="info">
                                                    <h2><a href="#">Nikolas Brooten</a></h2>
                                                    <div class="meta">
                                                        <div class="date">April 4, 2010</div>
                                                        <a class="reply-link" href="#">Reply</a></div>
                                                </div>
                                                <p>Nullam id dolor id nibh ultricies vehicula ut id. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam.
                                                    Pellentesque
                                                    ornare sem lacinia quam venenatis vestibulum.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="user frame"><img alt="" src="/style/images/art/u4.jpg" class="avatar"/></div>
                            <div class="message">
                                <div class="info">
                                    <h2><a href="#">Lou Bloxham</a></h2>
                                    <div class="meta">
                                        <div class="date">May 03, 2010</div>
                                        <a class="reply-link" href="#">Reply</a></div>
                                </div>
                                <p>Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus.</p>
                            </div>
                        </li>
                    </ol>
                </div>
                <!-- /#comments -->

                <div class="divide20"></div>

                <div class="comment-form-wrapper box">
                    <h3>Would you like to share your thoughts?</h3>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <form class="comment-form" name="form_name" action="#" method="post">
                        <div class="name-field">
                            <input type="text" name="first" title="Name*"/>
                        </div>
                        <div class="email-field">
                            <input type="text" name="first" title="Email*"/>
                        </div>
                        <div class="website-field">
                            <input type="text" name="first" title="Website"/>
                        </div>
                        <div class="message-field">
                            <textarea name="textarea" id="textarea" rows="5" cols="30" title="Enter your comment here..."></textarea>
                        </div>
                        <input type="submit" value="Submit" name="submit" class="btn btn-submit"/>
                    </form>
                </div>
                <!-- /.comment-form-wrapper -->

            </div>
        </div>
        <!-- /.content -->

        <aside class="col-md-4 col-sm-12 sidebar">

            <!--
            <div class="sidebox box widget">
                <form class="searchform" method="get">
                    <input type="text" id="s2" name="s" value="type and hit enter" onfocus="this.value=''" onblur="this.value='type and hit enter'"/>
                </form>
            </div>
            -->
            <!-- /.widget -->

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
            </div>
            <!-- /.widget -->

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Episodes adjacents</h3>
                <ul class="circled">
                    <li><a href="#">Web Design (21)</a></li>
                    <li><a href="#">Photography (19)</a></li>
                    <li><a href="#">Graphic Design (16)</a></li>
                    <li><a href="#">Manipulation (15)</a></li>
                    <li><a href="#">Motion Graphics (12)</a></li>
                </ul>
            </div>
            <!-- /.widget -->

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Accès rapide</h3>
                <ul class="tag-list">
                    <li><a href="#" class="btn">Commenter l'épisode</a></li>
                    <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                    <li><a href="/episode/0/publish" class="btn">Publier l'épisode</a></li>
                    <li><a href="/episode/create" class="btn">Créer un nouvel épisode</a></li>
                    <li><a href="/episode/2/update" class="btn">Editer l'épisode</a></li>
                    <li><a href="/episode/3/delete" class="btn">Supprimer l'épisode</a></li>
                    <?php endif; ?>
                </ul>
                <!-- /.tag-list -->
            </div>
            <!-- /.widget -->

        </aside>
        <!-- /column .sidebar -->

    </div>
    <!-- /.blog -->

</div>
<!-- /.container -->
