<?php

function ld_settings_html_func()
{
    if (!is_admin()) {
        return;
    }

    ?>
    <div class="wrap">
        <h1 style="
        background: black;
        color: white;
        padding: 10px;">
            <?= esc_html(get_admin_page_title()); ?> </h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('like-settings');
            do_settings_sections('like-settings');
            submit_button('Save Changes');

            ?>
        </form>
    </div>

    <?php

}

function add_menu_page_func()
{
    add_menu_page(
        'Like Dislike System',
        'Like System',
        'manage_options',
        'like-settings',
        'ld_settings_html_func',
        'dashicons-thumbs-up',
    );

}

add_action('admin_menu', 'add_menu_page_func');

function setting_section_func_cb()
{
    echo '<p> Define Button Labels </p>';
}

function section_like_label_field_func_cb()
{
    $setting = get_option('ld_like_btn_label');
    ?>
    <input type="text" name="ld_like_btn_label" value="<?php echo isset($setting) ? $setting : '' ?>">
    <?php

}

function section_dislike_label_field_func_cb()
{
    $setting = get_option('ld_dislike_btn_label');
    ?>
    <input type="text" name="ld_dislike_btn_label" value="<?php echo isset($setting) ? $setting : '' ?>">
    <?php

}


function ld_register_my_setting()
{

    register_setting('like-settings', 'ld_like_btn_label');
    register_setting('like-settings', 'ld_dislike_btn_label');

    // register a new section in the "reading" page
    add_settings_section(
        'ld_label_settings_section',
        'Like Dislike Button Labels',
        'setting_section_func_cb',
        'like-settings'
    );


    add_settings_field(
        'ld_like_label_field',
        'Like Button Label',
        'section_like_label_field_func_cb',
        'like-settings',
        'ld_label_settings_section'
    );

    add_settings_field(
        'ld_dislike_label_field',
        'DisLike Button Label',
        'section_dislike_label_field_func_cb',
        'like-settings',
        'ld_label_settings_section'
    );


}

add_action('admin_init', 'ld_register_my_setting');






