<?php
global $piroll_options;
?>


<footer>
	<div class="wrapper">
		<div class="footer_box">
			<div class="footer_text">
				<h3 class="company_name"><?php echo esc_attr($piroll_options['piroll-company']); ?></h3>
				<span class="copyright"><?php echo esc_attr($piroll_options['piroll-copyright']); ?></span>
			</div>

			<div class="footer_contacts">
				<span class="email"><?php echo esc_attr($piroll_options['piroll-email']); ?></span>
				<span class="number"><?php echo esc_attr($piroll_options['piroll-number']); ?></span>
			</div>

			<nav class="footer_social">
				<?php
				wp_nav_menu(array(
					'theme_location' 	=> 'footer',
					'menu_id'			=> 'footer',
					'container'			=> 'ul'
				));
				?>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>