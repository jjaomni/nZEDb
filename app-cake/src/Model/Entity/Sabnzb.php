<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sabnzb Entity
 *
 * @property int $user_id
 * @property string $url
 * @property string $api_key
 * @property bool $api_key_type
 * @property bool $priority
 */
class Sabnzb extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'url' => true,
        'api_key' => true,
        'api_key_type' => true,
        'priority' => true
    ];
}
