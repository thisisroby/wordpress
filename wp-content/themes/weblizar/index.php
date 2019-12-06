<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage weblizar
 */
get_header();
$wl_theme_options = weblizar_get_options();
if ($wl_theme_options['_frontpage']=="on" && is_front_page() && 'posts' == get_option( 'show_on_front' )): get_template_part( 'frontpage' );
else: ?>
<div class="top-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 page-info">
                <h1 class="h1-page-title"><?php esc_html_e('Recent Posts', 'weblizar' ); ?></h1>				
            </div>
        </div>
    </div>
</div>
<div class="space-sep20"></div>	
<div class="content-wrapper">
	<div class="body-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<?php  if ( have_posts() ) : 
					while(have_posts()):the_post(); ?>
					<?php get_template_part( 'content' ); ?>
					<?php endwhile;
					 endif; ?>
					<div class="pagination">
					<?php if ( get_next_posts_link() ): ?>
						<?php next_posts_link('<span class="prev">&larr;</span>'.__('Older posts', 'weblizar' ) ); ?>
						<?php endif; ?>
						<?php if ( get_previous_posts_link() ): ?>
						<?php previous_posts_link( __( 'Newer posts', 'weblizar' ). '<span class="next">&rarr;</span>' ); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif;
get_footer(); ?>