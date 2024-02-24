<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Article[] $articles
 */

class Article extends Entity
{
    protected $_accessible = [
        'title' => true,
        'body' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
