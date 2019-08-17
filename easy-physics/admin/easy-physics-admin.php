<?php
defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );

//ADDING A MENU PAGE FOR EACH SCENE

add_action( 'admin_menu', 'ep_tfg_add_menu_pages' );

function ep_tfg_add_menu_pages()
{
    add_menu_page(
        'Springs - Easy Physics',
        'EP Springs',
        'manage_options',
        EPTFG_PLUGIN_NAME . '_Springs',
        'ep_tfg_render_springs_menu',
        'dashicons-image-filter'//TODO
    );
    add_menu_page(
        'Floating - Easy Physics',
        'EP Floating',
        'manage_options',
        EPTFG_PLUGIN_NAME . '_Floating',
        'ep_tfg_render_floating_menu',
        'dashicons-image-filter'//TODO
    );
    add_menu_page(
        'Flocking - Easy Physics',
        'EP Flocking',
        'manage_options',
        EPTFG_PLUGIN_NAME . '_Flocking',
        'ep_tfg_render_flocking_menu',
        'dashicons-image-filter'//TODO
    );
    add_menu_page(
        'Steering - Easy Physics',
        'EP Steering',
        'manage_options',
        EPTFG_PLUGIN_NAME . '_Steering',
        'ep_tfg_render_steering_menu',
        'dashicons-image-filter'//TODO
    );
}

function ep_tfg_render_springs_menu()
{
    if( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );}
    
    include_once( 'partials/easy-physics-admin-display-springs.php' );
    wp_enqueue_style( 'eptfg_adminstyle', EPTFG_PLUGINS_URL . '/admin/css/styles-admin.css', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_springs_controller_script', EPTFG_PLUGINS_URL . '/includes/SpringsController.js', array('eptfg_library_script'), rand(1111,9999), 'all' );
    
    //Passing options from the settings menu to the JS file.
    $text = get_option( 'eptfg-springs-text', 'TFG' );
    $font = (get_option( 'eptfg-springs-font' ) != null) ? get_option( 'eptfg-springs-font' ) : get_option( 'eptfg-springs-fonts', 'Arial' );
    $eptfgData = array('EDITMODE' => 'true',
                       'GRID' => (get_option( 'eptfg-springs-grid' ) != '') ? 'true' : 'false',
                       'textlocationX' => get_option( 'eptfg-springs-textlocationX', 0 ),
                       'textlocationY' => get_option( 'eptfg-springs-textlocationY', 0 ),
                       'SHOWTEXT' => (get_option( 'eptfg-springs-showtext' ) != '') ? 'true' : 'false',
                       'POSITIONINGMODE' => (get_option( 'eptfg-springs-positioningmode' ) != '') ? 'true' : 'false',
                       'scenewidth' => get_option( 'eptfg-springs-scene-width', 11 ),
                       'size' => get_option( 'eptfg-springs-fontsize', 1 ),
                       'mass' => get_option( 'eptfg-springs-mass', 1 ),
                       'stiffness' => get_option( 'eptfg-springs-stiffness', 150 ),
                       'damping' => get_option( 'eptfg-springs-damping', 3 ),
                       'text' => $text,
                       'font' => $font,
                       'color' => get_option( 'eptfg-springs-color', '#000000' )
    );
    for ($i=0; $i<strlen($text); $i++)
    {
        $eptfgData['letterlocation' . $i . 'x'] = get_option( 'eptfg-springs-letterlocation' . $i . 'x', $i*0.5 );
        $eptfgData['letterlocation' . $i . 'y'] = get_option( 'eptfg-springs-letterlocation' . $i . 'y', 0 );
    }
    wp_localize_script( 'eptfg_springs_controller_script', 'eptfgSettingsSprings', $eptfgData );
}
    
