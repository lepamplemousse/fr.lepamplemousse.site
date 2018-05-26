<?php
/**
 * Created by PhpStorm.
 * User: Game
 * Date: 26/05/2018
 * Time: 08:10
 */

namespace AppBundle\Service\Impl;


use AppBundle\Repository\Impl\BattleNetRepositoryImpl;
use AppBundle\Service\IBattleNetService;

class BattleNetServiceImpl implements IBattleNetService {

    /**
     * @var
     */
    private $keyBNET;

    /**
     * @var array
     */
    private $gender = array(
        0 => 'Masculin',
        1 => 'Féminin'
    );

    /**
     * @var BattleNetRepositoryImpl
     */
    private $battleNetRepository;

    /**
     * BattleNetServiceImpl constructor.
     * @param $keyBNET
     */
    public function __construct($keyBNET) {
        $this->keyBNET = $keyBNET;
    }

    /**
     * @param $url
     * @return mixed
     */
    private function getCURL($url) {
        $url .= $this->keyBNET;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        $result = curl_exec($ch);
        curl_close($ch);

        $resultat = json_decode($result, true);
        return $resultat;
    }


    /**
     * @return array
     */
    public function getCharactersWoW() {

        $charactersWoWList = $this->battleNetRepository->getCharactersWoW();
        $return = array();
        foreach ($charactersWoWList as $character) {
            $myCharacter = $this->getCharacterWoW($character->getName(), $character->getRealm());
           if ($myCharacter) {
               $return[] = $myCharacter;
           }
        }
        return $return;
    }

    /**
     * @param $name
     * @param $realm
     * @return mixed
     */
    private function getCharacterWoW($name, $realm) {
        $url = 'https://eu.api.battle.net/wow/character/' . $realm . '/' . $name . '?locale=fr_FR&apikey=';
        $resultat = $this->getCURL($url);
        $return = null;
        if (!isset($resultat['status'])){
            $return['level'] = $resultat['level'];
            $return['name'] = $resultat['name'];
            $return['class'] = $this->getClasseWoW($resultat['class']);
            $return['race'] = $this->getRaceWoW($resultat['race']);
            $return['gender'] = $this->gender[$resultat['gender']];
            $return['thumbnail'] = $resultat['thumbnail'];
        }
        return $return;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getClasseWoW($id) {
        $url = 'https://eu.api.battle.net/wow/data/character/classes?locale=fr_FR&apikey=';
        $classes = $this->getCURL($url);

        foreach ($classes as $classe) {
            foreach ($classe as $data) {
                if ($data['id'] == $id) {
                    return $data['name'];
                }
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getRaceWoW($id) {
        $url = 'https://eu.api.battle.net/wow/data/character/races?locale=fr_FR&apikey=';
        $races = $this->getCURL($url);

        foreach ($races as $race) {
            foreach ($race as $data) {
                if ($data['id'] == $id) {
                    return $data['name'];
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getCharactersD3() {
        $url = 'https://eu.api.battle.net/d3/profile/Neliwien-2880/?locale=fr_FR&apikey=';
        $resultat = $this->getCURL($url);
        return $resultat;
    }

    /**
     * @return BattleNetRepositoryImpl
     */
    public function getBattleNetRepository() {
        return $this->battleNetRepository;
    }

    /**
     * @param BattleNetRepositoryImpl $battleNetRepository
     */
    public function setBattleNetRepository($battleNetRepository) {
        $this->battleNetRepository = $battleNetRepository;
    }


}