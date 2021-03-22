<?php
global $piroll_options;
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Nunito+Sans&family=Work+Sans&display=swap" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  $custom_logo = $piroll_options['piroll-logo']['url'];
  ?>

  <header id="header_id">
    <div class="wrapper">
      <div class="header_box">
        <?php if ($custom_logo) { ?>
          <a href="<?php echo home_url("/"); ?>">
            <img src="<?php echo esc_url($custom_logo); ?>" alt="logo" />
          </a>
        <?php } ?>

        <nav class="header_menu" id="header_menu">
          <?php
          wp_nav_menu(array(
            'theme_location'   => 'header',
            'menu_id'       => 'header',
            'container'     => 'ul',
          ));
          ?>
        </nav>
      </div>
    </div>
  </header>