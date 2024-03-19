<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liga-de-debate
 */

?>

</div><!-- #content -->

<a href="#" class="js-to-top btn-primary btn-to-top"><i class="fa fa-angle-up"></i></a>

<footer id="colophon" class="site-footer bg-dimgray color-white">
    <div class="container">
        <div class="site-info py-2 text-right">
            &copy; Copyright Universidad Europea del Atlántico
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-2',
                    'menu_id' => 'menu-menu-footer',
                    'depth' => 1,
                    'container' => 'div',
                    'container_class' => 'menu-menu-footer-container',
                    'menu_class' => 'menu',
                )
            );
            ?>
            <?php dynamic_sidebar('footer-menu'); ?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div> <!-- / .container-global -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>