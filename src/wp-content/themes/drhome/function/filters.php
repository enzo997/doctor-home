<?php
/** PREVENT UPDATE CHECK **/
add_filter( 'http_request_args', 'dm_prevent_update_check', 10, 2 );
function dm_prevent_update_check( $r, $url ) {
	if ( 0 === strpos( $url, 'http://api.wordpress.org/plugins/update-check/' ) ) {
		$my_plugin = plugin_basename( __FILE__ );
		$plugins = unserialize( $r['body']['plugins'] );
		unset( $plugins->plugins[$my_plugin] );
		unset( $plugins->active[array_search( $my_plugin, $plugins->active )] );
		$r['body']['plugins'] = serialize( $plugins );
	}
	return $r;
}

/** REMOVE DEFAULT IMAGE SIZE **/
add_filter('intermediate_image_sizes_advanced', 'hero_remove_default_image_sizes');
function hero_remove_default_image_sizes( $sizes) {
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	unset( $sizes['medium_large']);
	return $sizes;
}
?>