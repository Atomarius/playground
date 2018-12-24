<?php

use Interop\Container\ContainerInterface;

$definitions = [
    'central_corridor' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("Central Corridor",
            <<<DSC
The Gothons of Planet Percal #25 have invaded your ship and destroyed
your entire crew.  You are the last surviving member and your last
mission is to get the neutron destruct bomb from the Weapons Armory,
put it in the bridge, and blow the ship up after getting into an
escape pod.
You're running down the central corridor to the Weapons Armory when
a Gothon jumps out, red scaly skin, dark grimy teeth, and evil clown costume
flowing around his hate filled body.  He's blocking the door to the
Armory and about to pull a weapon to blast you.
DSC
        );

        return $scene;
    },
    'laser_weapon_armory' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("Laser Weapon Armory",
            <<<DSC
Lucky for you they made you learn Gothon insults in the academy.
You tell the one Gothon joke you know:
Lbhe zbgure vf fb sng, jura fur fvgf nebhaq gur ubhfr, fur fvgf nebhaq gur ubhfr.
The Gothon stops, tries not to laugh, then busts out laughing and can't move.
While he's laughing you run up and shoot him square in the head
putting him down, then jump through the Weapon Armory door.
You do a dive roll into the Weapon Armory, crouch and scan the room
for more Gothons that might be hiding.  It's dead quiet, too quiet.
You stand up and run to the far side of the room and find the
neutron bomb in its container.  There's a keypad lock on the box
and you need the code to get the bomb out.  If you get the code
wrong 10 times then the lock closes forever and you can't
get the bomb.  The code is 3 digits.
DSC
        );

        return $scene;
    },
    'the_bridge' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("The Bridge",
            <<<DSC
The container clicks open and the seal breaks, letting gas out.
You grab the neutron bomb and run as fast as you can to the
bridge where you must place it in the right spot.
You burst onto the Bridge with the netron destruct bomb
under your arm and surprise 5 Gothons who are trying to
take control of the ship.  Each of them has an even uglier
clown costume than the last.  They haven't pulled their
weapons out yet, as they see the active bomb under your
arm and don't want to set it off.
DSC
        );

        return $scene;
    },
    'escape_pod' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("Escape Pod",
            <<<DSC
The container clicks open and the seal breaks, letting gas out.
You grab the neutron bomb and run as fast as you can to the
bridge where you must place it in the right spot.
You burst onto the Bridge with the netron destruct bomb
under your arm and surprise 5 Gothons who are trying to
take control of the ship.  Each of them has an even uglier
clown costume than the last.  They haven't pulled their
weapons out yet, as they see the active bomb under your
arm and don't want to set it off.
DSC
        );

        return $scene;
    },
    'the_end_winner' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("The End",
            <<<DSC
You jump into pod 2 and hit the eject button.
The pod easily slides out into space heading to
the planet below.  As it flies to the planet, you look
back and see your ship implode then explode like a
bright star, taking out the Gothon ship at the same
time.
You won!
DSC
        );

        return $scene;
    },
    'the_end_loser' => function (ContainerInterface $con) {
        $scene = new \Game\Scene("The End",
            <<<DSC
You jump into a random pod and hit the eject button.
The pod escapes out into the void of space, then
implodes as the hull ruptures, crushing your body
into jam jelly.
DSC
        );

        return $scene;
    },
];


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);
$builder->addDefinitions($definitions);
$builder->build();