function ep_tfg_render_floating_menu()
{
    if( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );}
    
    include_once( 'partials/easy-physics-admin-display-floating.php' );
    wp_enqueue_style( 'eptfg_adminstyle', EPTFG_PLUGINS_URL . '/admin/css/styles-admin.css', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_floating_controller_script', EPTFG_PLUGINS_URL . '/includes/FloatingController.js', array('eptfg_library_script'), rand(1111,9999), 'all' );
    
    //Passing options from the settings menu to the JS file.
    $font = (get_option( 'eptfg-floating-font' ) != null) ? get_option( 'eptfg-floating-font' ) : get_option( 'eptfg-floating-fonts', 'Arial' );
    $eptfgData = array('EDITMODE' => 'true',
                       'GRID' => (get_option( 'eptfg-floating-grid' ) != '') ? 'true' : 'false',
                       'scenewidth' => get_option( 'eptfg-floating-scene-width', 5 ),
                       'waterline' => get_option( 'eptfg-floating-waterlevel', 5 ),
                       'gravity' => get_option( 'eptfg-floating-gravity', 9.8 ),
                       'size' => get_option( 'eptfg-floating-size', 1 ),
                       'mass' => get_option( 'eptfg-floating-mass', 500 ),
                       'liquiddensity' => get_option( 'eptfg-floating-liquiddensity', 1000 ),
                       'text' => get_option( 'eptfg-floating-text', 'TFG' ),
                       'font' => $font,
                       'color' => get_option( 'eptfg-floating-letterscolor', '#000000' ),
                       'liquidcolor' => get_option( 'eptfg-floating-liquidcolor', '#0000FF' ),
                       'liquidopacity' => get_option( 'eptfg-floating-liquidopacity', 0.7 )
    );
    wp_localize_script( 'eptfg_floating_controller_script', 'eptfgSettingsFloating', $eptfgData );
}

function ep_tfg_render_flocking_menu()
{
    if( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );}
    
    include_once( 'partials/easy-physics-admin-display-flocking.php' );
    wp_enqueue_style( 'eptfg_adminstyle', EPTFG_PLUGINS_URL . '/admin/css/styles-admin.css', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_flocking_controller_script', EPTFG_PLUGINS_URL . '/includes/FlockingController.js', array('eptfg_library_script'), rand(1111,9999), 'all' );
    
    //Passing options from the settings menu to the JS file.
    $eptfgData = array('EDITMODE' => 'true',
                       'GRID' => (get_option( 'eptfg-flocking-grid' ) != '') ? 'true' : 'false',
                       'scenewidth' => get_option( 'eptfg-flocking-scene-width', 400 ),
                       'size' => get_option( 'eptfg-flocking-size', 5 ),
                       'quantity' => get_option( 'eptfg-flocking-quantity', 200 ),
                       'separationweight' => get_option( 'eptfg-flocking-separation', 1.5 ),
                       'alignmentweight' => get_option( 'eptfg-flocking-alignment', 1.0 ),
                       'cohesionweight' => get_option( 'eptfg-flocking-cohesion', 1.0 ),
                       'visualrepresentation' => get_option( 'eptfg-flocking-visualrepresentation', 'shape' ),
                       'shape' => get_option( 'eptfg-flocking-shape', 'triangle' ),
                       'image' => get_option( 'eptfg-flocking-image' ),
                       'ORIENTED' => (get_option( 'eptfg-flocking-oriented' ) != '') ? 'true' : 'false',
                       'color' => get_option( 'eptfg-flocking-color', '#000000' )
    );
    wp_localize_script( 'eptfg_flocking_controller_script', 'eptfgSettingsFlocking', $eptfgData );
}

