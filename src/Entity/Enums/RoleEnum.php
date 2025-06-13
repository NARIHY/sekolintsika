<?php
// src/Entity/Enums/RoleEnum.php
namespace App\Entity\Enums;

enum RoleEnum: string
{
    case ETUDIANT = 'etudiant';
    case PARENT = 'parent';
    case SECRETAIRE = 'secretaire';
    case ADMINISTRATEUR = 'administrateur';
    case SUPER_ADMINISTRATEUR = 'super_administrateur';
}
