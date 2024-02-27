<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $article_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Like[] $likes
 */

class Like extends Entity
{
    protected $_accessible = [
        'user_id' => true,
        'article_id' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
