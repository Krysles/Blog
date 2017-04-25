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
                                            <div class="col-sm-push-1 col-sm-5">
                                                <h5>Informations sur l'utilisateur</h5>
                                                <p><b>Prénom :</b> <?php echo $userInformations->getFirstname(); ?></p>
                                                <p><b>Nom :</b> <?php echo $userInformations->getLastname(); ?></p>
                                                <p><b>Email :</b> <?php echo $userInformations->getEmail(); ?></p>
                                                <p><b>Date d'inscription :</b> <?php echo $userInformations->getRegistDate(); ?></p>
                                            </div>
                                            <div class="col-sm-push-1 col-sm-5">
                                                <h5>Informations concernant votre mot de passe</h5>
                                                <?php if (!empty($userInformations->getResetDate())) : ?>
                                                    <p><b>Date de dernier changement de mot de passe :</b> <?php echo $userInformations->getResetDate(); ?></p>
                                                <?php else: ?>
                                                    <p><?php echo "Vous n'avez jamais changé votre mot de passe."; ?></p>
                                                <?php endif; ?>
                                                <form class="" action="/admin/reset" method="post">
                                                    <fieldset>
                                                        <p>Pour changer votre mot de passe, utiliser le formulaire ci-dessous.</p>
                                                                <div class="form-row text-input-row password-field">
                                                                    <label>Mot de passe</label>
                                                                    <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                                                </div>
                                                                <div class="form-row text-input-row password-field">
                                                                    <label>Confirmation du mot de passe</label>
                                                                    <input type="password" name="confirmPassword" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                                                    <?php if (isset($_SESSION['resetErrors']['password'])) : ?>
                                                                        <p class="alert alert-danger"><?php echo $_SESSION['resetErrors']['password']; ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-row text-input-row role-field">
                                                                    <input type="hidden" name="role" class="text-input defaultText required" value="visitor" />
                                                                </div>
                                                                <div class="button-row pull-right tm31">
                                                                    <button type="submit" name="reset" value="submit" class="btn btn-submit bm0">Valider</button>
                                                                    <?php unset($_SESSION['resetErrors']); ?>
                                                                </div>
                                                    </fieldset>
                                                </form>
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
</div>
<!-- /.page -->