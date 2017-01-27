<div id="buddypress" class="full_width">

	<?php do_action( 'bp_before_activation_page' ); ?>

	<div class="page" id="activate-page">

		<?php do_action( 'template_notices' ); ?>

		<?php do_action( 'bp_before_activate_content' ); ?>

		<?php if ( bp_account_was_activated() ) : ?>

			<?php if ( isset( $_GET['e'] ) ) : ?>
				<p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
			<?php else : ?>
				<p>Проверьте адрес электронной почты. На ваш email поступило письмо с темой "Логин и пароль для сайта kabacademy.com". <a href ="<?php home_url();?>/login/">Авторизуйтесь</a> на сайте используя логин и пароль из письма.</p>
			<?php endif; ?>
		<?php else : ?>

			<p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

			<form action="" method="get" class="standard-form" id="activation-form">

				<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
				<input type="text" name="key" id="key" value="" />

				<p class="submit">
					<input type="submit" name="submit" value="<?php esc_attr_e( 'Activate', 'buddypress' ); ?>" />
				</p>

			</form>

		<?php endif; ?>

		<?php do_action( 'bp_after_activate_content' ); ?>

	</div><!-- .page -->

	<?php do_action( 'bp_after_activation_page' ); ?>

</div><!-- #buddypress -->