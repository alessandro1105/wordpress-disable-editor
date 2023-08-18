# WordPress Disable Editor

This plugin allows you to disable the editor for some CPTs, templates or specific pages.

## Installation

### If you use a Roots Bedrock or a composer-based WordPress installation

```bash
composer require dartmoon/wordpress-disable-editor
```

## If you use a normal WordPress installation

1. Download and install a MU plugin loader that lets you use MU plugins that reside inside folders. For example you could use [Bedrock Autoloader](https://github.com/roots/bedrock-autoloader).

2. [Download the latest release](https://github.com/dartmoon-io/wordpress-disable-editor/releases) of this plugin and extract it inside the mu-plugins folder of your WordPress installation.

## Usage

### Disable Gutenberg

```php
add_filter('drtn/disable_gutenberg', function ($can_edit, $post_id, $post_type) {
    /**
     * Post types for which to enable Gutenberg
     */
    if ($post_type == 'post') {
        return true;
    }

    /**
     * Templates for which we need to disable Gutemberg
     */
    $excludedTemplates = [
        // 
    ];

    /**
     * Specific Post IDs for which we need to disable Gutenberg
     */
    $excludedIds = [
        //
    ];

    // Retrieve the template of the current post id
    $template = basename(get_page_template());
    return !(in_array($post_id, $excludedIds) || in_array($template, $excludedTemplates));
}, 10, 3);
```

### Disable classic editor

```php
add_filter('drtn/disable_editor', function ($can_edit, $post_id, $post_type) {
    /**
     * Post types for which to enable the classic editor
     */
    if ($post_type == 'post') {
        return true;
    }

    /**
     * Templates for which we need to disable the classic editor
     */
    $excludedTemplates = [
        // 
    ];

    /**
     * Specific Post IDs for which we need to disable the classic editor
     */
    $excludedIds = [
        //
    ];

    // Retrieve the template of the current post id
    $template = basename(get_page_template());
    return !(in_array($post_id, $excludedIds) || in_array($template, $excludedTemplates));
}, 10, 3);
```

## License

This project is licensed under the MIT License - see the LICENSE.md file for details