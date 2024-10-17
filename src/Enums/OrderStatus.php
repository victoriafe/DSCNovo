<?php

namespace App\Enums;

enum OrderStatus : int
{
    case RECEIVED = 0;
    case DELIVERED = 1;
}
