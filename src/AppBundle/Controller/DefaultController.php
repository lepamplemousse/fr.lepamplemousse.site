<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        $charactersWoW = $this->get('BattleNetService')->getCharactersWoW();
        $charactersD3 = $this->get('BattleNetService')->getCharactersD3();

        return $this->render('@App/default/games.html.twig', [
            'charactersWoW' => $charactersWoW,
            'charactersD3' => $charactersD3
        ]);

        //return $this->render('@App/default/index.html.twig');
    }
}
