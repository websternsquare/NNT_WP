<?php

/**
 * Stop available updates logger from loading because it misbehaves with MU-Plugins
 */
add_filter('simple_history/logger/load_logger', function( $load_logger, $logger_basename ) {
	return $logger_basename !== 'AvailableUpdatesLogger';
}, 10, 2 );
