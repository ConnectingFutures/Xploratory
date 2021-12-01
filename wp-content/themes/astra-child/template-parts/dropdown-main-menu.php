<?php
/**
 * Custom dropdown main menu
 */

?>
<div class="navbar" id="myTopnav"  style="display: none;">

    <div class="menu-wrapper">

        <div class="dropup menu-column-wrapper" id="dropup-menu">
           
            <div class="menu-columns">
                
            <div class="first-menu">
                <span class="custom-menu-title first-menu-title">Menu</span>
                <?php wp_nav_menu([
                    'menu' => 'First-main-menu',
                    'container' => 'div',
                    'container_id' => 'top-navigation-primary',
                    'container_class' => 'top-navigation',
                    'menu_class' => 'menu main-menu menu-depth-0 menu-even',
                    'echo' => true,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ]); ?>
            </div>


            <div class="second-menu">
                <?php wp_nav_menu([
                    'menu' => 'Second-main-menu',
                    'container' => 'div',
                    'container_id' => 'top-navigation-secondary',
                    'container_class' => 'top-navigation',
                    'menu_class' => 'menu main-menu menu-depth-0 menu-even',
                    'echo' => true,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ]); ?>
            </div>
            


            </div>

             <div class="menu-social-icons">
                    <a href="#"><img src="/wp-content/uploads/2021/11/twitter.png" alt=""></a>
                        <a href="#"><img src="/wp-content/uploads/2021/11/linked.png" alt=""></a>
                        <a href="#"><img src="/wp-content/uploads/2021/11/twitter.png" alt=""></a>
                      <a href="#"><img src="/wp-content/uploads/2021/11/linked.png" alt=""></a>
               
            </div>
            
        </div>

               


        <div class="menu-logo-wrapper">
                            <div class="menu-logo-xpl">
                                <a href="#"><img src="/wp-content/uploads/2021/11/image-2.png-2021-11-29-10-39-12.jpg" alt=""></a>
                            </div>


                            <div class="menu-logo-projects">
                                <p class="menu-project-text"> A project powered by: </p>
                                <div class="menu-logo-projects-img">
                                    <a href="#"><img src="/wp-content/uploads/2021/10/alpha-logo.svg" alt=""></a>
                                    <a href="#"><img src="/wp-content/uploads/2021/10/KoaStacked_Black.svg" alt=""></a>
                            </div>
                        </div>

            </div>
            

    </div>
    
    

</div>
