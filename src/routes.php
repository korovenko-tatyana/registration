<?php

return [
    '~^register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^login$~' => [\MyProject\Controllers\UsersController::class, 'logIn'],
    '~^logout$~' => [\MyProject\Controllers\UsersController::class, 'logOut'],
    //'~^profile/settings~' => [\MyProject\Controllers\UsersController::class, 'profileSettings'],
    '~^profile~' => [\MyProject\Controllers\UsersController::class, 'profileInfo'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];