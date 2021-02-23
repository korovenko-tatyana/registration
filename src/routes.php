<?php

return [
    '~^register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^login$~' => [\MyProject\Controllers\UsersController::class, 'logIn'],
    '~^logout$~' => [\MyProject\Controllers\UsersController::class, 'logOut'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];