<?php

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Analitic;
use Rottenwood\BarchartBundle\Entity\Indicator;
use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Rottenwood\BarchartBundle\Form\StrategyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        return [];
    }

    /**
     * @Route("/barchart")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeStrategyAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $strategy = new Strategy();
        $strategy->setAuthors([$this->getUser()]);

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($this->getUser());
        $account->setBalance(1000);
        $account->setStrategy($strategy);

        $form = $this->createForm(new StrategyType(), $strategy);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $strategy = $form->getData();

            $em->persist($strategy);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
