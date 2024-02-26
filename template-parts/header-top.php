<?php
/**
 * Template part for displaying top content in header.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liga-de-debate
 */

?>

<div id="top" class="top bg-primary">
    <div class="container">
        <div class="region region-top">
            <?php dynamic_sidebar('top-content-1'); ?>

            <?php if (is_active_sidebar('top-menu-language')) { ?>
                <!-- Bloque de idiomas -->
                <div id="block-bloqueidiomas" class="block block-language">
                    <div class="cont-idiomas btn-group">
                        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="true">
                            <span class="icon--lang"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <?php dynamic_sidebar('top-menu-language'); ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <!-- Bloque de busqueda -->
            <div class="search-block-form" id="block-fidban-search" role="search">
                <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="">
                    <input type="text" class="form-search" name="s" id="s"/>
                </form>
            </div>
                
            <!-- Bloque de redes sociales -->
            <?php
            dynamic_sidebar('top-content');
            ?>
        </div>
    </div>
</div>