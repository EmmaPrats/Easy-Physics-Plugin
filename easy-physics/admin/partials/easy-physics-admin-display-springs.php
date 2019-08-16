<div class="wrap">
<h1>Springs - Easy Physics</h1>
<h2>Preview:</h2>
<div class="eptfg-canvas-container">
    <canvas width="<?php if(get_option('eptfg-springs-canvas-width', 480) == "") echo 480; else echo get_option('eptfg-springs-canvas-width', 480);?>" height="<?php if(get_option('eptfg-springs-canvas-height', 360) == "") echo 360; else echo get_option('eptfg-springs-canvas-height', 360);?>" id="eptfg-canvas"></canvas>
</div>
<form method="post" action="options.php">
<?php
settings_fields( 'eptfg_settings_springs' );
do_settings_sections( EPTFG_PLUGIN_NAME . '_Springs' );

$eptfg_settings_springs = array(
    'grid' => get_option( 'eptfg-springs-grid', true),
    'ratio-16-9' => get_option( 'eptfg-springs-ratio-16-9', false),
    'ratio-4-3' => get_option( 'eptfg-springs-ratio-4-3', false),
    'ratio-1-1' => get_option( 'eptfg-springs-ratio-1-1', false),
    'ratio-3-4' => get_option( 'eptfg-springs-ratio-3-4', false),
    'ratio-9-16' => get_option( 'eptfg-springs-ratio-9-16', false),
    'canvaswidthlocked' => get_option( 'eptfg-springs-lock-canvas-width', false),
    'canvasheightlocked' => get_option( 'eptfg-springs-lock-canvas-height', false),
    'canvaswidth' => get_option( 'eptfg-springs-canvas-width', 480 ),
    'canvasheight' => get_option( 'eptfg-springs-canvas-height', 360 ),
    
    'scenewidth' => get_option( 'eptfg-springs-scene-width', 11),
    
    'mass' => get_option( 'eptfg-springs-mass', 1),
    'stiffness' => get_option( 'eptfg-springs-stiffness', 150),
    'damping' => get_option( 'eptfg-springs-damping', 3),
    
    'text' => get_option( 'eptfg-springs-text', 'TFG'),
    'showtext' => get_option( 'eptfg-springs-showtext', true),
    'textlocationX' => get_option( 'eptfg-springs-textlocationX', 0),
    'textlocationY' => get_option( 'eptfg-springs-textlocationY', 0),
    'positioningmode' => get_option( 'eptfg-springs-positioningmode', false),
    'fonts' => get_option( 'eptfg-springs-fonts', 'Arial'),
    'font' => get_option( 'eptfg-springs-font', ''),
    'fontsize' => get_option( 'eptfg-springs-fontsize', 1),
    'color' => get_option( 'eptfg-springs-color', '#000000' )
);
?>
<div class="toolbar">
    <input type="checkbox" id="grid" name="eptfg-springs-grid" <?php if($eptfg_settings_springs['grid']) echo 'checked'; ?>/><label for="grid">Grid</label>
    <input type="checkbox" id="ratio-16-9" name="eptfg-springs-ratio-16-9" <?php if($eptfg_settings_springs['ratio-16-9']) echo 'checked'; ?>/><label for="ratio-16-9"><?php if($eptfg_settings_springs['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>16:9</label>
    <input type="checkbox" id="ratio-4-3" name="eptfg-springs-ratio-4-3" <?php if($eptfg_settings_springs['ratio-4-3']) echo 'checked'; ?>/><label for="ratio-4-3"><?php if($eptfg_settings_springs['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>4:3</label>
    <input type="checkbox" id="ratio-1-1" name="eptfg-springs-ratio-1-1" <?php if($eptfg_settings_springs['ratio-1-1']) echo 'checked'; ?>/><label for="ratio-1-1"><?php if($eptfg_settings_springs['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>1:1</label>
    <input type="checkbox" id="ratio-3-4" name="eptfg-springs-ratio-3-4" <?php if($eptfg_settings_springs['ratio-3-4']) echo 'checked'; ?>/><label for="ratio-3-4"><?php if($eptfg_settings_springs['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>3:4</label>
    <input type="checkbox" id="ratio-9-16" name="eptfg-springs-ratio-9-16" <?php if($eptfg_settings_springs['ratio-9-16']) echo 'checked'; ?>/><label for="ratio-9-16"><?php if($eptfg_settings_springs['ratio-16-9']) echo '&#128274;'; else echo '&#128275;' ?>9:16</label>
    <input type="checkbox" name="eptfg-springs-lock-canvas-width" id="lock-canvas-width" <?php if($eptfg_settings_springs['canvaswidthlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-width"><?php if($eptfg_settings_springs['canvaswidthlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="number" id="canvas-width" name="eptfg-springs-canvas-width" value="<?php echo $eptfg_settings_springs['canvaswidth']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px x
    <input type="checkbox" name="eptfg-springs-lock-canvas-height" id="lock-canvas-height" <?php if($eptfg_settings_springs['canvasheightlocked']) echo 'checked'; ?>/>
    <label for="lock-canvas-height"><?php if($eptfg_settings_springs['canvasheightlocked']) echo '&#128274;'; else echo '&#128275;'; ?></label>
    <input type="number" id="canvas-height" name="eptfg-springs-canvas-height" value="<?php echo $eptfg_settings_springs['canvasheight']; ?>" min="0" max="3000" step="1" size="4"/><!--TODO size???-->px
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
        <span class="left">scene width</span><span class="right"><input type="range" min="5" max="30" value="<?php echo $eptfg_settings_springs['scenewidth']; ?>" step="1" id="scene-scale" name="eptfg-springs-scene-width" oninput="document.getElementById('zoomlabel').value = this.value"/><input type="number" id="zoomlabel" min="5" max="30" value="<?php echo $eptfg_settings_springs['scenewidth']; ?>" step="1" onchange="document.getElementById('scene-scale').value = this.value"></input></span>
        </div>
    </div>
    <div class="userinput-block">
        <p>EDIT THE SIMULATION</p>
        <div class="userinput-item">
            <span class="left">mass</span>
            <span class="right"><input type="range" min="0.1" max="10" step="0.1" value="<?php echo $eptfg_settings_springs['mass']; ?>" id="input-mass" name="eptfg-springs-mass"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">stiffness</span>
            <span class="right"><input type="range" min="10" max="500" step="10" value="<?php echo $eptfg_settings_springs['stiffness']; ?>" id="input-stiffness" name="eptfg-springs-stiffness"/></span>
        </div>
        <div class="userinput-item">
            <span class="left">damping</span>
            <span class="right"><input type="range" min="0" max="10" step="1" value="<?php echo $eptfg_settings_springs['damping']; ?>" id="input-damping" name="eptfg-springs-damping"/></span>
        </div>
    </div>
    <div class="userinput-block">
    <p>EDIT THE AESTHETICS</p>
    <div class="userinput-item">
        <span class="left"><input type="text" id="input-text" name="eptfg-springs-text" value="<?php echo $eptfg_settings_springs['text']; ?>" onchange="refreshLetterPositionInputs()"/></span>
        <span class="right"><input type="checkbox" id="input-showtext" name="eptfg-springs-showtext" <?php if ($eptfg_settings_springs['showtext']) echo 'checked'; ?>/> <label for="input-showtext">show for guidance</label></span>
    </div>
    <div class="userinput-item">
        <span class="left">text position:</span>
        <span class="right">
            x=<input type="number" id="input-textlocationX" name="eptfg-springs-textlocationX" value="<?php echo $eptfg_settings_springs['textlocationX']; ?>" step="0.001"/><br/>
            y=<input type="number" id="input-textlocationY" name="eptfg-springs-textlocationY" value="<?php echo $eptfg_settings_springs['textlocationY']; ?>" step="0.001"/>
        </span>
    </div>
    <div class="userinput-item">
        help: <input type="checkbox" id="input-positioningmode" name="eptfg-springs-positioningmode" <?php if ($eptfg_settings_springs['positioningmode']) echo 'checked'; ?>/> <label for="input-positioningmode">move letters by dragging them</label>
    </div>
    <div class="userinput-title">
        letter positions:
    </div>
    <div id="letterlocations">
<?php
for ($i=0; $i<strlen($eptfg_settings_springs['text']); $i++)
{?>
    <div class="userinput-item">
        <span class="left"><?php echo $eptfg_settings_springs['text'][$i]; ?></span>
        <span class="right">
            x=<input type="number" id="letter-<?php echo $i; ?>-x" name="eptfg-springs-letterlocation<?php echo $i; ?>x" value="<?php echo get_option( 'eptfg-springs-letterlocation' . $i . 'x', $i*0.5 ); ?>" onchange="letterLocationChange(<?php echo $i; ?>,'x',this.value)" step="0.001"/><br/>
            y=<input type="number" id="letter-<?php echo $i; ?>-y" name="eptfg-springs-letterlocation<?php echo $i; ?>y" value="<?php echo get_option( 'eptfg-springs-letterlocation' . $i . 'y', 0 ); ?>" onchange="letterLocationChange(<?php echo $i; ?>,'y',this.value)" step="0.001"/><br/>
        </span>
    </div>
<?php
}?>
    </div>
    <div class="userinput-item">
        <span class="left">select font:</span>
        <span class="right"><select id="input-fonts" name="eptfg-springs-fonts">
            <option value="Arial" <?php if ($eptfg_settings_springs['fonts'] == 'Arial') echo 'selected'; ?> style="font-family: 'Arial';">Arial</option>
            <option value="Arial Black" <?php if ($eptfg_settings_springs['fonts'] == 'Arial Black') echo 'selected'; ?> style="font-family: 'Arial Black';">Arial Black</option>
            <option value="Comic Sans MS" <?php if ($eptfg_settings_springs['fonts'] == 'Comic Sans MS') echo 'selected'; ?> style="font-family: 'Comic Sans MS';">Comic Sans MS</option>
            <option value="Courier" <?php if ($eptfg_settings_springs['fonts'] == 'Courier') echo 'selected'; ?> style="font-family: 'Courier';">Courier</option>
            <option value="Courier New" <?php if ($eptfg_settings_springs['fonts'] == 'Courier New') echo 'selected'; ?> style="font-family: 'Courier New';">Courier New</option>
            <option value="Georgia" <?php if ($eptfg_settings_springs['fonts'] == 'Georgia') echo 'selected'; ?> style="font-family: 'Georgia';">Georgia</option>
            <option value="Helvetica" <?php if ($eptfg_settings_springs['fonts'] == 'Helvetica') echo 'selected'; ?> style="font-family: 'Helvatica';">Helvetica</option>
            <option value="Tahoma" <?php if ($eptfg_settings_springs['fonts'] == 'Tahoma') echo 'selected'; ?> style="font-family: 'Tahoma';">Tahoma</option>
            <option value="Times New Roman" <?php if ($eptfg_settings_springs['fonts'] == 'Times New Roman') echo 'selected'; ?> style="font-family: 'Times New Roman';">Times New Roman</option>
            <option value="Times" <?php if ($eptfg_settings_springs['fonts'] == 'Times') echo 'selected'; ?> style="font-family: 'Times';">Times</option>
            <option value="Trebuchet MS" <?php if ($eptfg_settings_springs['fonts'] == 'Trebuchet MS') echo 'selected'; ?> style="font-family: 'Trebuchet MS';">Trebuchet MS</option>
            <option value="Verdana" <?php if ($eptfg_settings_springs['fonts'] == 'Verdana') echo 'selected'; ?> style="font-family: 'Verdana';">Verdana</option>
        </select></span>
    </div>
    <div class="userinput-item">
        <span class="left">or enter your own:</span>
        <span class="right"><input type="text" id="input-font" name="eptfg-springs-font" value="<?php echo $eptfg_settings_springs['font']; ?>" placeholder="Arial"/></span>
    </div>
    <div class="userinput-item">
        <span class="left">font size</span>
        <span class="right"><input type="range" min="1" max="20" step="1" value="<?php echo $eptfg_settings_springs['fontsize']; ?>" id="input-size" name="eptfg-springs-fontsize"/></span>
    </div>
    <div class="userinput-item">
        <span class="left">color:</span>
        <span class="right"><input type="color" value="<?php echo $eptfg_settings_springs['color']; ?>" id="input-color" name="eptfg-springs-color"/></span>
    </div>
    <script>
function refreshLetterPositionInputs()
{
    var letterLocationsNode = document.getElementById("letterlocations");
    while (letterLocationsNode.firstChild)
    {
        letterLocationsNode.removeChild (letterLocationsNode.firstChild);
    }
    
    var text = document.getElementById("input-text").value;
    for (var i=0; i<text.length; i++)
    {
        var input = document.createElement("div");
        input.style.margin = 0;
        input.style.padding = 0;
        input.style.display = "flex";
        input.style.borderTop = "2px solid white";
        input.innerHTML = '<span class="left">' + text[i] + '</span><span class="right">x=<input type="number" id="letter-' + i + '-x" name="eptfg-springs-letterlocation' + i + 'x" value="' + (i*0.5) + '" onchange="letterLocationChange(' + i + ', \'x\', this.value)" step="0.001"/><br/>y=<input type="number" id="letter-' + i + '-y" name="eptfg-springs-letterlocation' + i + 'x" value="0" onchange="letterLocationChange(' + i + ', \'y\', this.value)" step="0.001"/></span>';
        letterLocationsNode.appendChild (input);
    }
}
    </script>
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

</form>
</div>
<?php
