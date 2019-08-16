"use strict";

window[eptfgSettingsFlocking.animationID] = new FlockingAnimation (document.getElementById(eptfgSettingsFlocking.canvasID), false);

(function animationLoop()
 {
 window[eptfgSettingsFlocking.animationID].draw();
 window.requestAnimationFrame (animationLoop);
 })();
