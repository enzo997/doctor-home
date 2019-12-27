<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy 
 *
 * @package SuperBlog
 *
 * @subpackage JV_SuperBlog
 *
 * @since JV SuperBlog 1.0
 *
*/ 
get_header(); ?>
<?php
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
var_dump($author);
?>

<?php get_footer();?> 