function ep_tfg_render_steering_menu()
{
    if( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );}
    
    include_once( 'partials/easy-physics-admin-display-steering.php' );
    wp_enqueue_style( 'eptfg_adminstyle', EPTFG_PLUGINS_URL . '/admin/css/styles-admin.css', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999), 'all' );
    wp_enqueue_script( 'eptfg_steering_controller_script', EPTFG_PLUGINS_URL . '/includes/SteeringController.js', array('eptfg_library_script'), rand(1111,9999), 'all' );
    
    //Passing options from the settings menu to the JS file.
    $eptfgData = array('EDITMODE' => 'true',
                       'GRID' => (get_option( 'eptfg-steering-grid' ) != '') ? 'true' : 'false',
                       'SHOWPURSUEDISTANCE' => (get_option( 'eptfg-steering-showhuntdistance' ) != '') ? 'true' : 'false',
                       'SHOWSEEKDISTANCE' => (get_option( 'eptfg-steering-showgatherdistance' ) != '') ? 'true' : 'false',
                       'SHOWEVADEDISTANCE' => (get_option( 'eptfg-steering-showevadedistance' ) != '') ? 'true' : 'false',
                       
                       'scenewidth' => get_option( 'eptfg-steering-scene-width', 400 ),
                       'EXISTS_hunter' => (get_option( 'eptfg-steering-hunterexists' ) != '') ? 'true' : 'false',
                       'EXISTS_gatherer' => (get_option( 'eptfg-steering-gathererexists' ) != '') ? 'true' : 'false',
                       'EXISTS_target' => (get_option( 'eptfg-steering-targetexists' ) != '') ? 'true' : 'false',
                       
                       'size' => get_option( 'eptfg-steering-size', 5 ),
                       'pursuedistance' => get_option( 'eptfg-steering-huntdistance', 50 ),
                       'seekdistance' => get_option( 'eptfg-steering-gatherdistance', 50 ),
                       'evadedistance' => get_option( 'eptfg-steering-evadedistance', 50 ),
                       'seekweight' => get_option( 'eptfg-steering-seekweight', 1.0 ),
                       'evadeweight' => get_option( 'eptfg-steering-evadeweight', 1.0 ),
                       'pursueweight' => get_option( 'eptfg-steering-pursueweight', 1.0 ),
                       
                       'visualrepresentation_hunter' => get_option( 'eptfg-steering-visualrepresentation-hunter', 'shape' ),
                       'visualrepresentation_gatherer' => get_option( 'eptfg-steering-visualrepresentation-gatherer', 'shape' ),
                       'visualrepresentation_target' => get_option( 'eptfg-steering-visualrepresentation-target', 'shape' ),
                       
                       'shape_hunter' => get_option( 'eptfg-steering-shape-hunter', 'triangle' ),
                       'shape_gatherer' => get_option( 'eptfg-steering-shape-gatherer', 'circle' ),
                       'shape_target' => get_option( 'eptfg-steering-shape-target', 'square' ),
                       
                       'image_hunter' => get_option( 'eptfg-steering-image-hunter' ),
                       'image_gatherer' => get_option( 'eptfg-steering-image-gatherer' ),
                       'image_target' => get_option( 'eptfg-steering-image-target' ),
                       
                       'ORIENTED_hunter' => (get_option( 'eptfg-steering-oriented-hunter' ) != '') ? 'true' : 'false',
                       'ORIENTED_gatherer' => (get_option( 'eptfg-steering-oriented-gatherer' ) != '') ? 'true' : 'false',
                       
                       'color_hunter' => get_option( 'eptfg-steering-color-hunter', '#000000' ),
                       'color_gatherer' => get_option( 'eptfg-steering-color-gatherer', '#000000' ),
                       'color_target' => get_option( 'eptfg-steering-color-target', '#000000' )
    );
    wp_localize_script( 'eptfg_steering_controller_script', 'eptfgSettingsSteering', $eptfgData );
}

//REGISTERING SETTINGS

add_action( 'admin_init', 'ep_tfg_register_settings' );

function ep_tfg_register_settings()
{
    register_setting( 'ep_tfg_settings', 'eptfg-add-animation' );
    register_setting( 'ep_tfg_settings', 'eptfg-scene' );
    register_setting( 'ep_tfg_settings', 'eptfg-canvaslocation' );
    
    ep_tfg_register_settings_springs();
    ep_tfg_register_settings_floating();
    ep_tfg_register_settings_flocking();
    ep_tfg_register_settings_steering();
}

