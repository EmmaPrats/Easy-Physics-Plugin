<?php
defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );

function ep_tfg_add_canvas_springs( $atts )
{
    $randomNumber = rand( 1000, 9999 );
    
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999), );
    wp_enqueue_script( 'eptfg_springs_script', EPTFG_PLUGINS_URL . '/public/js/springs-animation.js', array('eptfg_library_script'), rand(1111,9999), true );
    
    //Passing options from the settings menu to the JS file.
    $text = get_option( 'eptfg-springs-text', 'TFG' );
    $font = (get_option( 'eptfg-springs-font' ) != null) ? get_option( 'eptfg-springs-font' ) : get_option( 'eptfg-springs-fonts', 'Arial' );
    $eptfgData = array('animationID' => 'animation' . $randomNumber,
                       'canvasID' => 'EasyPhysics' . $randomNumber,
                       'EDITMODE' => 'false',
                       'GRID' => 'false',
                       'textlocationX' => get_option( 'eptfg-springs-textlocationX', 0 ),
                       'textlocationY' => get_option( 'eptfg-springs-textlocationY', 0 ),
                       'SHOWTEXT' => 'false',
                       'POSITIONINGMODE' => 'false',
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
    wp_localize_script( 'eptfg_springs_script', 'eptfgSettingsSprings', $eptfgData );
    
    return '<canvas id="EasyPhysics' . $randomNumber . '" width="' . get_option( 'eptfg-springs-canvas-width' ) . '" height="' . get_option( 'eptfg-springs-canvas-height' ) . '"></canvas>';
}
add_shortcode( 'Easy-Physics-Springs', 'ep_tfg_add_canvas_springs' );

function ep_tfg_add_canvas_floating( $atts )
{
    $randomNumber = rand( 1000, 9999 );
    
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999) );
    wp_enqueue_script( 'eptfg_floating_script', EPTFG_PLUGINS_URL . '/public/js/floating-animation.js', array('eptfg_library_script'), rand(1111,9999), true );
    
    //Passing options from the settings menu to the JS file.
    $font = (get_option( 'eptfg-floating-font' ) != null) ? get_option( 'eptfg-floating-font' ) : get_option( 'eptfg-floating-fonts', 'Arial' );
    $eptfgData = array('animationID' => 'animation' . $randomNumber,
                       'canvasID' => 'EasyPhysics' . $randomNumber,
                       'EDITMODE' => 'false',
                       'GRID' => 'false',
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
    wp_localize_script( 'eptfg_floating_script', 'eptfgSettingsFloating', $eptfgData );
    
    return '<canvas id="EasyPhysics' . $randomNumber . '" width="' . get_option( 'eptfg-floating-canvas-width' ) . '" height="' . get_option( 'eptfg-floating-canvas-height' ) . '"></canvas>';
}
add_shortcode( 'Easy-Physics-Floating', 'ep_tfg_add_canvas_floating' );

function ep_tfg_add_canvas_flocking( $atts )
{
    $randomNumber = rand( 1000, 9999 );
    
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999) );
    wp_enqueue_script( 'eptfg_flocking_script', EPTFG_PLUGINS_URL . '/public/js/flocking-animation.js', array('eptfg_library_script',), rand(1111,9999), true );
    
    //Passing options from the settings menu to the JS file.
    $eptfgData = array('animationID' => 'animation' . $randomNumber,
                       'canvasID' => 'EasyPhysics' . $randomNumber,
                       'EDITMODE' => 'false',
                       'GRID' => 'false',
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
    wp_localize_script( 'eptfg_flocking_script', 'eptfgSettingsFlocking', $eptfgData );
    
    return '<canvas id="EasyPhysics' . $randomNumber . '" width="' . get_option( 'eptfg-flocking-canvas-width' ) . '" height="' . get_option( 'eptfg-flocking-canvas-height' ) . '"></canvas>';
}
add_shortcode( 'Easy-Physics-Flocking', 'ep_tfg_add_canvas_flocking' );

function ep_tfg_add_canvas_steering( $atts )
{
    $randomNumber = rand( 1000, 9999 );
    
    wp_enqueue_script( 'eptfg_library_script', EPTFG_PLUGINS_URL . '/includes/EasyPhysics.js', array(), rand(1111,9999) );
    wp_enqueue_script( 'eptfg_steering_script', EPTFG_PLUGINS_URL . '/public/js/steering-animation.js', array('eptfg_library_script',), rand(1111,9999), true );
    
    //Passing options from the settings menu to the JS file.
    $eptfgData = array('animationID' => 'animation' . $randomNumber,
                       'canvasID' => 'EasyPhysics' . $randomNumber,
                       'EDITMODE' => 'false',
                       'GRID' => 'false',
                       'SHOWPURSUEDISTANCE' => 'false',
                       'SHOWSEEKDISTANCE' => 'false',
                       'SHOWEVADEDISTANCE' => 'false',
                       
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
    
    wp_localize_script( 'eptfg_steering_script', 'eptfgSettingsSteering', $eptfgData );
    
    return '<canvas id="EasyPhysics' . $randomNumber . '" width="' . get_option( 'eptfg-steering-canvas-width' ) . '" height="' . get_option( 'eptfg-steering-canvas-height' ) . '"></canvas>';
}
add_shortcode( 'Easy-Physics-Steering', 'ep_tfg_add_canvas_steering' );

