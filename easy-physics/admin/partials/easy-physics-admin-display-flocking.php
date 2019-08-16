<div class="wrap">
<h1>Flocking - Easy Physics</h1>
<h2>Preview:</h2>
<div class="eptfg-canvas-container"><!--TODO crec que és igual la classe-->
    <canvas width="<?php if(get_option('eptfg-flocking-canvas-width', 480) == "") echo 480; else echo get_option('eptfg-flocking-canvas-width', 480);?>" height="<?php if(get_option('eptfg-flocking-canvas-height', 360) == "") echo 360; else echo get_option('eptfg-flocking-canvas-height', 360);?>" id="eptfg-canvas"></canvas>
</div>
<form method="post" action="options.php">
<?php
settings_fields( 'eptfg_settings_flocking' );
do_settings_sections( EPTFG_PLUGIN_NAME . '_Flocking' );

$eptfg_settings_flocking = array(
    'grid' => get_option( 'eptfg-flocking-grid', true),
    'ratio-16-9' => get_option( 'eptfg-flocking-ratio-16-9', false),
    'ratio-4-3' => get_option( 'eptfg-flocking-ratio-4-3', false),
    'ratio-1-1' => get_option( 'eptfg-flocking-ratio-1-1', false),
    'ratio-3-4' => get_option( 'eptfg-flocking-ratio-3-4', false),
    'ratio-9-16' => get_option( 'eptfg-flocking-ratio-9-16', false),
    'canvaswidthlocked' => get_option( 'eptfg-flocking-lock-canvas-width', false),
    'canvasheightlocked' => get_option( 'eptfg-flocking-lock-canvas-height', false),
    'canvaswidth' => get_option( 'eptfg-flocking-canvas-width', 480 ),
    'canvasheight' => get_option( 'eptfg-flocking-canvas-height', 360 ),
    
    'scenewidth' => get_option( 'eptfg-flocking-scene-width', 400),
    
    'quantity' => get_option( 'eptfg-flocking-quantity', 200),
    'size' => get_option( 'eptfg-flocking-size', 5),
    'separation' => get_option( 'eptfg-flocking-separation', 1.5),
    'alignment' => get_option( 'eptfg-flocking-alignment', 1.0),
    'cohesion' => get_option( 'eptfg-flocking-cohesion', 1.0),
    
    'oriented' => get_option( 'eptfg-flocking-oriented', true),
    'visualrepresentation' => get_option( 'eptfg-flocking-visualrepresentation', 'shape'),
    'shape' => get_option ( 'eptfg-flocking-shape', 'triangle' ),
    'image' => get_option ( 'eptfg-flocking-image', null ), //TODO
    'color' => get_option( 'eptfg-flocking-color', '#000000' )
);
?>
<div class="toolbar">
    <input type="checkbox" id="grid" name="eptfg-flocking-grid" <?php if($eptfg_settings_flocking['grid']) echo 'checked'; ?>/><label for="grid">Grid</label>
    <input type="checkbox" id="ratio-16-9" name="eptfg-flocking-ratio-16-9" <?php if($eptfg_settings_flocking['ratio-16-9']) echo 'checked'; ?>/><label for="ratio-16-9"><?php if($eptfg_settings_flocking['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>16:9</label>
    <input type="checkbox" id="ratio-4-3" name="eptfg-flocking-ratio-4-3" <?php if($eptfg_settings_flocking['ratio-4-3']) echo 'checked'; ?>/><label for="ratio-4-3"><?php if($eptfg_settings_flocking['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>4:3</label>
    <input type="checkbox" id="ratio-1-1" name="eptfg-flocking-ratio-1-1" <?php if($eptfg_settings_flocking['ratio-1-1']) echo 'checked'; ?>/><label for="ratio-1-1"><?php if($eptfg_settings_flocking['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>1:1</label>
    <input type="checkbox" id="ratio-3-4" name="eptfg-flocking-ratio-3-4" <?php if($eptfg_settings_flocking['ratio-3-4']) echo 'checked'; ?>/><label for="ratio-3-4"><?php if($eptfg_settings_flocking['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>3:4</label>
    <input type="checkbox" id="ratio-9-16" name="eptfg-flocking-ratio-9-16" <?php if($eptfg_settings_flocking['ratio-9-16']) echo 'checked'; ?>/><label for="ratio-9-16"><?php if($eptfg_settings_flocking['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>9:16</label>
    <input type="checkbox" name="eptfg-flocking-lock-canvas-width" id="lock-canvas-width" <?php if($eptfg_settings_flocking['canvaswidthlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-width"><?php if($eptfg_settings_flocking['canvaswidthlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="number" id="canvas-width" name="eptfg-flocking-canvas-width" value="<?php echo $eptfg_settings_flocking['canvaswidth']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px x
    <input type="checkbox" name="eptfg-flocking-lock-canvas-height" id="lock-canvas-height" <?php if($eptfg_settings_flocking['canvasheightlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-height"><?php if($eptfg_settings_flocking['canvasheightlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="text" id="canvas-height" name="eptfg-flocking-canvas-height" value="<?php echo $eptfg_settings_flocking['canvasheight']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px
</div>
<div class="flex-container">
<div class="userinput-container">
    <div class="userinput-block">
        <p>EDIT THE SCENE</p>
        <div class="userinput-item">
            <span class="left"><input type="button" id="restart-simulation-button" value="RESTART SIMULATION"></input></span>
            <span class="right"><input type="button" id="default-values-button" value="SET DEFAULT VALUES"></input></span>
        </div>
        <div class="userinput-item">
        <span class="left">scene width</span><span class="right"><input type="range" min="100" max="1000" value="<?php echo $eptfg_settings_flocking['scenewidth']; ?>" step="1" id="scene-scale" name="eptfg-flocking-scene-width" oninput="document.getElementById('zoomlabel').value = this.value"/><input type="number" id="zoomlabel" min="100" max="1000" value="<?php echo $eptfg_settings_flocking['scenewidth']; ?>" step="1" onchange="document.getElementById('scene-scale').value = this.value"></input></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE SIMULATION</p>
        <div class="userinput-item">
            <span class="left">quantity</span>
            <span class="right"><input type="number" min="2" max="400" value="<?php echo $eptfg_settings_flocking['quantity']; ?>" id="input-quantity" name="eptfg-flocking-quantity"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">size</span>
            <span class="right"><input type="range" min="1" max="20" step="1" value="<?php echo $eptfg_settings_flocking['size']; ?>" id="input-radius" name="eptfg-flocking-size"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">separation</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_flocking['separation']; ?>" id="input-separationweight" name="eptfg-flocking-separation"/>
        </div>
        <div class="userinput-item">
            <span class="left">alignment</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_flocking['alignment']; ?>" id="input-alignmentweight" name="eptfg-flocking-alignment"/>
        </div>
        <div class="userinput-item">
            <span class="left">cohesion</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_flocking['cohesion']; ?>" id="input-cohesionweight" name="eptfg-flocking-cohesion"/>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE AESTHETICS</p>
        <div class="userinput-item">
            <span class="left"><label for="input-oriented">oriented towards movement</label></span>
            <span class="right"><input type="checkbox" id="input-oriented" name="eptfg-flocking-oriented" <?php if($eptfg_settings_flocking['oriented']) echo 'checked'; ?>/></span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-shape" name="eptfg-flocking-visualrepresentation" value="shape" <?php if($eptfg_settings_flocking['visualrepresentation'] == 'shape') echo 'checked'; ?>/> <label for="input-visualrepresentation-shape">shape</label>
            </span>
            <span class="right">
                <input type="radio" id="input-shape-circle" name="eptfg-flocking-shape" value="circle" <?php if($eptfg_settings_flocking['shape'] == 'circle') echo 'checked'; ?>/> <label for="input-shape-circle">circle</label><br/>
                <input type="radio" id="input-shape-triangle" name="eptfg-flocking-shape" value="triangle" <?php if($eptfg_settings_flocking['shape'] == 'triangle') echo 'checked'; ?>/> <label for="input-shape-triangle">triangle</label><br/>
                <input type="radio" id="input-shape-square" name="eptfg-flocking-shape" value="square" <?php if($eptfg_settings_flocking['shape'] == 'square') echo 'checked'; ?>/> <label for="input-shape-square">square</label><br/>
                <input type="color" value="#000000" id="input-color" name="eptfg-flocking-color"/>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-image" name="eptfg-flocking-visualrepresentation" value"image" <?php if($eptfg_settings_flocking['visualrepresentation'] == 'image') echo 'checked'; ?>/> <label for="input-visualrepresentation-image">image</label>
            </span>
            <span class="right">
                <input type="file" accept="image/*" id="input-image" name="eptfg-flocking-image"/><!--TODO value-->
            </span>
        </div>
    </div>

<?php submit_button(); ?>

</div>

<div style="flex: auto; margin: 0 20px;">
<h2>How to use</h2>
<ol>
<li>Edit the animation.</li>
<li>Save the animation.</li>
<li>Use a shortcode wherever you want to display your animation.</li>
</ol>
<h2>Shortcodes:</h2>
<ul>
<li>[Easy-Physics-Springs]</li>
<li>[Easy-Physics-Floating]</li>
<li>[Easy-Physics-Flocking]</li>
<li>[Easy-Physics-Steering]</li>
</ul>
</div>

</div>

</form>
</div>
<?php
