"use strict";

window[eptfgSettingsFloating.animationID] = new FloatingAnimation (document.getElementById(eptfgSettingsFloating.canvasID), false);

(function animationLoop()
 {
 window[eptfgSettingsFloating.animationID].draw();
 window.requestAnimationFrame (animationLoop);
 })();
