<?php get_header(); ?>
<h1>Le blog Capitaine WP</h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="post">
            <h2><?php the_title(); ?></h2>

            <?php the_post_thumbnail(); ?>

            <p class="post__meta">
                Publié le <?php the_time(get_option('date_format')); ?>
                par <?php the_author(); ?> • <?php comments_number(); ?>
            </p>

            <?php the_excerpt(); ?>

            <p>
                <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
            </p>
        </article>

<?php
    endwhile;
endif;
?>
<?php the_posts_pagination(); ?>
<div class="louloupiottes__navigation">
	<div class="louloupiottes__navigation__prev">
		<?php previous_posts_link( 'Page Précédente héhé' ); ?>
    </div>
    <div class="louloupiottes__navigation__next">
        <?php next_posts_link( 'Page Suivante haha' ); ?> 
    </div>
</div>
<?php get_footer(); ?>