<?php

return [
    '~^register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^login$~' => [\MyProject\Controllers\UsersController::class, 'logIn'],
    '~^logout$~' => [\MyProject\Controllers\UsersController::class, 'logOut'],
    '~^users$~' => [\MyProject\Controllers\UsersController::class, 'listOfUsers'],
    '~^profile/settings~' => [\MyProject\Controllers\UsersController::class, 'profileSettings'],
    '~^profile/([\w\s\-]+)$~' => [\MyProject\Controllers\UsersController::class, 'profileInfo'],
 /*   '~^profile~' => [\MyProject\Controllers\UsersController::class, 'profileInfo'],*/
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];