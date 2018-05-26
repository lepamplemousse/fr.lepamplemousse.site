<?php
/**
 * Created by PhpStorm.
 * User: Game
 * Date: 26/05/2018
 * Time: 08:38
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="characterwow")
 */
class CharacterWoW {

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $realm;

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRealm() {
        return $this->realm;
    }

    /**
     * @param mixed $realm
     */
    public function setRealm($realm) {
        $this->realm = $realm;
    }


}