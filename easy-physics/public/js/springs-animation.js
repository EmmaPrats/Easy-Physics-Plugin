"use strict";

window[eptfgSettingsSprings.animationID] = new SpringsAnimation (document.getElementById(eptfgSettingsSprings.canvasID), false);

(function animationLoop()
 {
 window[eptfgSettingsSprings.animationID].draw();
 window.requestAnimationFrame (animationLoop);
 })();
