<div class="wrap">
<h1>Steering - Easy Physics</h1>
<h2>Preview:</h2>
<div class="eptfg-canvas-container"><!--TODO crec que és igual la classe-->
    <canvas width="<?php if(get_option('eptfg-steering-canvas-width', 480) == "") echo 480; else echo get_option('eptfg-steering-canvas-width', 480);?>" height="<?php if(get_option('eptfg-steering-canvas-height', 360) == "") echo 360; else echo get_option('eptfg-steering-canvas-height', 360);?>" id="eptfg-canvas"></canvas>
</div>
<form method="post" action="options.php">
<?php
settings_fields( 'eptfg_settings_steering' );
do_settings_sections( EPTFG_PLUGIN_NAME . '_Steering' );

$eptfg_settings_steering = array(
    'grid' => get_option( 'eptfg-steering-grid', false),
    'ratio-16-9' => get_option( 'eptfg-steering-ratio-16-9', false),
    'ratio-4-3' => get_option( 'eptfg-steering-ratio-4-3', false),
    'ratio-1-1' => get_option( 'eptfg-steering-ratio-1-1', false),
    'ratio-3-4' => get_option( 'eptfg-steering-ratio-3-4', false),
    'ratio-9-16' => get_option( 'eptfg-steering-ratio-9-16', false),
    'canvaswidthlocked' => get_option( 'eptfg-steering-lock-canvas-width', false),
    'canvasheightlocked' => get_option( 'eptfg-steering-lock-canvas-height', false),
    'canvaswidth' => get_option( 'eptfg-steering-canvas-width', 480 ),
    'canvasheight' => get_option( 'eptfg-steering-canvas-height', 360 ),
    
    'scenewidth' => get_option( 'eptfg-steering-scene-width', 400),
    
    'size' => get_option( 'eptfg-steering-size', 5),
    
    'hunterexists' => get_option( 'eptfg-steering-hunterexists', true),
    'huntdistance' => get_option( 'eptfg-steering-huntdistance', 200),
    'showhuntdistance' => get_option( 'eptfg-steering-showhuntdistance', false),
    'pursueweight' => get_option( 'eptfg-steering-pursueweight', 1.0),
    
    'gathererexists' => get_option( 'eptfg-steering-gathererexists', true),
    'gatherdistance' => get_option( 'eptfg-steering-gatherdistance', 200),
    'showgatherdistance' => get_option( 'eptfg-steering-showgatherdistance', false),
    'seekweight' => get_option( 'eptfg-steering-seekweight', 1.0),
    'evadedistance' => get_option( 'eptfg-steering-evadedistance', 200),
    'showevadedistance' => get_option( 'eptfg-steering-showevadedistance', false),
    'evadeweight' => get_option( 'eptfg-steering-evadeweight', 1.0),
    
    'targetexists' => get_option( 'eptfg-steering-targetexists', true),
    
    'oriented-hunter' => get_option( 'eptfg-steering-oriented-hunter', true),
    'visualrepresentation-hunter' => get_option( 'eptfg-steering-visualrepresentation-hunter', 'shape'),
    'shape-hunter' => get_option ( 'eptfg-steering-shape-hunter', 'triangle' ),
    'image-hunter' => get_option ( 'eptfg-steering-image-hunter', null ), //TODO
    'color-hunter' => get_option( 'eptfg-steering-color-hunter', '#000000' ),
    
    'oriented-gatherer' => get_option( 'eptfg-steering-oriented-gatherer', true),
    'visualrepresentation-gatherer' => get_option( 'eptfg-steering-visualrepresentation-gatherer', 'shape'),
    'shape-gatherer' => get_option ( 'eptfg-steering-shape-gatherer', 'circle' ),
    'image-gatherer' => get_option ( 'eptfg-steering-image-gatherer', null ), //TODO
    'color-gatherer' => get_option( 'eptfg-steering-color-gatherer', '#000000' ),
    
    'visualrepresentation-target' => get_option( 'eptfg-steering-visualrepresentation-target', 'shape'),
    'shape-target' => get_option ( 'eptfg-steering-shape-target', 'square' ),
    'image-target' => get_option ( 'eptfg-steering-image-target', null ), //TODO
    'color-target' => get_option( 'eptfg-steering-color-target', '#000000' )
);
?>
<div class="toolbar">
    <input type="checkbox" id="grid" name="eptfg-steering-grid" <?php if($eptfg_settings_steering['grid']) echo 'checked'; ?>/><label for="grid">Grid</label>
    <input type="checkbox" id="ratio-16-9" name="eptfg-steering-ratio-16-9" <?php if($eptfg_settings_steering['ratio-16-9']) echo 'checked'; ?>/><label for="ratio-16-9"><?php if($eptfg_settings_steering['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>16:9</label>
    <input type="checkbox" id="ratio-4-3" name="eptfg-steering-ratio-4-3" <?php if($eptfg_settings_steering['ratio-4-3']) echo 'checked'; ?>/><label for="ratio-4-3"><?php if($eptfg_settings_steering['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>4:3</label>
    <input type="checkbox" id="ratio-1-1" name="eptfg-steering-ratio-1-1" <?php if($eptfg_settings_steering['ratio-1-1']) echo 'checked'; ?>/><label for="ratio-1-1"><?php if($eptfg_settings_steering['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>1:1</label>
    <input type="checkbox" id="ratio-3-4" name="eptfg-steering-ratio-3-4" <?php if($eptfg_settings_steering['ratio-3-4']) echo 'checked'; ?>/><label for="ratio-3-4"><?php if($eptfg_settings_steering['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>3:4</label>
    <input type="checkbox" id="ratio-9-16" name="eptfg-steering-ratio-9-16" <?php if($eptfg_settings_steering['ratio-9-16']) echo 'checked'; ?>/><label for="ratio-9-16"><?php if($eptfg_settings_steering['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>9:16</label>
    <input type="checkbox" name="eptfg-steering-lock-canvas-width" id="lock-canvas-width" <?php if($eptfg_settings_steering['canvaswidthlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-width"><?php if($eptfg_settings_steering['canvaswidthlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="number" id="canvas-width" name="eptfg-steering-canvas-width" value="<?php echo $eptfg_settings_steering['canvaswidth']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px x
    <input type="checkbox" name="eptfg-steering-lock-canvas-height" id="lock-canvas-height" <?php if($eptfg_settings_steering['canvasheightlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-height"><?php if($eptfg_settings_steering['canvasheightlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="text" id="canvas-height" name="eptfg-steering-canvas-height" value="<?php echo $eptfg_settings_steering['canvasheight']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px
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
        <span class="left">scene width</span><span class="right"><input type="range" min="100" max="1000" value="<?php echo $eptfg_settings_steering['scenewidth']; ?>" step="1" id="scene-scale" name="eptfg-steering-scene-width" oninput="document.getElementById('zoomlabel').value = this.value"/><input type="number" id="zoomlabel" min="100" max="1000" value="<?php echo $eptfg_settings_steering['scenewidth']; ?>" step="1" onchange="document.getElementById('scene-scale').value = this.value"></input></span>
        </div>
    </div>
    <div class="userinput-block">
        <div class="userinput-item">
            <span class="left">objects size</span>
            <span class="right"><input type="range" min="1" max="20" step="1" value="<?php echo $eptfg_settings_steering['size']; ?>" id="input-radius" name="eptfg-steering-size"/></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE HUNTER</p>
        <div class="userinput-item">
            <span class="left"><label for="input-active-hunter">exists</label></span>
            <span class="right"><input type="checkbox" id="input-active-hunter" name="eptfg-steering-hunterexists" <?php if($eptfg_settings_steering['hunterexists']) echo 'checked'; ?>/></span>
        </div>
    <div class="userinput-item">
            <span class="left">pray detection distance</span>
            <span class="right">
                <input type="range" min="0" max="1000" step="10" value="<?php echo $eptfg_settings_steering['huntdistance']; ?>" id="input-huntdistance" name="eptfg-steering-huntdistance"/>
                <input type="checkbox" id="input-show-huntdistance" name="eptfg-steering-showhuntdistance" <?php if($eptfg_settings_steering['showhuntdistance']) echo 'checked'; ?>/><label for="input-show-huntdistance"><!--TODO this might cause problem-->&#128065;</label>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">pursue</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_steering['pursueweight']; ?>" id="input-pursueweight" name="eptfg-steering-pursueweight"/></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE GATHERER</p>
        <div class="userinput-item">
            <span class="left"><label for="input-active-gatherer">exists</label></span>
            <span class="right"><input type="checkbox" id="input-active-gatherer" name="eptfg-steering-gathererexists" <?php if($eptfg_settings_steering['gathererexists']) echo 'checked'; ?>/></span>
        </div>
        <div class="userinput-item">
            <span class="left">target detection distance</span>
            <span class="right">
                <input type="range" min="0" max="1000" step="10" value="<?php echo $eptfg_settings_steering['gatherdistance']; ?>" id="input-gatherdistance" name="eptfg-steering-gatherdistance"/>
                <input type="checkbox" id="input-show-gatherdistance" name="eptfg-steering-showgatherdistance" <?php if($eptfg_settings_steering['showgatherdistance']) echo 'checked'; ?>/><label for="input-show-gatherdistance"><!--TODO this might cause problem-->&#128065;</label>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">seek</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_steering['seekweight']; ?>" id="input-seekweight" name="eptfg-steering-seekweight"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">hunter detection distance</span>
            <span class="right">
                <input type="range" min="0" max="1000" step="10" value="<?php echo $eptfg_settings_steering['evadedistance']; ?>" id="input-evadedistance" name="eptfg-steering-evadedistance"/>
                <input type="checkbox" id="input-show-evadedistance" name="eptfg-steering-showevadedistance" <?php if($eptfg_settings_steering['showevadedistance']) echo 'checked'; ?>/><label for="input-show-evadedistance"><!--TODO this might cause problem-->&#128065;</label>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">evade</span>
            <span class="right"><input type="range" min="0.0" max="2.0" step="0.1" value="<?php echo $eptfg_settings_steering['evadeweight']; ?>" id="input-evadeweight" name="eptfg-steering-evadeweight"/></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE TARGET</p>
        <div class="userinput-item">
            <span class="left"><label for="input-active-target">exists</label></span>
            <span class="right"><input type="checkbox" id="input-active-target" name="eptfg-steering-targetexists" <?php if($eptfg_settings_steering['targetexists']) echo 'checked'; ?>/></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE HUNTER'S AESTHETICS</p>
        <div class="userinput-item">
            <span class="left"><label for="input-oriented-hunter">oriented towards movement</label></span>
            <span class="right"><input type="checkbox" id="input-oriented-hunter" name="eptfg-steering-oriented-hunter" <?php if($eptfg_settings_steering['oriented-hunter']) echo 'checked'; ?>/></span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-shape-hunter" name="eptfg-steering-visualrepresentation-hunter" value="shape" <?php if($eptfg_settings_steering['visualrepresentation-hunter'] == 'shape') echo 'checked'; ?>/> <label for="input-visualrepresentation-shape-hunter">shape</label>
            </span>
            <span class="right">
                <input type="radio" id="input-shape-circle-hunter" name="eptfg-steering-shape-hunter" value="circle" <?php if($eptfg_settings_steering['shape-hunter'] == 'circle') echo 'checked'; ?>/> <label for="input-shape-circle-hunter">circle</label><br/>
                <input type="radio" id="input-shape-triangle-hunter" name="eptfg-steering-shape-hunter" value="triangle" <?php if($eptfg_settings_steering['shape-hunter'] == 'triangle') echo 'checked'; ?>/> <label for="input-shape-triangle-hunter">triangle</label><br/>
                <input type="radio" id="input-shape-square-hunter" name="eptfg-steering-shape-hunter" value="square" <?php if($eptfg_settings_steering['shape-hunter'] == 'square') echo 'checked'; ?>/> <label for="input-shape-square-hunter">square</label><br/>
                <input type="color" value="<?php echo $eptfg_settings_steering['color-hunter']; ?>" id="input-color-hunter" name="eptfg-steering-color-hunter"/>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-image-hunter" name="eptfg-steering-visualrepresentation-hunter" value="image" <?php if($eptfg_settings_steering['visualrepresentation-hunter'] == 'image') echo 'checked'; ?>/> <label for="input-visualrepresentation-image-hunter">image</label>
            </span>
            <span class="right">
                <input type="file" accept="image/*" id="input-image-hunter"/>
                <input type="hidden" id="image-src-hunter" name="eptfg-steering-image-hunter" value="<?php echo $eptfg_settings_steering['image-hunter']; ?>"/>
                <img id="image-preview-hunter" src="<?php echo $eptfg_settings_steering['image-hunter']; ?>" width="50" height="50"/>
            </span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE GATHERER'S AESTHETICS</p>
        <div class="userinput-item">
            <span class="left"><label for="input-oriented-gatherer">oriented towards movement</label></span>
            <span class="right"><input type="checkbox" id="input-oriented-gatherer" name="eptfg-steering-oriented-gatherer" <?php if($eptfg_settings_steering['oriented-gatherer']) echo 'checked'; ?>/></span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-shape-gatherer" name="eptfg-steering-visualrepresentation-gatherer" value="shape" <?php if($eptfg_settings_steering['visualrepresentation-gatherer'] == 'shape') echo 'checked'; ?>/> <label for="input-visualrepresentation-shape-gatherer">shape</label>
            </span>
            <span class="right">
                <input type="radio" id="input-shape-circle-gatherer" name="eptfg-steering-shape-gatherer" value="circle" <?php if($eptfg_settings_steering['shape-gatherer'] == 'circle') echo 'checked'; ?>/> <label for="input-shape-circle-gatherer">circle</label><br/>
                <input type="radio" id="input-shape-triangle-gatherer" name="eptfg-steering-shape-gatherer" value="triangle" <?php if($eptfg_settings_steering['shape-gatherer'] == 'triangle') echo 'checked'; ?>/> <label for="input-shape-triangle-gatherer">triangle</label><br/>
                <input type="radio" id="input-shape-square-gatherer" name="eptfg-steering-shape-gatherer" value="square" <?php if($eptfg_settings_steering['shape-gatherer'] == 'square') echo 'checked'; ?>/> <label for="input-shape-square-gatherer">square</label><br/>
                <input type="color" value="<?php echo $eptfg_settings_steering['color-gatherer']; ?>" id="input-color-gatherer" name="eptfg-steering-color-gatherer"/>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-image-gatherer" name="eptfg-steering-visualrepresentation-gatherer" value="image" <?php if($eptfg_settings_steering['visualrepresentation-gatherer'] == 'image') echo 'checked'; ?>/> <label for="input-visualrepresentation-image-gatherer">image</label>
            </span>
            <span class="right">
                <input type="file" accept="image/*" id="input-image-gatherer"/>
                <input type="hidden" id="image-src-gatherer" name="eptfg-steering-image-gatherer" value="<?php echo $eptfg_settings_steering['image-gatherer']; ?>"/>
                <img id="image-preview-gatherer" src="<?php echo $eptfg_settings_steering['image-gatherer']; ?>" width="50" height="50"/>
            </span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE TARGET'S AESTHETICS</p>
        <div class="userinput-item">
            <span class="left"><label for="input-oriented-target">oriented towards movement</label></span>
            <span class="right"><input type="checkbox" id="input-oriented-target" name="eptfg-steering-oriented-target" <?php if($eptfg_settings_steering['oriented-target']) echo 'checked'; ?>/></span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-shape-target" name="eptfg-steering-visualrepresentation-target" value="shape" <?php if($eptfg_settings_steering['visualrepresentation-target'] == 'shape') echo 'checked'; ?>/> <label for="input-visualrepresentation-shape-target">shape</label>
            </span>
            <span class="right">
                <input type="radio" id="input-shape-circle-target" name="eptfg-steering-shape-target" value="circle" <?php if($eptfg_settings_steering['shape-target'] == 'circle') echo 'checked'; ?>/> <label for="input-shape-circle-target">circle</label><br/>
                <input type="radio" id="input-shape-triangle-target" name="eptfg-steering-shape-target" value="triangle" <?php if($eptfg_settings_steering['shape-target'] == 'triangle') echo 'checked'; ?>/> <label for="input-shape-triangle-target">triangle</label><br/>
                <input type="radio" id="input-shape-square-target" name="eptfg-steering-shape-target" value="square" <?php if($eptfg_settings_steering['shape-target'] == 'square') echo 'checked'; ?>/> <label for="input-shape-square-target">square</label><br/>
                <input type="color" value="<?php echo $eptfg_settings_steering['color-target']; ?>" id="input-color-target" name="eptfg-steering-color-target"/>
            </span>
        </div>
        <div class="userinput-item">
            <span class="left">
                visual representation:<br/>
                <input type="radio" id="input-visualrepresentation-image-target" name="eptfg-steering-visualrepresentation-target" value="image" <?php if($eptfg_settings_steering['visualrepresentation-target'] == 'image') echo 'checked'; ?>/> <label for="input-visualrepresentation-image-target">image</label>
            </span>
            <span class="right">
                <input type="file" accept="image/*" id="input-image-target"/>
                <input type="hidden" id="image-src-target" name="eptfg-steering-image-target" value="<?php echo $eptfg_settings_steering['image-target']; ?>"/>
                <img id="image-preview-target" src="<?php echo $eptfg_settings_steering['image-target']; ?>" width="50" height="50"/>
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
