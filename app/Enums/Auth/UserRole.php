<?php

namespace App\Enums\Auth;


#############created to handle roles of the user###################
enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
}

##########app->Enums->Auth->UserRole.php###############
