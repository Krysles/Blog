<?php $this->title = "Tableau de bord"; ?>

<div class="page">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="section-title text-center">Tableau de bord</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="box">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="pull-right"><em>(cliquez pour vous déplacer)</em></p>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="section-title white">
                                        <a data-toggle="collapse" class="active white" data-parent="#accordion" href="#collapseOne">Statistiques</a>
                                    </h3>
                                    <br/>
                                </div>
                                <div id="collapseOne" class="collapse in">
                                    <div class="row text-center services-3 facts">
                                        <div class="col-sm-4">
                                            <div class="row">
                                                <div class="col-xs-7 col-sm-9">
                                                    <div class="pull-right">
                                                        <i class="budicon-comment"></i>
                                                        <h4><?php echo $statistics->getNbComments(); ?></h4>
                                                        <p>commentaires</p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-5 col-sm-3">
                                                    <div class="small pull-left">
                                                        <i class="budicon-comment-3"></i>
                                                        <h5><?php echo $statistics->getNbCommentsUser(); ?></h5>
                                                        <p>vous</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-wrapper">
                                                <i class="budicon-comment-2"></i>
                                                <h4><?php echo $statistics->getNbTicketsPublish(); ?></h4>
                                                <p>épisodes<br/>publiés</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-wrapper">
                                                <i class="budicon-authors"></i>
                                                <h4><?php echo $statistics->getNbUsers(); ?></h4>
                                                <p>membres</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="section-title">
                                            <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseTwo">Gestion des épisodes et commentaires</a>
                                        </h3>
                                        <br/>
                                    </div>
                                    <div id="collapseTwo" class="collapse">
                                        <div class="row">
                                            <div class="col-sm-push-1 col-sm-5">
                                                <h5 class="">Episodes non publiés</h5>
                                                <ul class="circled">
                                                    <?php foreach ($ticketsNoPublish as $ticket) : ?>
                                                        <li>
                                                            <a href="/episode/<?php echo $ticket['number']; ?>">
                                                                <?php echo '(' . $ticket['number'] . ') ' . $ticket['title']; ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <br/>
                                                <br/>
                                                <ul class="tag-list">
                                                    <li><a href="/episode/create" class="btn">Créer un épisode</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-push-1 col-sm-5">
                                                <h5 class="">Commentaires signalés</h5>
                                                <?php if (empty($listCommentsReport)) : ?>
                                                    <p>Aucun commentaire signalé.</p>
                                                <?php else: ?>
                                                    <ol id="comments">
                                                        <?php foreach ($listCommentsReport as $commentReport) : ?>
                                                            <li>
                                                                <p class="nomarge"><b>Episode n°<?php echo $commentReport['number'] . ' - ' . $commentReport['title']; ?></b></p>
                                                                <p class="nomarge blue"><b><?php echo $commentReport['firstname'] . ' ' . $commentReport['lastname']; ?></b></p>
                                                                <p class="nomarge"><?php echo $commentReport['content']; ?></p>
                                                            <span class="meta">
                                                                <a class="approve grey" href="/comment/<?php echo $commentReport['id']; ?>/approve">Approuver</a>
                                                                <a class="report" href="/comment/<?php echo $commentReport['id']; ?>/delete">Supprimer</a>
                                                            </span>
                                                                <hr/>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="section-title">
                                            <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseThree">Gestion des utilisateurs</a>
                                        </h3>
                                        <br/>
                                    </div>
                                    <div id="collapseThree" class="collapse">
                                        <div class="row">
                                            <div class="form-container col-sm-push-1 col-sm-4">
                                                <h5 class="">Utilisateurs</h5>
                                                <div class="response alert alert-success"></div>
                                                <form class="" action="/user/banned" method="post">
                                                    <fieldset>
                                                        <div class="form-row text-input-row email-field">
                                                            <select name="id" class="col-sm-12">
                                                                <?php foreach ($users as $user) : ?>
                                                                    <option value="<?php echo $user['id']; ?>">
                                                                        <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="button-row tm31">
                                                            <button type="submit" name="banned" value="submit" class="btn btn-red bm0 pull-right">Bannir</button>
                                                            <?php unset($_SESSION['bannedForm']); ?>
                                                            <?php unset($_SESSION['bannedErrors']); ?>
                                                        </div>


                                                    </fieldset>
                                                </form>
                                            </div>
                                            <div class="col-sm-push-2 col-sm-5">
                                                <h5 class="">Utilisateurs bannis</h5>
                                                <ul id="comments">
                                                    <?php if (empty($usersBanned)) : ?>
                                                        <li>Aucun utilisateur banni</li>
                                                    <?php else: ?>
                                                        <?php foreach ($usersBanned as $user) : ?>
                                                            <li>
                                                                <p class="nomarge"><b class="blue"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></b> - <span
                                                                        class="meta"><a class="grey" href="/user/<?php echo $user['id']; ?>/approve">Débloquer</a></span>
                                                                </p>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="section-title">
                                            <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseFour">Configuration du livre</a>
                                        </h3>
                                        <br/>
                                    </div>
                                    <div id="collapseFour" class="collapse">
                                        <div class="row">
                                            <div class="col-sm-push-1 col-sm-10">
                                                <form method="post" action="/book/update" enctype="multipart/form-data">
                                                    <div class="form-row text-input-row title-field">
                                                        <label>Titre</label>
                                                        <input type="text" name="title" class="text-input defaultText required"
                                                               value="<?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getTitle(); endif; ?>"/>
                                                        <?php if (isset($_SESSION['bookErrors']['title'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['title']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-row text-input-row title-field">
                                                        <label>Sous-titre</label>
                                                        <input type="text" name="subtitle" class="text-input defaultText required"
                                                               value="<?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getSubtitle(); endif; ?>"/>
                                                        <?php if (isset($_SESSION['bookErrors']['subtitle'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['subtitle']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-row text-input-row content-field">
                                                        <label>Résumé</label>
                                                        <textarea id="content" name="summary" class="text-input defaultText required"><?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getSummary(); endif; ?></textarea>
                                                        <?php if (isset($_SESSION['bookErrors']['summary'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['summary']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-row text-input-row picture-field">
                                                        <label>Photo à la une</label>
                                                        <?php if ($_SESSION['bookForm']->getImgUrl()) : ?>
                                                            <figure class="frame" style="width: 30%; margin-left: 20px; margin-bottom: 20px;">
                                                                <img src="<?php echo $_SESSION['bookForm']->getImgUrl(); ?>" alt=""/>
                                                            </figure>
                                                            <a href="/book/imagedelete">
                                                                <button type="button" class="btn btn-submit bm0">Supprimer l'image</button>
                                                            </a>
                                                            <p>Photo actuellement lié à l'épisode, choisissez une autre photo pour la remplacer.</p>
                                                        <?php else : ?>
                                                            <p>Aucune photo n'est actuellement lié à cet épisode.</p>
                                                        <?php endif; ?>
                                                        <input type="file" name="image" class="text-input defaultText required"/>
                                                        <?php if (isset($_SESSION['bookErrors']['image'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['image']; ?></p>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="button-row tm31">
                                                        <button type="submit" name="book" value="submit" class="btn btn-submit bm0">Enregistrer</button>
                                                        <?php unset($_SESSION['bookForm']); ?>
                                                        <?php unset($_SESSION['bookErrors']); ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="section-title">
                                            <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseFive">Configuration du blog</a>
                                        </h3>
                                        <br/>
                                    </div>
                                    <div id="collapseFive" class="collapse">
                                        <div class="row">
                                            <div class="col-sm-push-1 col-sm-10">
                                                <form method="post" action="/configuration/update">
                                                    <div class="form-row text-input-row title-field">
                                                        <label>Titre</label>
                                                        <input type="text" name="title" class="text-input defaultText required"
                                                               value="<?php if (isset($_SESSION['configurationForm'])) : echo $_SESSION['configurationForm']->getTitle(); endif; ?>"/>
                                                        <?php if (isset($_SESSION['configurationErrors']['title'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['configurationErrors']['title']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-row text-input-row title-field">
                                                        <label>Accroche</label>
                                                        <input type="text" name="subtitle" class="text-input defaultText required"
                                                               value="<?php if (isset($_SESSION['configurationForm'])) : echo $_SESSION['configurationForm']->getSubtitle(); endif; ?>"/>
                                                        <?php if (isset($_SESSION['configurationErrors']['subtitle'])) : ?>
                                                            <p class="alert alert-danger"><?php echo $_SESSION['configurationErrors']['subtitle']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="button-row tm31">
                                                        <button type="submit" name="configuration" value="submit" class="btn btn-submit bm0">Enregistrer</button>
                                                        <?php unset($_SESSION['configurationForm']); ?>
                                                        <?php unset($_SESSION['configurationErrors']); ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="section-title">
                                            <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseSix">Gestion de compte</a>
                                        </h3>
                                        <br/>
                                    </div>
                                    <div id="collapseSix" class="collapse">
                                        <div class="row">
                                            <div class="col-sm-push-1 col-sm-10">
                                                <?php
                                                echo '<pre>';
                                                print_r($_SESSION);
                                                echo '</pre>';
                                                ?>
                                                Rappel des informations utilisateur
                                                Bouton pour changement de mot de passe
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr/> A  mettre si ajout d'élément de menu -->
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section>
            <div class="box">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="section-title">Tabs</h3>
                        <div class="tabs tabs-top left tab-container">
                            <ul class="etabs">
                                <li class="tab"><a href="#tab-1">This is</a></li>
                                <li class="tab"><a href="#tab-2">Tabbed</a></li>
                                <li class="tab"><a href="#tab-3">Content</a></li>
                                <li class="tab"><a href="#tab-4">Example</a></li>
                            </ul>
                            <!-- /.etabs -->
                            <div class="panel-container">
                                <div class="tab-block" id="tab-1">
                                    <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                        massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. </p>
                                    <p>Donec sed odio dui. Donec sed odio dui. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis
                                        interdum.</p>
                                    <ul class="circled">
                                        <li>Mauris lacinia dui non metus dignissim venenatis.</li>
                                        <li>Etiam elit tellus, condimentum tempor lobortis non.</li>
                                        <li>Aliquam pharetra vestibulum arcu, eget iaculis.</li>
                                    </ul>
                                </div>
                                <!-- /.tab-block -->
                                <div class="tab-block" id="tab-2">
                                    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum
                                        dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis
                                        euismod semper. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis
                                        vestibulum. Maecenas faucibus mollis interdum. </p>
                                </div>
                                <!-- /.tab-block -->
                                <div class="tab-block" id="tab-3">
                                    <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                        vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. </p>
                                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Fusce dapibus, tellus ac
                                        cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p>
                                </div>
                                <!-- /.tab-block -->
                                <div class="tab-block" id="tab-4">
                                    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                                    <p>Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna,
                                        vel scelerisque nisl consectetur et. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec sed odio dui.</p>
                                </div>
                                <!-- /.tab-block -->
                            </div>
                            <!-- /.panel-container -->
                        </div>
                        <!-- /.tabs -->
                    </div>
                    <!-- /column -->
                    <div class="col-sm-6">
                        <h3 class="section-title">Toggle</h3>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" class="panel-toggle active" data-parent="#accordion" href="#collapseOne"> 100%
                                            Responsive </a></h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a
                                        bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                        nesciunt sapiente.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" class="panel-toggle" data-parent="#accordion" href="#collapseTwo"> Clean & Professional
                                            Design </a></h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a
                                        bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                        synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" class="panel-toggle" data-parent="#accordion" href="#collapseThree"> Collapsible Group
                                            Item #3 </a></h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a
                                        bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                        synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->

                </div>
                <!-- /.row -->

                <hr/>

                <h3 class="section-title">Instagram Feed with Carousel</h3>
                <div class="swiper-wrapper ins"><a class="arrow-left btn" href="#"></a> <a class="arrow-right btn" href="#"></a>
                    <div class="swiper-container instagram">
                        <div id="instafeed" class="swiper"></div>
                    </div>
                </div>

                <hr/>

                <h3 class="section-title">Pricing Table</h3>
                <div class="pricing row">
                    <div class="col-md-3 col-sm-6">
                        <div class="plan">
                            <h3>Bronze</h3>
                            <h4><span class="amount"><span>$</span>3</span></h4>
                            <div class="features">
                                <ul>
                                    <li>3 Days</li>
                                    <li>2GB Storage</li>
                                    <li>25 Users</li>
                                    <li>Unlimited Pages</li>
                                    <li>Enhanced Security</li>
                                </ul>
                            </div>
                            <div class="select">
                                <div><a href="#" class="btn btn-gray">Select Plan</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="plan">
                            <h3><span class="featured f1"></span> Silver </h3>
                            <h4><span class="amount"><span>$</span>10</span></h4>
                            <div class="features">
                                <ul>
                                    <li>7 Days</li>
                                    <li>2GB Storage</li>
                                    <li>25 Users</li>
                                    <li>Unlimited Pages</li>
                                    <li>Enhanced Security</li>
                                </ul>
                                <div class="select">
                                    <div><a href="#" class="btn btn-gray">Select Plan</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="plan">
                            <h3>Gold</h3>
                            <h4><span class="amount"><span>$</span>20</span></h4>
                            <div class="features">
                                <ul>
                                    <li>30 Days</li>
                                    <li>2GB Storage</li>
                                    <li>25 Users</li>
                                    <li>Unlimited Pages</li>
                                    <li>Enhanced Security</li>
                                </ul>
                                <div class="select">
                                    <div><a href="#" class="btn btn-gray">Select Plan</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="plan">
                            <h3>Platinium</h3>
                            <h4><span class="amount"><span>$</span>30</span></h4>
                            <div class="features">
                                <ul>
                                    <li>120 Days</li>
                                    <li>2GB Storage</li>
                                    <li>25 Users</li>
                                    <li>Unlimited Pages</li>
                                    <li>Enhanced Security</li>
                                </ul>
                                <div class="select">
                                    <div><a href="#" class="btn btn-gray">Select Plan</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.pricing  -->

                <hr/>

                <h3 class="section-title">Facts</h3>
                <div class="row text-center services-3 facts">
                    <div class="col-sm-3">
                        <div class="col-wrapper"><i class="budicon-video-2"></i>
                            <h4>7518</h4>
                            <p>Shots Taken</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-wrapper"><i class="budicon-coffee"></i>
                            <h4>3472</h4>
                            <p>Cups of Coffee</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-wrapper"><i class="budicon-video"></i>
                            <h4>2184</h4>
                            <p>Movies Watched</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-wrapper"><i class="budicon-award-1"></i>
                            <h4>4523</h4>
                            <p>Awards Won</p>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="section-title">Progress Bar</h3>
                        <p>Duis non lectus sit amet est imperdiet cursus elementum vitae eros. Etiam adipiscingmorbi vitae magna tellus, ac mattis urna phasellus rhoncus.</p>
                        <div class="divide10"></div>
                        <ul class="progress-list">
                            <li>
                                <p>CSS/HTML <em>90%</em></p>
                                <div class="progress plain">
                                    <div class="bar" style="width: 90%;"></div>
                                </div>
                            </li>
                            <li>
                                <p>jQuery <em>80%</em></p>
                                <div class="progress plain">
                                    <div class="bar" style="width: 80%;"></div>
                                </div>
                            </li>
                            <li>
                                <p>Wordpress <em>85%</em></p>
                                <div class="progress plain">
                                    <div class="bar" style="width: 85%;"></div>
                                </div>
                            </li>
                            <li>
                                <p>SEO <em>50%</em></p>
                                <div class="progress plain">
                                    <div class="bar" style="width: 50%;"></div>
                                </div>
                            </li>
                        </ul>
                        <!-- /.progress-list -->
                    </div>
                    <!--/column -->
                    <div class="col-sm-6">
                        <h3 class="section-title">Google Map</h3>
                        <div id="map"></div>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1xdEVYy8IZdBKJGQp_QpDWaNQT7ZHGhY&sensor=false&extension=.js"></script>
                        <script> google.maps.event.addDomListener(window, 'load', init);
                            var map;
                            function init() {
                                var mapOptions = {
                                    center: new google.maps.LatLng(51.211215, 3.226287),
                                    zoom: 15,
                                    zoomControl: true,
                                    zoomControlOptions: {
                                        style: google.maps.ZoomControlStyle.DEFAULT,
                                    },
                                    disableDoubleClickZoom: false,
                                    mapTypeControl: true,
                                    mapTypeControlOptions: {
                                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                                    },
                                    scaleControl: true,
                                    scrollwheel: false,
                                    streetViewControl: true,
                                    draggable: true,
                                    overviewMapControl: false,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    styles: [{stylers: [{saturation: -100}, {gamma: 1}]}, {
                                        elementType: "labels.text.stroke",
                                        stylers: [{visibility: "off"}]
                                    }, {featureType: "poi.business", elementType: "labels.text", stylers: [{visibility: "off"}]}, {
                                        featureType: "poi.business",
                                        elementType: "labels.icon",
                                        stylers: [{visibility: "off"}]
                                    }, {featureType: "poi.place_of_worship", elementType: "labels.text", stylers: [{visibility: "off"}]}, {
                                        featureType: "poi.place_of_worship",
                                        elementType: "labels.icon",
                                        stylers: [{visibility: "off"}]
                                    }, {featureType: "road", elementType: "geometry", stylers: [{visibility: "simplified"}]}, {
                                        featureType: "water",
                                        stylers: [{visibility: "on"}, {saturation: 50}, {gamma: 0}, {hue: "#50a5d1"}]
                                    }, {featureType: "administrative.neighborhood", elementType: "labels.text.fill", stylers: [{color: "#333333"}]}, {
                                        featureType: "road.local",
                                        elementType: "labels.text",
                                        stylers: [{weight: 0.5}, {color: "#333333"}]
                                    }, {featureType: "transit.station", elementType: "labels.icon", stylers: [{gamma: 1}, {saturation: 50}]}]
                                }

                                var mapElement = document.getElementById('map');
                                var map = new google.maps.Map(mapElement, mapOptions);
                                var locations = [
                                    ['Boudewijn Ostenstraat 2', 51.211215, 3.226287]
                                ];
                                for (i = 0; i < locations.length; i++) {
                                    marker = new google.maps.Marker({
                                        icon: 'style/images/map-pin.png',
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map
                                    });
                                }
                            }
                        </script>
                    </div>
                    <!--/column -->

                </div>
                <!--/.row -->

                <hr/>

                <h3 class="section-title">Tooltip</h3>
                <p>Sed posuere consectetur est at lobortis. <a href="#" title="Tooltip on top" data-rel="tooltip" data-placement="top">Morbi leo risus</a>, porta ac consectetur
                    ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus
                    porttitor. Fusce dapibus, <a href="#" title="Tooltip on bottom" data-rel="tooltip" data-placement="bottom">tellus ac cursus</a> commodo, tortor mauris
                    condimentum nibh, ut fermentum massa justo sit amet risus. <a href="#" title="Tooltip on left" data-rel="tooltip" data-placement="left">Nullam id dolor</a>
                    id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. <a href="#" title="Tooltip on right" data-rel="tooltip" data-placement="right">Curabitur
                        blandit tempus</a> porttitor. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <hr/>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="section-title">Alerts</h3>
                        <div class="alert alert-warning"><strong>Warning!</strong> Best check yo self, you're not looking too good.</div>
                        <div class="alert alert-danger"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>
                        <div class="alert alert-success"><strong>Well done!</strong> You successfully read this important alert message.</div>
                        <div class="alert alert-info"><strong>Heads up!</strong> This alert needs your attention, but it's not super important.</div>
                    </div>
                    <!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <h3 class="section-title">Alerts with Dismiss</h3>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong> Best check yo self, you're not looking too good.
                        </div>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Oh snap!</strong> Change a few things up and try submitting again.
                        </div>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Well done!</strong> You successfully read this important alert message.
                        </div>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                        </div>
                    </div>
                    <!-- /.col-sm-6 -->
                </div>
                <!-- /.row -->

                <hr/>

                <h3 class="section-title">Buttons</h3>
                <a href="#" class="btn">Button</a> <a href="#" class="btn btn-green">Button</a> <a href="#" class="btn btn-blue">Button</a> <a href="#"
                                                                                                                                               class="btn btn-red">Button</a>
                <a href="#" class="btn btn-yellow">Button</a> <a href="#" class="btn btn-pink">Button</a> <a href="#" class="btn btn-gray">Button</a> <a href="#"
                                                                                                                                                         class="btn btn-aqua">Button</a>
                <a href="#" class="btn btn-orange">Button</a>
                <hr/>
                <h3 class="section-title">Testimonials</h3>
                <div class="testimonials row">
                    <div class="col-sm-4">
                        <blockquote>
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec
                                ullamcorper nulla non metus. </p>
                            <small>Alison McBrian</small>
                        </blockquote>
                    </div>
                    <div class="col-sm-4">
                        <blockquote>
                            <p>Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed
                                consectetur montes vestibulum. </p>
                            <small>Jack Welch</small>
                        </blockquote>
                    </div>
                    <div class="col-sm-4">
                        <blockquote>
                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem
                                lacinia quam venenatis vestibulum. </p>
                            <small>Coriss Ambady</small>
                        </blockquote>
                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="section-title">Unordered List</h3>
                        <ul class="circled">
                            <li>Pellentesque non diam et tortor dignissim.</li>
                            <li>Neque sit amet mauris egestas quis mattis.</li>
                            <li>Cras justo odio, dapibus ac facilisis.</li>
                            <li>Curabitur viver justo sed scelerisque.</li>
                            <li>Aenean lacinia bibendum nulla sed.</li>
                            <li>Nullam quis risus eget urna mollis ornare.</li>
                        </ul>
                    </div>
                    <!-- /column -->
                    <div class="col-sm-4">
                        <h3 class="section-title">Unordered List</h3>
                        <ul>
                            <li>Pellentesque non diam et tortor dignissim.</li>
                            <li>Neque sit amet mauris egestas quis mattis.</li>
                            <li>Cras justo odio, dapibus ac facilisis.</li>
                            <li>Curabitur viver justo sed scelerisque.</li>
                            <li>Aenean lacinia bibendum nulla sed.</li>
                            <li>Nullam quis risus eget urna mollis ornare.</li>
                        </ul>
                    </div>
                    <!-- /column -->
                    <div class="col-sm-4">
                        <h3 class="section-title">Ordered List</h3>
                        <ol>
                            <li>Pellentesque non diam et tortor dignissim.</li>
                            <li>Neque sit amet mauris egestas quis mattis.</li>
                            <li>Curabitur viver justo sed scelerisque.</li>
                            <li>Condimentum aenean risus malesuada.</li>
                            <li>Integer posuere erat a ante venenatis.</li>
                            <li>Aenean eu leo quam. Pellentesque ornare.</li>
                        </ol>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->

                <hr/>

                <h3 class="section-title">Blockquote</h3>
                <blockquote>
                    <p> Pellentesque non diam et tortor dignissim bibendum. Neque sit amet mauris egestas quis mattis velit fringilla. Curabitur viver justo sed scelerisque.
                        Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Praesent commodo cursus
                        magna, vel scelerisque.</p>
                    <small>Very important person</small>
                </blockquote>

                <hr/>

                <h3 class="section-title">Dropcap</h3>
                <p><span class="dropcap">D</span>uis non lectus sit amet est imperdiet cursus elementum vitae eros. Cras quis odio in risus euismod suscipit. Fusce viverra
                    ligula vel justo bibendum semper. Nulla facilisi. Donec interdum, enim in dignissim lacinia, lectus nisl viverra lorem, ac pulvinar nunc ante at neque.
                    Proin et dui eros, at aliquet est. Pellentesque consectetur lectus quis enim mollis ut convallis urna malesuada. Sed tincidunt interdum sapien vel gravida.
                    Nulla a tellus lectus, in aliquet tellus. Donec aliquam.</p>

                <hr/>

                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="section-title">Code Display</h3>
          <pre class="prettyprint linenums">
&lt;form&gt;
  &lt;fieldset&gt;
    &lt;legend&gt;Legend&lt;/legend&gt;
    &lt;label&gt;Label name&lt;/label&gt;
    &lt;input type="text" placeholder="Type something…"&gt;
    &lt;span class="help-block"&gt;Example block-level help text here.&lt;/span&gt;
    &lt;label class="checkbox"&gt;
      &lt;input type="checkbox"&gt; Check me out
    &lt;/label&gt;
    &lt;button type="submit" class="btn"&gt;Submit&lt;/button&gt;
  &lt;/fieldset&gt;
&lt;/form&gt;
</pre>
                        <!-- /.prettyprint -->
                    </div>
                    <!-- /column -->
                    <div class="col-sm-4">
                        <h3 class="section-title">Misc Typography</h3>
                        <p>Lorem <sup>superscript</sup> dolor <sub>subscript</sub> amet<br/>
                            <em>This is emphasised text</em><br/>
                            <strong>This is strong text</strong><br/>
                            <span class="lite">This is hightlight</span> <abbr title="This is an abbr - &lt;abbr&gt;&lt;/abbr&gt;">This is an abbr</abbr><br/>
                            <del>This is deleted text</del>
                            <br/>
                            <a href="#">This is a link</a></p>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.box -->
        </section>
        <!-- /section -->
    </div>
    <!-- /.container -->
</div>
<!-- /.page -->