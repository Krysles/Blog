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