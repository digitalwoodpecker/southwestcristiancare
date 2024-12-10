<?php

/**
 * @var $args
 */

$initial_services = $args['services'];
$page_id = get_queried_object_id();

$section_title = get_field( 'services_section_title' );
$section_subtitle = get_field( 'services_section_subtitle' );

if(is_array($initial_services)){
	$services = array_filter( $initial_services ?? [], function ( $service ) use ( $page_id ) {
		$service_gallery = get_field( 'service_gallery', $service->ID );
		$service_media = $service_gallery[0]['service_media_group']['service_media_type'];
		$service_gallery_first_img_id = null;

		if ( $service_media['media_type'] == 'image' ) {
			$service_gallery_first_img_id = $service_media['image'];
		} elseif ( $service_media['media_type'] == 'video' ) {
			$service_gallery_first_img_id = $service_media['video_poster'];
		}

		return $service->ID != $page_id && $service_gallery_first_img_id;
	} );
}

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
					<?php if ( $section_title ) : ?>
						<div class="section-title section-title--style1 section-services__title">
							<h2>
								<?= esc_html( $section_title ) ?>
							</h2>
						</div>
					<?php endif; ?>

					<?php if ( $section_subtitle ) : ?>
						<div class="section-title section-title--style5 section-services__subtitle">
							<h2>
								<?= esc_html( $section_subtitle ) ?>
							</h2>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="swiper section-services__slider js-services-slider">
				<div class="swiper-wrapper">
					<?php foreach ( $services as $service ) : ?>
						<?php
							$service_link = get_permalink( $service->ID );
							$service_title = get_the_title( $service );
							$excerpt_custom = hmt_get_first_paragraph( get_the_content( null, null, $service->ID) );
							$short_description = get_field( 'post_excerpt', $service->ID );
							if( !$short_description ) {
								$short_description = get_extended($excerpt_custom)['main'];
							}
						?>

						<div class="swiper-slide">
							<div class="work-card">
								<div class="work-card__img">
									<?php
									get_template_part( 'template-parts/sections/service-featured-media', '', [
										'service_id' => $service->ID,
										'media_group_key' => 'service_square_featured_media',
										'image_only' => true
									] );
									?>
								</div>

								<?php if ( $service_title ) : ?>
									<div class="work-card__title work-card__title--main section-title section-title--style5">
										<h3>
											<?= esc_html( $service_title ) ?>
										</h3>
									</div>
								<?php endif; ?>

								<div class="work-card__full">
									<div class="work-card__full-body">
										<div class="scrollbar-outer">
											<div class="work-card__full-content">
												<?php if ( $service_title ) : ?>
													<div class="work-card__title section-title section-title--style5">
														<h3>
															<?= esc_html( $service_title ) ?>
														</h3>
													</div>
												<?php endif; ?>

												<?php if ( $short_description ) : ?>
													<div class="work-card__description text-content">
														<?= hmt_truncate( apply_filters( 'the_content', $short_description ), 400, array('html' => true, 'ending' => '...') ) ?>
													</div>
												<?php endif; ?>
											</div>
										</div>

										<div class="work-card__button-wrapper">
											<a class="button button-bordered button-bordered-white work-card__button" href="<?= esc_url( $service_link ) ?>">
												<?= esc_html( __( 'Learn More', THEME_TEXTDOMAIN ) ) ?>
												<span class="button__icon"></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="container">
					<div class="swiper-controls swiper-controls--circle">
						<button class="swiper-button-prev" aria-label="<?php _e( 'Prev Button' ); ?>">
							<?= hmt_get_svg_inline( get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-arrow-left.svg') ); ?>
						</button>

						<button class="swiper-button-next" aria-label="<?php _e( 'Next Button' ); ?>">
							<?= hmt_get_svg_inline( get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-arrow-left.svg') ); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

