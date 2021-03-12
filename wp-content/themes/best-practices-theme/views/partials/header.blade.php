<nav class="navbar navbar-light navbar-expand-lg justify-content-between">

  <div class="navbar__logo">
    <a href="{{get_home_url()}}"><img src="" alt="" class=""></a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    {{
    wp_nav_menu(array(
        'theme_location'  => 'primary',
          'depth'           => 2,
          'container'       => 'div',
          'container_class' => 'navbar-collapse',
          'menu_class'      => 'nav navbar__nav navbar-nav ml-auto',
          'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
          'walker'          => new WP_Bootstrap_Navwalker()
    ))
  }}
  </div>
</nav>