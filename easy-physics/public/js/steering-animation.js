"use strict";

window[eptfgSettingsSteering.animationID] = new SteeringAnimation (document.getElementById(eptfgSettingsSteering.canvasID), false);

(function animationLoop()
 {
 window[eptfgSettingsSteering.animationID].draw();
 window.requestAnimationFrame (animationLoop);
 })();