function ep_tfg_register_settings_springs()
{
    //CANVAS
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-canvas-width' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-canvas-height' );
    
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-grid' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-ratio-16-9' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-ratio-4-3' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-ratio-1-1' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-ratio-3-4' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-ratio-9-16' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-lock-canvas-width' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-canvas-width' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-lock-canvas-height' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-canvas-height' );
    
    //SCENE
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-scene-width' );
    
    //SIMULATION
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-mass' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-stiffness' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-damping' );
    
    //AESTHETICS
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-text' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-showtext' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-textlocationX' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-textlocationY' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-positioningmode' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-fonts' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-font' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-fontsize' );
    register_setting( 'eptfg_settings_springs', 'eptfg-springs-color' );
    
    //LETTER POSITIONS
    for ($i=0; $i<20; $i++)
    {
        register_setting( 'eptfg_settings_springs', 'eptfg-springs-letterlocation' . $i . 'x');
        register_setting( 'eptfg_settings_springs', 'eptfg-springs-letterlocation' . $i . 'y');
    }
}

function ep_tfg_register_settings_floating()
{
    //CANVAS
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-canvas-width' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-canvas-height' );
    
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-grid' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-ratio-16-9' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-ratio-4-3' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-ratio-1-1' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-ratio-3-4' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-ratio-9-16' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-lock-canvas-width' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-canvas-width' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-lock-canvas-height' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-canvas-height' );
    
    //SCENE
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-scene-width' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-waterlevel' );
    
    //SIMULATION
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-gravity' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-mass' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-liquiddensity' );
    
    //AESTHETICS
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-visualrepresentation' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-text' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-fonts' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-font' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-letterscolor' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-image' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-quantity' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-size' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-liquidcolor' );
    register_setting( 'eptfg_settings_floating', 'eptfg-floating-liquidopacity' );
}

function ep_tfg_register_settings_flocking()
{
    //CANVAS
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-canvas-width' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-canvas-height' );
    
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-grid' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-ratio-16-9' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-ratio-4-3' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-ratio-1-1' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-ratio-3-4' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-ratio-9-16' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-lock-canvas-width' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-canvas-width' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-lock-canvas-height' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-canvas-height' );
    
    //SCENE
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-scene-width' );
    
    //SIMULATION
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-quantity' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-size' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-separation' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-alignment' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-cohesion' );
    
    //AESTHETICS
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-oriented' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-visualrepresentation' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-shape' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-image' );
    register_setting( 'eptfg_settings_flocking', 'eptfg-flocking-color' );
}

function ep_tfg_register_settings_steering()
{
    //CANVAS
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-canvas-width' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-canvas-height' );
    
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-grid' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-ratio-16-9' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-ratio-4-3' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-ratio-1-1' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-ratio-3-4' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-ratio-9-16' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-lock-canvas-width' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-canvas-width' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-lock-canvas-height' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-canvas-height' );
    
    //SCENE
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-scene-width' );
    
    //SIMULATION
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-size' );
    
    //HUNTER
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-hunterexists' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-huntdistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-showhuntdistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-pursueweight' );
    
    //GATHERER
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-gathererexists' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-gatherdistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-showgatherdistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-seekweight' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-evadedistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-showevadedistance' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-evadeweight' );
    
    //TARGET
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-targetexists' );
    
    //HUNTER AESTHETICS
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-oriented-hunter' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-visualrepresentation-hunter' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-shape-hunter' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-image-hunter' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-color-hunter' );
    
    //GATHERER AESTHETICS
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-oriented-gatherer' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-visualrepresentation-gatherer' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-shape-gatherer' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-image-gatherer' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-color-gatherer' );
    
    //TARGET AESTHETICS
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-visualrepresentation-target' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-shape-target' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-image-target' );
    register_setting( 'eptfg_settings_steering', 'eptfg-steering-color-target' );
}
