<!-- Footer Menu Insert Here -->
<?php wp_nav_menu(array( 'theme_location' => 'footer','container' => false,'menu_class' => 'footer-nav', )); ?>

<!-- Social Menu -->
<?php wp_nav_menu(array( 'theme_location' => 'social','container' => false,'menu_class' => 'social-nav','fallback_cb' => 'default_header_nav', )); ?>