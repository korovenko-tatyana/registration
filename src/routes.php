<?php

return [
    '~^register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];