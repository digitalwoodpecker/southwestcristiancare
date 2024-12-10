<?php
/**
 * @var $args
 */

$block_id = $args['block_id'];
$services = array_slice( $args['services'], 0, 8 );

$section_title = get_field( 'services_section_title' );
?>

<?php if ( !empty( $services ) ) : ?>
	<?php
		get_template_part( 'template-parts/resources/section-background', '', [
			'class_name' => 'section-services__bg',
			'field_prefix' => 'services_section_background',
			'field_id' => ''
		] );
	?>

	<div class="section__body">
		<div class="section-services__content">
			<div class="container">
				<div class="section-services__header">
					<div class="section-title section-title--style1 section-services__title">
						<h2>
							<?= esc_html( $section_title ) ?>
						</h2>
					</div>
				</div>

				<div class="section-services__main <?= count( $services ) <= 8 ? 'horizontal' : ''; ?> ">
					<div class="section-services__services-accordeon accordeon <?= count( $services ) <= 8 ? 'accordeon--horizontal' : ''; ?> ">
						<?php foreach ( $services as $key => $service ) : ?>
							<?php
								$service_title = $service->post_title;
								$excerpt_custom = hmt_get_first_paragraph( get_the_content( null, null, $service->ID) );
								$short_description = get_field( 'post_excerpt', $service->ID );
								if( !$short_description ) {
									$short_description = get_extended($excerpt_custom)['main'];
								}
							?>
							<div class="service js-service-accordeon-item">
								<div class="service__wrapper">
									<div class="service__spine <?= $key == 0 ? 'active' : '' ?>">
										<div class="service__bg service__spine-bg">
											<?php
											get_template_part( 'template-parts/sections/service-featured-media', '', [
												'service_id' => $service->ID,
												'image_only' => true
											] );
											?>
										</div>

										<?php if ( $service_title ) : ?>
											<span class="service__name">
												<?= esc_html( $service_title ) ?>
											</span>
										<?php endif; ?>

										<span class="service__index"></span>
									</div>

									<div class="service__info <?= $key == 0 ? 'open active' : ''; ?>">
										<div class="service__info-columns">
											<div class="service__content-wrapper">
												<div class="service__content">
													<div class="service__index-bg <?= $key == 0 ? 'active' : '' ?>"></div>

													<div class="service__body <?= $key == 0 ? 'active' : ''; ?>">
														<div class="service__content-description">
															<?php if ( $service_title ) : ?>
																<h3 class="service__content-title">
																	<?= esc_html( $service_title ) ?>
																</h3>
															<?php endif; ?>

															<?php if ( $short_description ) : ?>
																<div class="service__excerpt text-content">
																	<?= hmt_truncate( apply_filters( 'the_content', $short_description ), 200, array('html' => true, 'ending' => '...') ) ?>
																</div>
															<?php endif; ?>
														</div>

														<a href="<?= esc_url( get_permalink( $service->ID ) ) ?>" class="service__content-button button button-bordered button-bordered-white">
															<span>
																<?= esc_html( __( 'Learn More', THEME_TEXTDOMAIN ) ) ?>
															</span>
															<span class="button__icon"></span>
														</a>
													</div>
												</div>
											</div>

											<div class="service__content-media">
												<div class="service__bg">
													<?php
													get_template_part( 'template-parts/sections/service-featured-media', '', [
														'service_id' => $service->ID,
														'media_group_key' => 'service_square_featured_media',
														'square' => true
													] );
													?>
												</div>

												<div class="service__play-button-wrapper">
													<?php
													get_template_part( 'template-parts/sections/service-featured-popup', '', [
														'service_id' => $service->ID
													] );
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
