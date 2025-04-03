<?php

/*  Kill attachment, search, author, daily archive pages
------------------------------------------------ */
add_action('template_redirect', 'pd_template_redirect');
function pd_template_redirect()
{
global $wp_query, $post;

if (is_author() || is_attachment() || is_day() || is_search())
{
  wp_redirect(get_option('home'));
  exit;
}

if (is_feed())
{
    $author     = get_query_var('author_name');
    $attachment = get_query_var('attachment');
    $attachment = (empty($attachment)) ? get_query_var('attachment_id') : $attachment;
    $day        = get_query_var('day');
    $search     = get_query_var('s');

    if (!empty($author) || !empty($attachment) || !empty($day) || !empty($search))
    {
        $wp_query->set_404();
        $wp_query->is_feed = false;
    }
  }
}


/** Disable comments.  */
function prefix_remove_comments_tl() {
  remove_menu_page( 'edit-comments.php' );
}  
add_action( 'admin_menu', 'prefix_remove_comments_tl' );



/** Disable SVG code. */
// remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


/**
 * Change Read More from default [...]
 */
function pd_change_and_link_excerpt( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
 }
 add_filter( 'excerpt_more', 'pd_change_and_link_excerpt', 999 );