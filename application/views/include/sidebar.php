<div class="menu-toggle col-sm-2 col-md-2 col-xs-1 hide-ipad hidden-xs sidebar">
        <ul class="list-unstyled">
                <li>
                        <a href="home" class="text-muted">
                                <i class="fa fa-home"></i> START
                        </a>
                </li>
                <li class="divider">
                        <a href="anemitrend" class="text-muted">
                                <!--<img class="icon" src="img/line-graphic-arrow.svg" alt=""> ANIME TREND-->
                                <i class="icon-arrow-graph-up-gray"></i> ANIME TREND
                        </a>
                </li>
                <li ng-class="{'divider':(key+1)==categories.length}" ng-repeat="(key,category) in categories">
                        <a href="category/{{category.slug}}" class="text-muted">
                                <i class="{{category.css_icon}}" ng-if="category.css_icon!=null && category.css_icon.length>0"></i>
                                 {{ category.title}}
                        </a>
                </li>
                <!--<li class="divider">
                        <a href="#" class="text-muted">
                                <i class="icon-fontello-video"></i> ANIME SERIEN
                        </a>
                </li>-->
                <li>
                        <a href="meinevideos" class="text-muted">
                                <i class="fa fa-play-circle-o"></i> MEINE VIDEOS
                        </a>
                </li>
                <li>
                        <a href="uploadvideos" class="text-muted">
                                <i class="fa fa-upload"></i> ANIME UPLOAD
                        </a>
                </li>
        </ul>
</div>