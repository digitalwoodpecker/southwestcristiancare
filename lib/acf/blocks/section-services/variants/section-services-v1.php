<?php
/**
 * @var $args
 */

$block_id = $args['block_id'];
$services = $args['services'];


$section_title = get_field( 'services_section_title' );
?>

<?php if ( !empty( $services ) ) : ?>
	<div class="section__body">
		<div class="section-services__content">
			<div class="tab-content">
				<?php foreach ( $services as $key => $service ) : ?>
					<?php
						$service_title = $service->post_title;
						$excerpt_custom = hmt_get_first_paragraph( get_the_content( null, null, $service->ID) );
						$short_description = get_field( 'post_excerpt', $service->ID );
						if( !$short_description ) {
							$short_description = get_extended($excerpt_custom)['main'];
						}
					?>
					<div
						class="tab-pane fade js-initialize <?= $key == 0 ? 'show active js-initialize-active' : '' ?>"
						id="service-<?= esc_attr( $block_id . '-' . $key ) ?>"
						role="tabpanel"
						aria-labelledby="service-tab-<?= esc_attr( $block_id . '-' . $key ) ?>"
					>
						<div class="service">
							<div class="service__bg" aria-hidden="true">
								<?php
								get_template_part( 'template-parts/sections/service-featured-media', '', [
									'service_id' => $service->ID										
								] );
								?>
							</div>

							<div class="service__play">
								<?php
								get_template_part( 'template-parts/sections/service-featured-popup', '', [
									'service_id' => $service->ID										
								] );
								?>
							</div>

							<div class="service__content">
								<?php if ( $section_title ) : ?>
									<div class="section-title section-title--style6 service__title">
										<h2>
											<?= esc_html( $section_title ) ?>
										</h2>
									</div>
								<?php endif; ?>

								<div class="service__main">
									<?php if ( $service_title ) : ?>
										<div class="section-title section-title--style3 service__title">
											<h3>
												<?= esc_html( $service_title ) ?>
											</h3>
										</div>
									<?php endif; ?>

									<?php if ( $short_description ) : ?>
										<div class="scrollbar-outer">
											<div class="text-content service__description">
												<?= hmt_truncate( apply_filters( 'the_content', $short_description ), 400, array('html' => true, 'ending' => '...') ) ?>
											</div>
										</div>
									<?php elseif ( is_admin() ) : ?>
										<div>
											<div>
											</div>
										</div>
									<?php endif; ?>
								</div>

								<div class="service__button-wrapper">
									<a href="<?= esc_url( get_permalink( $service->ID ) ) ?>" class="button button-bordered service__button" aria-label="<?= esc_attr( __( 'link-to-service', THEME_TEXTDOMAIN ) ) ?>">
										<?= esc_html( __( 'Learn More', THEME_TEXTDOMAIN ) ) ?>
										<span class="button__icon"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="section-services__nav">
				<div class="scrollbar-outer">
					<ul class="section-services__tab nav" role="tablist">
						<?php foreach ( $services as $key => $service ) : ?>
							<?php
								$service_title = $service->post_title;
								$icon_id = get_field( 'service_page_icon', $service->ID );
							?>
							<li class="nav-item">
								<a
									class="nav-link <?= esc_attr( $key == 0 ? 'active' : '' ) ?>"
									id="service-tab-<?= esc_attr( $block_id . '-' . $key ) ?>"
									href="#"
									data-bs-target="#service-<?= esc_attr( $block_id . '-' . $key ) ?>"
									data-bs-toggle="pill"
									role="tab"
									aria-controls="service-<?= esc_attr( $block_id . '-' . $key ) ?>"
									aria-selected="<?= $key == 0 ? 'true' : 'false' ?>"
									aria-label="<?= esc_attr( $service_title ) ?>"
								>
									<!-- Add class active and aria-selected="true" only for first item -->
									<?php if ( $service_title ) : ?>
										<span class="nav-text">
											<span class="text-content">
												<?= esc_html( $service_title ) ?>
											</span>
										</span>
									<?php endif; ?>

									<?php if ( !empty( $icon_id ) && hmt_is_svg( $icon_id ) ) : ?>
										<span class="icon icon-wrap">
											<?= hmt_get_svg_inline( wp_get_attachment_image_url( $icon_id ) ); ?>
										</span>
									<?php endif ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
