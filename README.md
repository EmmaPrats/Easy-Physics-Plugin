# Easy Physics Plugin
WordPress plugin for the Easy Physics library!
This plugin allows you to create physics-based animations and add them to your WordPress site without coding.

If you want to use the library without the editor, you can find it ![here](...link to repository...).

### Springs

![alt text](https://github.com/Onpu93/Easy-Physics-Plugin/blob/master/sample-springs.png)

Each letter will be propelled away from the mouse when it gets close to them, and they will spring back into place when the mouse leaves. You can choose the text, font, color, spring strength, and more!

### Floating

![alt text](https://github.com/Onpu93/Easy-Physics-Plugin/blob/master/sample-floating.png)

Each letter is a solid object that floats in water. You can choose the letters, font, color, mass, liquid density, and more!

### Flocking

![alt text](https://github.com/Onpu93/Easy-Physics-Plugin/blob/master/sample-flocking.png)

It's a simple implementation of Reynolds' 1987 paper ["Flocks, Herds, and Shcools: A Distributed Behavioral Model"](https://www.red3d.com/cwr/boids/). It creates a flock of objects that move around. Those objects can be images, and you can tweak their behaviour.

### Steering

![alt text](https://github.com/Onpu93/Easy-Physics-Plugin/blob/master/sample-steering.png)

Another implementation of a Reynold's paper: ["Steering Behaviours for Autonomous Characters"](https://www.red3d.com/cwr/steer/). There are 2 agents and a prize. Agent A tries to reach the prize while avoiding Agent B, whose goal is to reach Agent A. You can tweak their behaviour and decide which elements you want in the scene.

## How to use
Once it's installed and activated, 4 new items will appear in your dashboard menu, one for each scene:
* EP Springs
* EP Floating
* EP Flocking
* EP Steering

Simply edit your animation and save changes. You can use the following shortcuts to display them:
* `[Easy-Physics-Springs]`
* `[Easy-Physics-Floating]`
* `[Easy-Physics-Flocking]`
* `[Easy-Physics-Steering]`

## How to install
1. Download the folder `easy-physics`.
2. Place the folder `easy-physics` in your plugins directory.
> `wordpress-trunk/wp-content/plugins/` <-- here
3. Go to your dashboard and activate the plugin.
