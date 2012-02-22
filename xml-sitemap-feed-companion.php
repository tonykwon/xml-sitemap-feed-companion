<?php
/*
Plugin Name: XML Sitemap Feed Companion
Plugin URI: http://tonykwon.com/wordpress-plugins/xml-sitemap-feed-companion/
Description: This plugin is a companion tool for <a href="http://4visions.nl/en/wordpress-plugins/xml-sitemap-feed/">XML Sitemap Feed</a> by RavanH. This plugin basically disables WordPress Canonical Redirect Filter on virtual URL /sitemap.xml
Version: 0.1
Author: Tony Kwon
Author URI: http://tonykwon.com/wordpress-plugins/xml-sitemap-feed-companion/
License: GPLv3
*/

add_action( 'parse_request', 'disable_canonical_redirects_on_virtual_url' );

function disable_canonical_redirects_on_virtual_url( $query )
{
	/* PHP 5.2 and higher */
	$q = filter_input( INPUT_GET, 'q', FILTER_SANITIZE_STRING );

	switch( $q )
	{
		case '/sitemap.xml/':
			/* redirect to sitemap.xml */
			wp_redirect( '/sitemap.xml', 301 );
			exit;
			break;

		case '/sitemap.xml':
			/* remove the Canonical Redirect filter */
			remove_filter( 'template_redirect', 'redirect_canonical' ); 
			break;
	}

	return $query;
}
