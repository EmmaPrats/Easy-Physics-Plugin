<div class="wrap">
<h1>Floating - Easy Physics</h1>
<h2>Preview:</h2>
<div class="eptfg-canvas-container"><!--TODO crec que és igual la classe-->
    <canvas width="<?php if(get_option('eptfg-floating-canvas-width', 480) == "") echo 480; else echo get_option('eptfg-floating-canvas-width', 480);?>" height="<?php if(get_option('eptfg-floating-canvas-height', 360) == "") echo 360; else echo get_option('eptfg-floating-canvas-height', 360);?>" id="eptfg-canvas"></canvas>
</div>
<form method="post" action="options.php">
<?php
settings_fields( 'eptfg_settings_floating' );
do_settings_sections( EPTFG_PLUGIN_NAME . '_Floating' );

$eptfg_settings_floating = array(
    'grid' => get_option( 'eptfg-floating-grid', true),
    'ratio-16-9' => get_option( 'eptfg-floating-ratio-16-9', false),
    'ratio-4-3' => get_option( 'eptfg-floating-ratio-4-3', false),
    'ratio-1-1' => get_option( 'eptfg-floating-ratio-1-1', false),
    'ratio-3-4' => get_option( 'eptfg-floating-ratio-3-4', false),
    'ratio-9-16' => get_option( 'eptfg-floating-ratio-9-16', false),
    'canvaswidthlocked' => get_option( 'eptfg-floating-lock-canvas-width', false),
    'canvasheightlocked' => get_option( 'eptfg-floating-lock-canvas-height', false),
    'canvaswidth' => get_option( 'eptfg-floating-canvas-width', 480 ),
    'canvasheight' => get_option( 'eptfg-floating-canvas-height', 360 ),
    
    'scenewidth' => get_option( 'eptfg-floating-scene-width', 5),
    'waterlevel' => get_option( 'eptfg-floating-waterlevel', 0),
    
    'gravity' => get_option( 'eptfg-floating-gravity', 9.8),
    'mass' => get_option( 'eptfg-floating-mass', 500),
    'liquiddensity' => get_option( 'eptfg-floating-liquiddensity', 1000),
    
    'text' => get_option( 'eptfg-floating-text', 'TFG'),
    'fonts' => get_option( 'eptfg-floating-fonts', 'Arial'),
    'font' => get_option( 'eptfg-floating-font', ''),
    'letterscolor' => get_option( 'eptfg-floating-letterscolor', '#000000' ),
    
    'size' => get_option( 'eptfg-floating-size', 1),
    'liquidcolor' => get_option( 'eptfg-floating-liquidcolor', '#0000FF' ),
    'liquidopacity' => get_option( 'eptfg-floating-liquidopacity', 0.7 ),
);
?>
<div class="toolbar">
    <input type="checkbox" id="grid" name="eptfg-floating-grid" <?php if($eptfg_settings_floating['grid']) echo 'checked'; ?>/><label for="grid">Grid</label>
    <input type="checkbox" id="ratio-16-9" name="eptfg-floating-ratio-16-9" <?php if($eptfg_settings_floating['ratio-16-9']) echo 'checked'; ?>/><label for="ratio-16-9"><?php if($eptfg_settings_floating['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>16:9</label>
    <input type="checkbox" id="ratio-4-3" name="eptfg-floating-ratio-4-3" <?php if($eptfg_settings_floating['ratio-4-3']) echo 'checked'; ?>/><label for="ratio-4-3"><?php if($eptfg_settings_floating['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>4:3</label>
    <input type="checkbox" id="ratio-1-1" name="eptfg-floating-ratio-1-1" <?php if($eptfg_settings_floating['ratio-1-1']) echo 'checked'; ?>/><label for="ratio-1-1"><?php if($eptfg_settings_floating['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>1:1</label>
    <input type="checkbox" id="ratio-3-4" name="eptfg-floating-ratio-3-4" <?php if($eptfg_settings_floating['ratio-3-4']) echo 'checked'; ?>/><label for="ratio-3-4"><?php if($eptfg_settings_floating['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>3:4</label>
    <input type="checkbox" id="ratio-9-16" name="eptfg-floating-ratio-9-16" <?php if($eptfg_settings_floating['ratio-9-16']) echo 'checked'; ?>/><label for="ratio-9-16"><?php if($eptfg_settings_floating['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>9:16</label>
    <input type="checkbox" name="eptfg-floating-lock-canvas-width" id="lock-canvas-width" <?php if($eptfg_settings_floating['canvaswidthlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-width"><?php if($eptfg_settings_floating['canvaswidthlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="number" id="canvas-width" name="eptfg-floating-canvas-width" value="<?php echo $eptfg_settings_floating['canvaswidth']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px x
    <input type="checkbox" name="eptfg-floating-lock-canvas-height" id="lock-canvas-height" <?php if($eptfg_settings_floating['canvasheightlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-height"><?php if($eptfg_settings_floating['canvasheightlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="text" id="canvas-height" name="eptfg-floating-canvas-height" value="<?php echo $eptfg_settings_floating['canvasheight']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px
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
        <span class="left">scene width</span><span class="right"><input type="range" min="5" max="30" value="<?php echo $eptfg_settings_floating['scenewidth']; ?>" step="1" id="scene-scale" name="eptfg-floating-scene-width" oninput="document.getElementById('zoomlabel').value = this.value"/><input type="number" id="zoomlabel" min="1" max="30" value="<?php echo $eptfg_settings_floating['scenewidth']; ?>" step="1" onchange="document.getElementById('scene-scale').value = this.value"></input></span>
        </div>
        <div class="userinput-item">
            <span class="left">water level</span>
            <span class="right"><input type="number" id="waterline" name="eptfg-floating-waterlevel" value="<?php echo $eptfg_settings_floating['waterlevel']; ?>" step="0.1"></input></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE SIMULATION</p>
        <div class="userinput-item">
            <span class="left">gravity</span>
            <span class="right"><input type="range" min="0.0" max="20.0" step="0.2" value="<?php echo $eptfg_settings_floating['gravity']; ?>" id="input-gravity" name="eptfg-floating-gravity"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">mass</span>
            <span class="right"><input type="range" type="range" min="100" max="30000" step="10" value="<?php echo $eptfg_settings_floating['mass']; ?>" id="input-mass" name="eptfg-floating-mass"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">liquid density</span>
            <span class="right"><input type="range" min="100" max="3000" step="50" value="<?php echo $eptfg_settings_floating['liquiddensity']; ?>" id="input-liquiddensity" name="eptfg-floating-liquiddensity"/></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE AESTHETICS</p>
        <div class="userinput-item">
            <span class="left">text</span>
            <span class="right"><input type="text" id="input-text" name="eptfg-floating-text" value="<?php echo $eptfg_settings_floating['text']; ?>"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">select font:</span>
            <span class="right"><select id="input-fonts" name="eptfg-floating-fonts">
                <option value="Arial" <?php if ($eptfg_settings_floating['fonts'] == 'Arial') echo 'selected'; ?> style="font-family: 'Arial';">Arial</option>
                <option value="Arial Black" <?php if ($eptfg_settings_floating['fonts'] == 'Arial Black') echo 'selected'; ?> style="font-family: 'Arial Black';">Arial Black</option>
                <option value="Comic Sans MS" <?php if ($eptfg_settings_floating['fonts'] == 'Comic Sans MS') echo 'selected'; ?> style="font-family: 'Comic Sans MS';">Comic Sans MS</option>
                <option value="Courier" <?php if ($eptfg_settings_floating['fonts'] == 'Courier') echo 'selected'; ?> style="font-family: 'Courier';">Courier</option>
                <option value="Courier New" <?php if ($eptfg_settings_floating['fonts'] == 'Courier New') echo 'selected'; ?> style="font-family: 'Courier New';">Courier New</option>
                <option value="Georgia" <?php if ($eptfg_settings_floating['fonts'] == 'Georgia') echo 'selected'; ?> style="font-family: 'Georgia';">Georgia</option>
                <option value="Helvetica" <?php if ($eptfg_settings_floating['fonts'] == 'Helvetica') echo 'selected'; ?> style="font-family: 'Helvatica';">Helvetica</option>
                <option value="Tahoma" <?php if ($eptfg_settings_floating['fonts'] == 'Tahoma') echo 'selected'; ?> style="font-family: 'Tahoma';">Tahoma</option>
                <option value="Times New Roman" <?php if ($eptfg_settings_floating['fonts'] == 'Times New Roman') echo 'selected'; ?> style="font-family: 'Times New Roman';">Times New Roman</option>
                <option value="Times" <?php if ($eptfg_settings_floating['fonts'] == 'Times') echo 'selected'; ?> style="font-family: 'Times';">Times</option>
                <option value="Trebuchet MS" <?php if ($eptfg_settings_floating['fonts'] == 'Trebuchet MS') echo 'selected'; ?> style="font-family: 'Trebuchet MS';">Trebuchet MS</option>
                <option value="Verdana" <?php if ($eptfg_settings_floating['fonts'] == 'Verdana') echo 'selected'; ?> style="font-family: 'Verdana';">Verdana</option>
            </select></span>
        </div>
        <div class="userinput-item">
            <span class="left">or enter your own:</span>
            <span class="right"><input type="text" id="input-font" name="eptfg-floating-font" value="<?php echo $eptfg_settings_floating['font']; ?>" placeholder="Arial"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">size</span>
            <span class="right"><input type="range" min="1" max="20" step="1" value="<?php echo $eptfg_settings_floating['size']; ?>" id="input-size" name="eptfg-floating-size"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">letters color</span>
            <span class="right"><input type="color" value="<?php echo $eptfg_settings_floating['letterscolor']; ?>" id="input-color" name="eptfg-floating-letterscolor"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">liquid color</span>
            <span class="right"><input type="color" value="<?php echo $eptfg_settings_floating['liquidcolor']; ?>" id="input-color-water" name="eptfg-floating-liquidcolor"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">liquid opacity</span>
            <span class="right"><input type="range" min="0" max="1" step="0.1" value="<?php echo $eptfg_settings_floating['liquidopacity']; ?>" id="input-opacity" name="eptfg-floating-liquidopacity"/></span>
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
