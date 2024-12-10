<?php

/**
 * @var $args
 */

$section_title = get_field('services_section_title');
$services = $args['services'];
$isAffectBG = get_field('use_services_background');
$affectBG = "";
$service_gallery_first_img_id = null;

if( !empty($isAffectBG) && $isAffectBG == 'enabled' ){
	$affectBG = "bg-affect";
	$service_media = hmt_get_service_media( [
		'service_id' => $services[0]->ID,
	] );

	if ($service_media['media_type']) {
		if ($service_media['media_type'] == 'image') {
			$service_gallery_first_img_id = $service_media['image'];
		} elseif ($service_media['media_type'] == 'video') {
			$service_gallery_first_img_id = $service_media['video_poster'];
		}
	}
}

?>

<?php if ( !empty( $services ) ) : ?>
	<?php
		if ( !empty( $service_gallery_first_img_id ) )
		get_template_part('template-parts/resources/section-background', '', [
			'class_name' => 'section-services__bg',
			'field_prefix' => 'services_section_background',
			'field_id' => '',
			'background_image_id' => $service_gallery_first_img_id
		]);
	?>

	<div class="section__body">
		<div class="section-services__content">
			<div class="container">
				<div class="section-services__wrapper">
					<div class="section-services__tabs">
						<div class="swiper swiper-container js-services-slider <?= $affectBG ?>">
							<div class="swiper-wrapper">
								<?php
									$index = 1;
								?>
								<?php foreach ( $services as $key => $service ) : ?>
									<?php
										$service_title = $service->post_title;
										$excerpt_custom = hmt_get_first_paragraph(get_the_content(null, null, $service->ID));
										$short_description = get_field('post_excerpt', $service->ID);
										if (!$short_description) {
											$short_description = get_extended($excerpt_custom)['main'];
										}
										$service_link = get_permalink($service->ID);

										$service_media = hmt_get_service_media( [
											'service_id' => $service->ID,
										] );
										$service_gallery_first_img_id = null;
										$service_gallery_first_video_poster = "";

										if ($service_media['media_type']) {
											if ($service_media['media_type'] == 'image') {
												$service_gallery_first_img_id = $service_media['image'];
											} elseif ($service_media['media_type'] == 'video') {
												$service_gallery_first_img_id = $service_media['video'];
												$service_gallery_first_video_poster = $service_media['video_poster'];
											}

											$service_image_thumb_url = wp_get_attachment_image_url($service_gallery_first_img_id, 'thumbs-desktop');
										}
									?>
									<div class="swiper-slide">
										<div
											class="section-services__tab-item"
											data-bg-image="<?= wp_get_attachment_url( $service_gallery_first_img_id ) ?>"
											data-poster="<?= wp_get_attachment_image_url($service_gallery_first_video_poster, 'section-background-desktop') ?>"
										>
											<?php if ($section_title) : ?>
												<h3 class="section-services__section-title section-title section-title--style6">
													<?= esc_html($section_title) ?>
												</h3>
											<?php endif; ?>

											<?php if ($service_title) : ?>
												<h2 class="section-services__service-title section-title section-title--style3">
													<?= esc_html($service_title) ?>
												</h2>
											<?php endif; ?>

											<?php if ($short_description) : ?>
												<div class="section-services__tab-info">
													<div class="scrollbar-outer">
														<div class="section-services__tab-text-content text-content">
															<?= hmt_truncate(apply_filters('the_content', $short_description), 400, array('html' => true, 'ending' => '...')) ?>
														</div>
													</div>
												</div>
											<?php endif; ?>

											<!-- <div class="section-services__tab-footer">
												<a class="button button-bordered button-bordered-white" role="link" href="<?= esc_url($service_link) ?>">
													<?= esc_html__('Learn More', THEME_TEXTDOMAIN) ?>
													<span class="button__icon"></span>
												</a>
											</div> -->
											<div class="section-services__tab-footer">
												<a class="button button-bordered button-bordered-white" role="link" href="https://harbinger.woodpecker.digital/swcc/support-us">
													<?= esc_html__('Learn More', THEME_TEXTDOMAIN) ?>
													<span class="button__icon"></span>
												</a>
											</div>

											<div class="section-services__tab-index-wrapper">
												<span class="section-services__tab-index"><?= esc_html( str_pad($index, 2, "0", STR_PAD_LEFT) ); ?></span>/<?= esc_html( str_pad(count($services), 2, "0", STR_PAD_LEFT) ); ?>
											</div>
										</div>
									</div>

									<?php
										$index += 1;
									?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>

					<div class="section-services__thumbs-slider">
						<div class="section-services__thumbs-wrapper">
							<div class="swiper swiper-container js-thumbs-slider">
								<div class="swiper-wrapper">
									<?php foreach ($services as $key => $service) : ?>
										<?php
											$service_title = $service->post_title;
											$service_link = $service->guid;
											$service_media = hmt_get_service_media( [
												'service_id' => $service->ID,
											] );
											$service_gallery_first_img_id = null;

											if ($service_media['media_type']) {
												if ($service_media['media_type'] == 'image') {
													$service_gallery_first_img_id = $service_media['image'];
												} elseif ($service_media['media_type'] == 'video') {
													$service_gallery_first_img_id = $service_media['video_poster'];
												}

												$service_image_thumb_url = wp_get_attachment_image_url($service_gallery_first_img_id, 'thumbs-desktop');
											}
										?>
										<div class="swiper-slide">
											<div class="section-services__thumb-item">
												<div class="section-services__thumb-item-background" style="background-image: url('<?= esc_url($service_image_thumb_url) ?>')"></div>

												<?php if ($service_title) : ?>
													<div class="section-services__thumb-item-content">
														<?= esc_html($service_title) ?>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

						<div class="section-services__thumbs-nav">
							<button class="section-services__swiper-button swiper-button-prev">
								<?= hmt_get_svg_inline(get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-arrow-left-bold.svg')); ?>
							</button>

							<div class="section-services__thumbs-bullets"></div>

							<button class="section-services__swiper-button swiper-button-next">
								<?= hmt_get_svg_inline(get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-arrow-left-bold.svg')); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>