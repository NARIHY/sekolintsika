<?php

namespace App\Entity\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case BLOQUE = 'bloque';
    case PENDING = 'pending';
    case AUTRE = 'autre';
}
