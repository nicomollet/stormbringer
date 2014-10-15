<?php
// adding facebook, twitter, & google+ links to the user profile and remove AIM, Jabber, Yim
function stormbringer_contactmethods( $contactmethods ) {

	// Removes aim, jabber, yim fields
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);

	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google+';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','stormbringer_contactmethods',10,1);