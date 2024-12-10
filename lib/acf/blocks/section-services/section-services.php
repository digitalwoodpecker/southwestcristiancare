<?php
/**
 * Section Services Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_style = get_field( 'services_section_choose-variants' );

$id = $block['id'];
if ( !empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

$section_top_padding_type = get_field( 'section_top_padding_type' );
$section_bottom_padding_type = get_field( 'section_bottom_padding_type' );

if( $section_top_padding_type && !empty($section_top_padding_type) ) {
	$section_top_padding = 'section-top-padding--' . $section_top_padding_type;
} else {
	$section_top_padding = 'section-top-padding--default';
}
if ( $section_bottom_padding_type && !empty($section_bottom_padding_type) ) {
	$section_bottom_padding = 'section-bottom-padding--' . $section_bottom_padding_type;
} else {
	$section_bottom_padding = 'section-bottom-padding--default';
}

$class_name = 'section section-services';
$class_name .= ' ' . $section_top_padding . ' ' . $section_bottom_padding;

if ( !empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( !empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$class_name .= ' section-services--style-' . $block_style;

if ( $block_style == 'v2' && get_field( 'services_section_group' ) ){
	$filter_posts_type = get_field( 'services_section_group' )['services_filter_posts_short'];
} elseif ( get_field( 'services_section_group' ) ) {
	$filter_posts_type = get_field( 'services_section_group' )['services_filter_posts'];
} else {
	$filter_posts_type = '';
}

if ( $filter_posts_type === 'all' ) {
	$services = get_posts( [
		'post_type' => 'program',
		'posts_per_page' => - 1,
	] );

}else if ( $filter_posts_type === 'by_location' ) {
	$services = hmt_get_current_location_service_list();

} else {
	if ( $block_style == 'v2' && get_field( 'services_section_group' ) ){
		$services = get_field( 'services_section_group' )['services_section_services_short'];
	} elseif ( get_field( 'services_section_group' ) ) {
		$services = get_field( 'services_section_group' )['services_section_services'];
	} else {
		$services = '';
	}
}

$section_title = get_field( 'services_section_title' );
?>

<?php if ( isset( $block['data']['block_preview_images'] ) ) : ?>
	<?php hmt_get_template_part_with_params( 'lib/acf/blocks/block-preview-image', ['block' => $block] ); ?>
<?php elseif ( !empty( $services ) && !empty( $section_title ) ) : ?>
	<section key="<?= time() ?>" id="<?= esc_attr( $id ); ?>" class="<?= esc_attr( $class_name ); ?>">		
		<?php if ( $block_style == 'v1' ) : ?>
			<?php get_template_part( 'lib/acf/blocks/section-services/variants/section-services-v1', '', ['block_id' => $block['id'], 'services' => $services] ); ?>
		<?php elseif ( $block_style == 'v2' ) : ?>
			<?php get_template_part( 'lib/acf/blocks/section-services/variants/section-services-v2', '', ['block_id' => $block['id'], 'services' => $services] ); ?>
		<?php elseif ( $block_style == 'v3' ) : ?>
			<?php get_template_part( 'lib/acf/blocks/section-services/variants/section-services-v3', '', ['block_id' => $block['id'], 'services' => $services] ); ?>
		<?php elseif ( $block_style == 'v4' ) : ?>
			<?php get_template_part( 'lib/acf/blocks/section-services/variants/section-services-v4', '', ['block_id' => $block['id'], 'services' => $services] ); ?>
		<?php elseif ( $block_style == 'v5' ) : ?>
			<?php get_template_part( 'lib/acf/blocks/section-services/variants/section-services-v5', '', ['block_id' => $block['id'], 'services' => $services] ); ?>
		<?php endif; ?>
	</section>
<?php endif; ?>
