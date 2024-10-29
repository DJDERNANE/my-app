<?php
namespace App\Enums;

enum UserTypes: string
{
    case Client = 'client';
    case Seller = 'seller';
    case Admin = 'admin';
}


enum UserStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
}

