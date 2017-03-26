<div class=" sidebar" role="navigation">
    <div class="navbar-collapse">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <ul class="nav" id="side-menu">
                <?php
                    foreach($menus as $menu):
                    if($submenus = $menu->getSubmenus()):
                ?>
                    <li class="">
                        <a href="" role="button"><i class="fa <?php  echo $menu->icon;?> nav_icon"></i><?php echo $menu->name;?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php foreach($submenus as $submenu):?>
                            <li>
                                <a href="<?php echo \yii\helpers\Url::toRoute($submenu->route);?>"><?php echo $submenu->name;?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <!-- /nav-second-level -->
                    </li>
                <?php else:?>
                    <li>
                        <!--class="active"-->
                        <a href="<?php echo  \yii\helpers\Url::toRoute($menu->route);?>" ><i class="fa <?php echo $menu->icon;?> nav_icon"></i><?php echo $menu->name;?></a>
                    </li>
                <?php endif;endforeach;?>
            </ul>
            <!-- //sidebar-collapse -->
        </nav>
    </div>
</div>