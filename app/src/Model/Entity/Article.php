<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    protected $_accessible = [
        'title' => true,
        'body' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
