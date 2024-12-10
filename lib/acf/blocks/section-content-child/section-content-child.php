<?php
/**
 * Section Content Child Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = $block['id'];
$class_name = 'section-content-child';

$section_title = get_field( 'content_child_section_title' );
?>

<?php if ( isset( $block['data']['block_preview_images'] ) ) : ?>
	<?php hmt_get_template_part_with_params( 'lib/acf/blocks/block-preview-image', ['block' => $block] ); ?>
<?php endif; ?>

<?php if (!empty( $section_title ) && $section_title) : ?>
	<section key="<?= time() ?>" id="<?= esc_attr( $id ); ?>" class="<?= esc_attr( $class_name ); ?>">
		<div class="container">
			<div class="section-title section-title--style1 section-services__title">
				<h2><?= $section_title ?></h2>
			</div>
		</div>
	</section>
<?php endif; ?>
