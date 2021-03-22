<?php

/** 
 * Template name: Home Template
 */

get_header();

global $wp_query;
?>

<?php
while (have_posts()) :
  the_post();
?>

  <section class="contact_us" id="1">
    <div class="wrapper">
      <div class="contact_box">
        <h1 class="title"><?php echo rwmb_meta('piroll-home_title'); ?></h1>
        <p class="description">
          <?php echo rwmb_meta('piroll-home_desc'); ?>
        </p>
        <a class="button btn btn-white btn-animate" href="#"><?php echo rwmb_meta('piroll-home_bttn'); ?></a>
      </div>
    </div>
  </section>

  <section class="about_us" id="2">
    <div class="about">
      <div class="wrapper">
        <div class="about_box">
          <h2 class="title"><?php echo rwmb_meta('piroll-about_title'); ?></h2>
          <p class="description">
            <?php echo rwmb_meta('piroll-about_desc'); ?>
          </p>

          <?php
          $about_img = rwmb_meta('piroll-about_img');
          $about_image_id = array_key_first($about_img);

          if ($about_img) {
          ?>
            <img src="<?php echo esc_url($about_img[$about_image_id]["full_url"]); ?>" alt="" />
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="skills">
      <div class="left_box">
        <div class="wrapper">
          <h2 class="title"><?php echo rwmb_meta('piroll-skills_title'); ?></h2>

          <ul class="items_list">
            <?php
            $skills_name = rwmb_meta('piroll-skills_name');
            $skills_fill = rwmb_meta('piroll-skills_fill');

            for ($i = 0; $i < count($skills_name); $i++) {
              if (isset($skills_name[$i]) && isset($skills_fill[$i])) {
            ?>
                <li class="item">
                  <div class="item_text">
                    <h3 class="item_title"><?php echo $skills_name[$i]; ?></h3>
                    <span class="item_fill"><?php echo $skills_fill[$i]; ?>%</span>
                  </div>

                  <div class="meter">
                    <span style="width: <?php print_r($skills_fill[$i]) + print_r('%;'); ?> "></span>
                  </div>
                </li>
            <?php }
            } ?>
          </ul>
        </div>
      </div>

      <div class="right_box">
        <?php
        $skills_img = rwmb_meta('piroll-skills_img');
        $skills_img_id = array_key_first($skills_img);

        if ($skills_img) {
        ?>
          <img src="<?php echo esc_url($skills_img[$skills_img_id]["full_url"]); ?>" alt="" />
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="work" id="3">
    <div class="statictic">
      <div class="wrapper">
        <ul class="items_list">
          <?php
          $stat_title = rwmb_meta('piroll-stat_title');
          $stat_value = rwmb_meta('piroll-stat_value');
          $stat_icon = rwmb_meta('piroll-stat_icon');

          for ($i = 0; $i < count($stat_title); $i++) {
            //if (isset($skills_name[$i]) && isset($skills_fill[$i])) {
          ?>
            <li class="item">
              <span class="icon"><i class="<?php echo $stat_icon[$i]; ?>"></i></span>

              <div class="item_text">
                <span class="amount_text"><?php echo $stat_value[$i]; ?></span>
                <h3 class="title_text"><?php echo $stat_title[$i]; ?></h3>
              </div>
            </li>
          <?php //}
          } ?>
        </ul>
      </div>
    </div>

    <div class="gallery entry-content">
      <?php
      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '8',
        'paged' => 1,
      );
      $blog_posts = new WP_Query($args);

      $load_more = rwmb_meta('piroll-gallery_load_more');
      ?>

      <?php if ($blog_posts->have_posts()) : ?>
        <ul class="blog-posts gallery_list">
          <?php
          function console_log($data)
          {
            echo '<script>';
            echo 'console.log(' . json_encode($data) . ')';
            echo '</script>';
          }

          $i = 1;
          $value = 0;
          $color = "#dddddd";
          while ($blog_posts->have_posts()) : $blog_posts->the_post();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

            $color = "#dddddd";
            if ($value == 0 or $value % 2 == 0) {
              if ($i != 1 and ($i % 4 == 0)) {
                $value++;
              }

              if ($i % 2 == 0) {
                $color = "#838383";
              }
            } else {
              if ($i % 8 == 0) {
                $value++;
              }

              if ($i % 2 == 1) {
                $color = "#838383";
              }
            }

            $i++;
          ?>
            <li class="gallery_item" style="background: <?php echo $color; ?> ">
              <a class="link" href="<?php echo $image[0]; ?>">
                <?php echo get_the_post_thumbnail($blog_posts->ID, 'post_front'); ?>
                <span class="eye_icon"><i class="far fa-eye"></i></span>
              </a>
            </li>
          <?php endwhile;
          wp_reset_postdata();
          ?>
        </ul>

        <div class="loadmore">
          <span>
            <?php echo $load_more; ?>
          </span>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="work_process" id="4">
    <div class="wrapper">
      <div class="work_box">
        <h2 class="title"><?php echo rwmb_meta('piroll-process_title'); ?></h2>
        <p class="description">
          <?php echo rwmb_meta('piroll-process_desc'); ?>
        </p>
      </div>

      <div class="video_box">
        <figure>
          <?php
          $process_img = rwmb_meta('piroll-process_video_img');
          $process_img_id = array_key_first($process_img);

          if ($process_img) {
          ?>
            <img src="<?php echo esc_url($process_img[$process_img_id]["full_url"]);
                      ?>" alt="video" />
          <?php } ?>
          <figcaption>
            <a class="open_video" href="<?php echo rwmb_meta('piroll-process_video_link'); ?>">
              <span class="play_icon"><i class="fas fa-play"></i></span>
            </a>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>

  <section class="services" id="5">
    <div class="wrapper">
      <ul class="services_list">
        <?php
        $service_icon = rwmb_meta('piroll-service_icon');
        $service_title = rwmb_meta('piroll-service_title');
        $service_desc = rwmb_meta('piroll-service_desc');

        for ($i = 0; $i < count($service_title); $i++) {
          if (isset($service_icon[$i]) && isset($service_title[$i]) && isset($service_desc[$i])) {
        ?>
            <li class="service_item">
              <span class="icon"><i class="<?php echo $service_icon[$i]; ?>"></i></span>
              <h3 class="service_title"><?php echo $service_title[$i]; ?></h3>
              <p class="service_description">
                <?php echo $service_desc[$i]; ?>
              </p>
            </li>
        <?php }
        } ?>
      </ul>
    </div>
  </section>

  <section class="testimonials" id="6">
    <div class="reviews">
      <div class="reviews_slider">
        <?php
        $testimonials_name = rwmb_meta('piroll-testimonials_name');
        $testimonials_desc = rwmb_meta('piroll-testimonials_desc');

        for ($i = 0; $i < count($testimonials_name); $i++) {
          if (isset($testimonials_name[$i]) && isset($testimonials_desc[$i])) {
        ?>
            <div class="slide">
              <div class="wrapper">
                <p class="slide_description">
                  <?php echo $testimonials_desc[$i]; ?>
                </p>
                <h3 class="slide_author"><?php echo $testimonials_name[$i]; ?></h3>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>

    <div class="clients">
      <div class="wrapper">
        <ul class="clients_list">
          <?php
          $clients_img = rwmb_meta('piroll-clients_img');
          $clients_img_id = array_key_first($clients_img);

          for ($i = 0; $i < count($clients_img); $i++) {
          ?>
            <li class="client_item">
              <img class="client_logo" src="<?php echo $clients_img[$clients_img_id - $i]['url']; ?>" alt="client1" />
            </li>
          <?php
          } ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="contacts" id="7">
    <div class="wrapper">
      <div class="contacts_box">
        <h2 class="contacts_title"><?php echo rwmb_meta('piroll-contact_title'); ?></h2>
        <p class="contacts_description">
          <?php echo rwmb_meta('piroll-contact_desc'); ?>
        </p>

        <?php
        $shortcode = rwmb_meta('piroll-contact_shortcode');
        echo do_shortcode($shortcode);
        ?>

        <!-- <form class="contacts_form">
          <input class="input_name" type="text" placeholder="Your Name" required />
          <input class="input_email" type="email" placeholder="Your Mail" required />
          <input class="input_title" type="text" placeholder="Your Title" required />
          <textarea placeholder="Your Comment"></textarea>
          <div class="submit">
            <input type="submit" value="SEND MESSAGE" />
          </div>
        </form> -->
      </div>
    </div>
  </section>

<?php
endwhile;
?>

<?php get_footer() ?>