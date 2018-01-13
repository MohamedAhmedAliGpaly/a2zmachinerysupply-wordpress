<?php
wp_nav_menu( array(
    'theme_location' => 'left_menu',
    'container' => 'div',
    'container_class' => 'left-menu',
) );
?>


<?php if ( is_active_sidebar( 'left_sidebar' ) ) : ?>
    <div class="left-sidebar widget-area" role="complementary">
        <ul>
            <?php dynamic_sidebar( 'left_sidebar' ); ?>
        </ul>
    </div><!-- #primary-sidebar -->
<?php endif; ?>


<nav class="navbar navbar-default navbar-static responsive-nav visible-xs" id="navbar-example">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="collapsed navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> <a href="http://www.a2zmachinerysupply.com/" class="navbar-brand">Toggle Navigation</a>
        </div> <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'left_menu',
                ) );
                ?>
            </ul>
        </div>
    </div>
</nav>