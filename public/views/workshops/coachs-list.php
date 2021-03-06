<?php self::_render( 'components/page-header', [ 'title' =>'Ateliers' ] ); ?>

<div class="row">
    <div class="col-md-12">
    
        <?php self::_render( 'components/tabs-toolsheader', [ 
                                'tabs'=>$datas->tabs
                            ] ); ?>
        <section>
            <?php self::_render( 'components/section-toolsheader', [ 
                                'title' => 'Formateurs',
                                'subtitle' => ' - '.( count( $datas->datas ) ).' formateur(s)', 
                                'tool-add' => true,
                                'tool-add-right' => 'add',
                                'tool-add-url' => '/workshops/coachform/',
                                'tool-add-label' => 'Ajouter un formateur',
                                'rightpage' => 'users',
                                'response' => $datas->response,
                                'tool-dropdown' => true,
                                'tool-dropdown-list' => $datas->dropdownlist
                            ] ); ?>
            
            <div class="body-section"> 
                 <?php
            if( isset( $datas->datas ) )
            {
                foreach( $datas->datas as $coach )
                {
                ?>

                <div class="col-md-4 col-sm-4 col-xs-12 <?php echo $coach->StatutFormateur; ?>" id="<?php echo $coach->IdCoach; ?>">
                    <div class="well profile_view">
                        <div data-displayinfo-classname="coach_<?php echo $coach->IdCoach; ?>" data-toggle="modal" data-target="#ModalCoachInfos">
                        <h4><i>Formateur</i></h4>
                        <div class="col-sm-12">
                            <h2><?php echo $coach->FirstnameCoach . ' ' . $coach->LastnameCoach; ?></h2>
                            <p><strong><?php echo $coach->ExpertiseCoach; ?></strong></p>
                            <ul class="list-unstyled user_data">
                                <?php echo ( !empty( $coach->AddressCoach ) ) ?  '<li><i class="mdi mdi-map-marker"></i>' . $coach->AddressCoach . '<br />' . $coach->NpaCoach . ' ' . $coach->CityCoach . '</li>' : ''; ?>
                                <?php echo ( !empty( $coach->PhoneCoach ) ) ?  '<li><i class="mdi mdi-phone"></i>' . $coach->PhoneCoach . '</li>' : ''; ?>
                                <?php echo ( !empty( $coach->EmailCoach ) ) ?  '<li><i class="mdi mdi-email"></i>' . $coach->EmailCoach . '</li>' : ''; ?>
                            </ul>
                        </div>
                        </div>
                        <footer>
                            <ul class="nav navbar-right tools-hz-bar tools-wide">
                                              <li>
                                <span class="info-number" title="A animé <?php echo $coach->workshopsNbArchive; ?> cours archivé(s)">
                                    <i class="mdi mdi-account mdi-disabled"></i><span class="badge badge-info"><?php echo $coach->workshopsNbArchive; ?></span>
                                </span>
                            </li>
                            <li>
                                <span class="info-number" title="Anime <?php echo $coach->workshopsNbArchive; ?> cours actif(s)">
                                    <i class="mdi mdi-account"></i><span class="badge badge-info"><?php echo $coach->workshopsNbActual; ?></span>
                                </span>
                            </li>
                            <li class="margin-left-small">&nbsp;</li>
                            <li>
                                <a class="info-number operation" href="<?php echo SITE_URL; ?>/workshops/coachform/<?php echo $coach->IdCoach; ?>">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                            </li>
                            <?php 
                            if( !$coach->infos['hasDependencies'] )
                            {
                                ?>
                                <li>
                                    <a class="info-number operation" data-toggle="modal" data-target="#delete" data-action="delete" data-url="<?php echo SITE_URL; ?>/workshops/coachdelete/<?php echo $coach->IdCoach; ?>" href="">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            </ul>
                        </footer>
                    </div>
                </div>
                <?php
                }
            }
            ?>
           </div>
<?php self::_render( 'components/window-modal', [ 
                        'idname'=>'ModalCoachInfos', 
                        'title'=>'Informations formateur', 
                        'content-append'=>'workshops/coach-infos', 
                        'content-append-datas'=>$datas->datas
                    ] ); ?>
        
<?php self::_render( 'components/window-modal', [ 
                            'idname'=>'delete', 
                            'title'=>'Suppression d\'un atelier', 
                            'content'=>'Etes-vous sûr de vouloir supprimer un formateur ?', 
                            'submitbtn' => 'Supprimer' 
                        ] ); ?>
                
        </section>
    </div>
</div>