<?php global $qode_options_satellite; ?>
</div>
</div>
<footer class="clearfix footer">
<div class="container_inner">
    <?php
    $display_footer_top = true;
    if (isset($qode_options_satellite['show_footer_top'])) {
        if ($qode_options_satellite['show_footer_top'] == "no") $display_footer_top = false;
    }
    if ($display_footer_top) : ?>
                <?php
                $navOptions = array(
                    'container' => 'nav',
                    'container_class' => 'footerNav'
                );
                if (!is_user_logged_in())
                    $navOptions['menu'] = 'Footer menu (Signed)';
                else
                    $navOptions['menu'] = 'Footer menu (Unsigned)';

                wp_nav_menu($navOptions);
                ?>
            <span class="footer-copyrights">
                © <?php echo date("Y"); ?> <?php _e('All rights reserved', 'qode'); ?>
            </span>
    <?php endif;
    $display_footer_text = false;
    if (isset($qode_options_satellite['footer_text'])) {
        if ($qode_options_satellite['footer_text'] == "yes") $display_footer_text = true;
    }
    if ($display_footer_text): ?>
        <div class="footer_bottom_holder">
            <div class="footer_bottom">
                <?php dynamic_sidebar('footer_text'); ?>
            </div>
        </div>
    <?php endif; ?>
	</div>
</footer>
</div>
</div>
<?php
global $qode_toolbar;
if (isset($qode_toolbar)) include("toolbar.php")
?>
<?php wp_footer(); ?>
</body>
</html>