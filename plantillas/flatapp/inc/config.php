<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");


/**
 * config.php
 *
 * Author: pixelcave
 *
 * Configuration php file. It containts variables used in the template and the main menu auto creation function
 *
 */


            //print_r($_SESSION["SESSION_FUNCIONES_USUARIO"]);

// Template variables
$template = array(
    'name'          => $params->valor('NOMBREEMPRESA') ,
    'version'       => '4.3.1',
    'author'        => 'puro ingenio samario',
    'title'         => $params->valor('NOMBREEMPRESA') .'-'.$params->valor('ESLOGANEMPRESA') ,
    'description'   => $params->valor('DESCRIPCIONEMPRESA') ,
    // 'fixed-top'         for a top fixed header
    // 'fixed-bottom'      for a bottom fixed header
    // ''                  empty for a static header
    'header'        => 'fixed-top',
    // 'sticky'            for a sticky sidebar
    'sidebar'       => '',
    // 'hide-side-content' for hiding sidebar by default
    'side_content'  => '',
    // 'full-width'        for full width page
    // ''                  empty to remove full width from the page in large resolutions
    'page'          => 'full-width',
    // Available themes: 'fire', 'wood', 'ocean', 'leaf', 'tulip', 'amethyst',
    //                   'dawn', 'city', 'oil', 'deepsea', 'stone', 'grass',
    //                   'army', 'autumn', 'night', 'diamond', 'cherry', 'sun'
    //                   'asphalt'
    'theme'         => 'deepsea',
    'active_page'   => './'
);

// Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 level deep)
$primary_nav = array(
    array(
        'name'  => 'Panel de Control',
        'url'   => './',
        'icon'  => 'glyphicon-display'
    ),
    array(
        'name'  => 'User Interface',
        'icon'  => 'glyphicon-vector_path_curve',
        'sub'   => array(
            array(
                'name'  => 'Blocks',
                'url'   => 'page_ui_blocks.php'
            ),
            array(
                'name'  => 'Grid',
                'url'   => 'page_ui_grid.php'
            ),
            array(
                'name'  => 'Typography',
                'url'   => 'page_ui_typography.php'
            ),
            array(
                'name' => 'Navigation',
                'url' => 'page_ui_navigation.php'
            ),
            array(
                'name' => 'Tabs &amp; Accordions',
                'url' => 'page_ui_tabs_accordions.php'
            ),
            array(
                'name' => 'Buttons &amp; Dropdowns',
                'url' => 'page_ui_buttons_dropdowns.php'
            ),
            array(
                'name' => 'Progress Bars',
                'url' => 'page_ui_progress_bars.php'
            ),
            array(
                'name'  => 'Carousel',
                'url'   => 'page_ui_carousel.php'
            ),
            array(
                'name'  => 'Extras',
                'url'   => 'page_ui_extras.php'
            )
        )
    ),
    array(
        'name'  => 'Tables',
        'icon'  => 'glyphicon-table',
        'sub'   => array(
            array(
                'name'  => 'Static',
                'url'   => 'page_tables_static.php'
            ),
            array(
                'name' => 'Dynamic',
                'url' => 'page_tables_dynamic.php'
            ),
            array(
                'name' => 'Editable',
                'url' => 'page_tables_editable.php'
            )
        )
    ),
    array(
        'name'  => 'Forms',
        'icon'  => 'glyphicon-more_windows',
        'sub'   => array(
            array(
                'name' => 'General',
                'url' => 'page_forms_general.php'
            ),
            array(
                'name' => 'Layouts &amp; Styles',
                'url' => 'page_forms_layouts_styles.php'
            ),
            array(
                'name' => 'Pickers &amp; Grid',
                'url' => 'page_forms_pickers_grid.php'
            ),
            array(
                'name' => 'Textareas &amp; WYSIWYG',
                'url' => 'page_forms_textareas_wysiwyg.php'
            ),
            array(
                'name' => 'File Upload &amp; Dropzone',
                'url' => 'page_forms_upload_dropzone.php'
            ),
            array(
                'name' => 'Validation',
                'url' => 'page_forms_validation.php'
            ),
            array(
                'name' => 'Wizard',
                'url' => 'page_forms_wizard.php'
            )
        )
    ),
    array(
        'name'  => 'Components',
        'icon'  => 'glyphicon-fire',
        'sub'   => array(
            array(
                'name' => 'Inbox',
                'url' => 'page_comp_inbox.php'
            ),
            array(
                'name' => 'Chat',
                'url' => 'page_comp_chat.php'
            ),
            array(
                'name' => 'Timeline',
                'url' => 'page_comp_timeline.php'
            ),
            array(
                'name' => 'Tiles',
                'url' => 'page_comp_tiles.php'
            ),
            array(
                'name'  => 'Gallery',
                'url'   => 'page_comp_gallery.php'
            ),
            array(
                'name'  => 'Charts',
                'url'   => 'page_comp_charts.php'
            ),
            array(
                'name'  => 'Calendar',
                'url'   => 'page_comp_calendar.php'
            ),
            array(
                'name'  => 'Maps',
                'sub'   => array(
                    array(
                        'name' => 'Vector Maps',
                        'url' => 'page_comp_vector_maps.php'
                    ),
                    array(
                        'name' => 'Google Maps',
                        'url' => 'page_comp_google_maps.php'
                    )
                )
            ),
            array(
                'name' => 'Syntax Highlighting',
                'url' => 'page_comp_syntax_highlighting.php'
            )
        )
    ),
    array(
        'name'  => 'Icon Packs',
        'icon'  => 'glyphicon-pizza',
        'sub'   => array(
            array(
                'name' => 'Glyphicons Pro',
                'url' => 'page_icons_glyphicons_pro.php'
            ),
            array(
                'name' => 'Glyphicons Halflings Pro',
                'url' => 'page_icons_glyphicons_halflings_pro.php'
            ),
            array(
                'name' => 'FontAwesome',
                'url' => 'page_icons_fontawesome.php'
            ),
            array(
                'name' => 'Gemicon',
                'url' => 'page_icons_gemicon.php'
            )
        )
    ),
    array(
        'name'   => 'Ready UI',
        'icon'  => 'glyphicon-certificate',
        'sub'   => array(
            array(
                'name' => 'Search Results',
                'url' => 'page_ready_search_results.php'
            ),
            array(
                'name' => 'User Profile',
                'url' => 'page_ready_user_profile.php'
            ),
            array(
                'name' => 'Pricing Tables',
                'url' => 'page_ready_pricing_tables.php'
            ),
            array(
                'name' => 'e-Shop',
                'sub' => array(
                    array(
                        'name' => 'Product',
                        'url' => 'page_ready_product.php'
                    ),
                    array(
                        'name' => 'Products List',
                        'url' => 'page_ready_products_list.php'
                    ),
                    array(
                        'name' => 'Shopping Cart',
                        'url' => 'page_ready_shopping_cart.php'
                    )
                )
            ),
            array(
                'name' => 'Invoice',
                'url' => 'page_ready_invoice.php'
            ),
            array(
                'name' => 'Article',
                'url' => 'page_ready_article.php'
            ),
            array(
                'name' => 'FAQ',
                'url' => 'page_ready_faq.php'
            ),
            array(
                'name' => 'Errors',
                'sub' => array(
                    array(
                        'name' => 'In-Page',
                        'url' => 'page_ready_errors.php'
                    ),
                    array(
                        'name' => 'Standalone',
                        'url' => 'page_ready_standalone_error.php'
                    )
                )
            ),
            array(
                'name' => 'Blank',
                'url' => 'page_ready_blank.php'
            )
        )
    ),
    array(
        'name'  => 'Landing Page',
        'url'   => 'page_landing.php',
        'icon'  => 'glyphicon-leaf'
    ),
    array(
        'name'  => 'Salir',
        'url'   => 'javascript:cerrar_sesion();',
        'icon'  => 'glyphicon-power'
    )
);