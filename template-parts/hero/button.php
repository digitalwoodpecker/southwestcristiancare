<?php
// Fetch primary and secondary button data
$action_button = get_field('hero_section_action_button');
$action_button_secondary = get_field('hero_section_action_button_secondary');

// Initialize primary button variables
$action_button_type = $action_button['type'] ?? '';
$action_button_text = $action_button['text'] ?? '';
$action_button_link = $action_button['link'] ?? '';
$action_button_modal = $action_button['modal'] ?? '';

// Initialize secondary button variables
$action_button_secondary_type = $action_button_secondary['type'] ?? '';
$action_button_secondary_text = $action_button_secondary['text'] ?? '';
$action_button_secondary_link = $action_button_secondary['link'] ?? '';
$action_button_secondary_modal = $action_button_secondary['modal'] ?? '';

// Debugging (optional): Uncomment these to inspect data structures
// var_dump($action_button);
// var_dump($action_button_secondary);
?>

<!-- Primary Button Code -->
<?php if ($action_button_type !== 'empty') : ?>
    <?php if ($action_button_type === 'link') : ?>
        <?php if (!empty($action_button_link) && !hmt_is_button_empty($action_button_link)) : ?>
            <?php
            $button_title = $action_button_link['title'] ?? '';
            $url = $action_button_link['url'] ?? '';
            $target = $action_button_link['target'] ?? '_self';
            ?>
            <a
                href="<?= esc_url($url) ?>"
                target="<?= esc_attr($target); ?>"
                class="button button-primary section-intro__button"
            >
                <?php
                if (preg_match('/tel:/', $url)) {
                    echo hmt_get_svg_inline(get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-phone.svg'));
                }
                ?>
                <?= esc_html($button_title ?: __('Learn More', THEME_TEXTDOMAIN)); ?>
            </a>
        <?php endif; ?>

    <?php elseif ($action_button_type === 'modal') : ?>
        <?php
        Harbinger_Marketing\Modal_Action::add_modal_action_to_render_list($action_button_modal);
        if (!hmt_is_button_empty(['title' => $action_button_text, 'url' => $action_button_modal])) :
            ?>
            <a
                href="#<?= esc_attr($action_button_modal) ?>"
                data-bs-toggle="modal"
                class="button button-primary section-intro__button"
            >
                <?= esc_html($action_button_text); ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<!-- Secondary Button Code -->
<?php if ($action_button_secondary_type !== 'empty') : ?>
    <?php if ($action_button_secondary_type === 'link') : ?>
        <?php if (!empty($action_button_secondary_link) && !hmt_is_button_empty($action_button_secondary_link)) : ?>
            <?php
            $button_title = $action_button_secondary_link['title'] ?? '';
            $url = $action_button_secondary_link['url'] ?? '';
            $target = $action_button_secondary_link['target'] ?? '_self';
            ?>
            <a
                href="<?= esc_url($url) ?>"
                target="<?= esc_attr($target); ?>"
                class="button button-secondary section-intro__button"
            >
                <?php
                if (preg_match('/tel:/', $url)) {
                    echo hmt_get_svg_inline(get_theme_file_uri(THEME_ASSETS_URL . '/images/icon-phone.svg'));
                }
                ?>
                <?= esc_html($button_title ?: __('Learn More', THEME_TEXTDOMAIN)); ?>
            </a>
        <?php endif; ?>

    <?php elseif ($action_button_secondary_type === 'modal') : ?>
        <?php
        Harbinger_Marketing\Modal_Action::add_modal_action_to_render_list($action_button_secondary_modal);
        if (!hmt_is_button_empty(['title' => $action_button_secondary_text, 'url' => $action_button_secondary_modal])) :
            ?>
            <a
                href="#<?= esc_attr($action_button_secondary_modal) ?>"
                data-bs-toggle="modal"
                class="button button-secondary section-intro__button"
            >
                <?= esc_html($action_button_secondary_text); ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>