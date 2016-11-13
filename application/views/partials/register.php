<div class="col-sm-12 content-parent col-md-8 col-xs-12">
    <div class="content registration-form">
        <div class="form">
          <div>
            <div class="row">
              <div class="col-sm-12 logo col-md-12 col-xs-12 text-center top-space50">
                      <img src="<?= config_item('img_path') ?>logo.png" alt="" >
              </div>
              <div class="col-md-offset-2 col-sm-offset-1 col-sm-11 col-md-8 col-xs-12 text-center top-space50">
                <div class="row bottom-space">
                  <div class="col-md-6 col-sm-6">
                    <form name="registerform" id="registerform" novalidate  ng-submit="registerform.$valid && search_emails(email)" class="form-horizontal top-space5"
                          method="post" action="<?php echo base_url()?>home/index" >
                            <div class="form-group">
                              <input type="text" ng-model="name" name="name" class="form-control input-lg" placeholder="Vor- & Nachname" required>
                                <span style="color:red" ng-show="registerform.name.$dirty && registerform.name.$invalid">
                                    <span ng-show="registerform.name.$error.required">Username is required.</span>
                                </span>

                            </div>
                            <div class="form-group">
                            <input type="email" ng-model="email"   name="email" class="form-control input-lg" placeholder="E-Mail-Addresse" ng-blur="search_emails()" required>
                                <div ng-show="check_cond" style="color: black;">
                                    <div>User with this email already exists.</div>
                                </div>
                                <span style="color:red" ng-show="registerform.email.$dirty && registerform.email.$invalid">
                                  <span ng-show="registerform.email.$error.required">Email is required.</span>
                                  <span ng-show="registerform.email.$error.email">Invalid email address.</span>
                                </span>

                            </div>
                            <div class="form-group">
                          <input type="password" name="password" class="form-control input-lg" placeholder="Kennwort" ng-model="password" required >
                                <span style="color:red" ng-show="registerform.password.$dirty && registerform.password.$invalid">
                                    <span ng-show="registerform.password.$error.required">Password is required.</span>
                                </span>
                            </div>
                            <div class="form-group">
                                    <button ng-disabled="check_cond || registerform.$invalid || registerform.email.$untouched" class="btn btn-register btn-default btn-block btn-lg" type="submit" name="register_submit_btn" >
                                            Registrieren
                                    </button>
                            </div>
                    </form>
                  </div>
                  <div class="col-md-6 col-sm-6">
                          <ul class="list-unstyled registration-instruction">
                                  <li>
                                          <i class="fa fa-television"></i>
                                          Abonniere Anime-Serien und Uploader
                                  </li>
                                  <li>
                                          <i class="glyphicon glyphicon-hd-video"></i>
                                          <span class="text-center">
                                              Lade kostenlos Video-Dateine in HD
                                          </span>

                                  </li>
                                  <li>
                                          <i class="fa fa-credit-card-alt"></i>
                                          Untertitelunterstutzung
                                  </li>
                                  <li>
                                          <i class="fa fa-money"></i>
                                          Verdiene Geld mit Werbeeinnahme
                                  </li>
                                  <li>
                                          <i class="fa fa-share-alt pull-left"></i>
                                         <span class="">
                                              Teile Animes mit deine Freunden
                                         </span>

                                  </li>
                                  <li>
                                          <i class="fa fa-heart"></i>
                                          Eine groBe Community
                                  </li>

                          </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="item top-space50 text-justify">
                <div>
                        <strong>Lorem ipsum dolor sit amet</strong>, consectetur adipisicing elit. Animi consequuntur
                        corporis, deserunt dolor enim impedit maxime molestiae suscipit? Accusantium aperiam
                        architecto asperiores blanditiis eos inventore iure iusto, maiores optio sint.
                </div>
                <div>Culpa dicta dignissimos non obcaecati reiciendis saepe voluptatibus. Culpa itaque
                        nemo non provident quas recusandae voluptate. A amet debitis doloremque ex excepturi
                        fugit itaque laborum laudantium recusandae repellat totam, ut!
                </div>
                <div>Alias at deserunt dolorem eaque et, facilis id nam provident recusandae reiciendis
                        sint, veniam voluptatibus. Cumque dolor error eum facilis itaque nulla tempore
                        totam. Amet dolore id quos sequi voluptatibus.
                </div>
                <div>Accusamus alias aliquid consequatur corporis culpa delectus dolore, eaque et eum
                        explicabo facilis maiores, non nulla numquam obcaecati odit omnis porro, quidem
                        similique vel veniam veritatis voluptate voluptates? Aliquid, quia.
                </div>
                <div>Aspernatur blanditiis deserunt, dolorem doloribus enim expedita itaque
                        necessitatibus neque nostrum officia ratione repellat sunt. Aperiam hic labore
                        laudantium, maiores maxime, natus numquam praesentium, quos ratione recusandae vitae
                        voluptas. Ut.
                </div>
                <div>Cupiditate illum laboriosam neque nisi praesentium quam quas, rem suscipit
                        voluptate? Animi atque culpa debitis deserunt dolorum incidunt laboriosam magni nemo
                        nihil nisi tempore tenetur, veniam veritatis? Cupiditate, optio, recusandae?
                </div>
                <div>Asperiores beatae culpa deserunt ducimus eligendi neque officia pariatur
                        perspiciatis possimus rem sint ullam veniam, vero. Doloribus ducimus id ipsam
                        molestiae nam porro quaerat sunt suscipit totam ullam. Enim, facilis!
                </div>
                <div>A aliquam amet assumenda consequuntur dolorum ea esse excepturi explicabo fugiat
                        ipsa iste itaque labore laboriosam magni neque nobis odio officia perferendis
                        perspiciatis, porro quia quidem quo rerum similique tempora.
                </div>
                <div>Ad, aut blanditiis cum doloribus eius enim nobis odio tenetur. Ab accusantium
                        blanditiis commodi deserunt distinctio dolorem, eaque esse eum, exercitationem
                        mollitia quae quo reiciendis reprehenderit suscipit vero. Ad, eius?
                </div>
                <div>A aliquid animi aspernatur, earum enim ex exercitationem, incidunt ipsa praesentium
                        quibusdam quos recusandae repellat sint tenetur ullam vitae, voluptatum! Doloremque,
                        eaque earum eligendi ipsa voluptas voluptate. Iusto placeat, vitae!
                </div>
        </div>

        <div class="item top-space50">
                <p class="lead"><i class="text-danger fa fa-commenting-o"></i> ANIME-JUNKIES.TV <strong>FAQ</strong></p>
                <div class="panel-group " id="accordion">
                        <div class="panel bottom-space panel-default ">
                                <div class="panel-heading">
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Collapsible Group Item #1
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                </div>
                        </div>
                        <div class="panel bottom-space panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        Collapsible Group Item #2
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                </div>
                        </div>
                        <div class="panel bottom-space panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                        Collapsible Group Item #3
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
    </div>



</div>