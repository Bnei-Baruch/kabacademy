<?php
/**
 * Created by PhpStorm.
 * User: davgur
 * Date: 14.04.2015
 * Time: 19:41
 */
?>

<?php if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="column_inner">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>