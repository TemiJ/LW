<?php

namespace CLW\Bundle\CoverLetterBundle\Controller;

use CLW\Bundle\CoverLetterBundle\Form\Type\stepTwoPositionInquiry;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepTwoAdvert;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepTwoPositionInquiryContact;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepTwoNotSure;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepThree;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepFour;
use CLW\Bundle\CoverLetterBundle\Form\Type\stepFive;
use CLW\Bundle\CoverLetterBundle\CoverLetterWriter\CoverLetterWriter;
use CLW\Bundle\CoverLetterBundle\CoverLetterWriter\SectionSelector;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CLW\Bundle\CoverLetterBundle\Form\Type\StepOne;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DefaultController extends Controller
{
    /*
    protected   $session;
    public function __constructor() {
        $session = new Session();
        $session->start();

    }*/

    public function indexAction() {
       $form = $this->createForm(new StepOne(), $task = NULL, array(
            'action' => $this->generateURL('clw_cover_letter_step_two'),
            'method' => 'POST',
        ));
        return $this->render('CLWCoverLetterBundle:Default:index.html.twig', array('form' => $form->createView(),));
    }

    public function stepTwoAction(Request $request){

        // if you define your forms as serivecs you wont have to instaiate them each time
        // instead you can do $this->get('NAME DEFINED IN confing.yml')
        $form = new StepOne();
        $formName = $form->getName();
        $params = $request->get($formName);

        $session = $request->getSession();
        $session->set('clwType', $params['type']);
        $session->set('clwIntials', $params['Intials']);
        $session->set('clwSurname', $params['Surname']);
        $session->set('clwTitle', $params['Title']);
        $session->set('clwDistributionMethod', $params['Distribution_Method']);
        $session->set('clwFormat', $params['Format']);
        $session->set('clwEnclosureLine', $params['Enclosure_line']);

        if($params['type'] == 'ar') {
            $formNew = $this->createForm(new stepTwoAdvert(), $task = NULL, array(
                'action' => $this->generateURL('clw_cover_letter_step_three'),
                'method' => 'POST',
            ));
        }elseif($params['type'] === 'pi') {
            $formNew = $this->createForm(new stepTwoPositionInquiry(), $task = NULL, array(
                'action' => $this->generateURL('clw_cover_letter_step_three'),
                'method' => 'POST',
            ));
        }elseif($params['type'] === 'pic') {
            $formNew = $this->createForm(new stepTwoPositionInquiryContact(), $task = NULL, array(
                'action' => $this->generateURL('clw_cover_letter_step_three'),
                'method' => 'POST',
            ));
        }elseif($params['type'] === 'ct') {
            $formNew = $this->createForm(new stepTwoContact(), $task = NULL, array(
                'action' => $this->generateURL('clw_cover_letter_step_three'),
                'method' => 'POST',
            ));
        }elseif($params['type'] === 'ns') {
            $formNew = $this->createForm(new stepTwoNotSure(), $task = NULL, array(
                'action' => $this->generateURL('clw_cover_letter_step_three'),
                'method' => 'POST',
            ));
        }

        return $this->render('CLWCoverLetterBundle:Default:stepTwo.html.twig', array('form' => $formNew->createView(),));
    }

    public function stepThreeAction(Request $request) {

        $session = $request->getSession();
        if($session->get('clwType') === 'ar') {
            $form = new stepTwoAdvert();
            $formName = $form->getName();

            $params = $request->get($formName);
            var_dump($params);
            $session->set('clwDate', $params['Date']);
            $session->set('clwPlaceAdvertSeen', $params['Place_Advert_Seen']);
            $session->set('clwCompanyName', $params['Company_Name']);
            $session->set('clwNameOfPosition', $params['Name_Of_Position_Applied_for']);
        }//need to add the rest for other options.

        $formNew = $this->createForm(new stepThree(), $task = NULL, array(
            'action' => $this->generateURL('clw_cover_letter_step_four'),
            'method' => 'POST',
        ));

        return $this->render('CLWCoverLetterBundle:Default:stepThree.html.twig', array('form' => $formNew->createView(),));
    }

    public function stepFourAction(Request $request) {
        $form = new stepThree();
        $formName = $form->getName();
        $params = $request->get($formName);

        $session = $request->getSession();
        $session->set('clwSkillSetOne', $params['Skill_set_one']);
        $session->set('clwSkillSetTwo', $params['Skill_set_two']);
        $session->set('clwSkillSetThree', $params['Skill_set_three']);

        $formNew = $this->createForm(new stepFour(), $task = NULL, array(
            'action' => $this->generateURL('clw_cover_letter_step_five'),
            'method' => 'POST',
        ));

        return $this->render('CLWCoverLetterBundle:Default:stepFour.html.twig', array('form' => $formNew->createView(),));
    }

    public function stepFiveAction(Request $request) {
        $form = new stepFour();
        $formName = $form->getName();
        $params = $request->get($formName);
        //you can do this instead §session $this->get('session')
        // the session is already injected as a service in all contorllers
        $session = $request->getSession();
        $session->set('clwRequireMatch', $params['requirements_match']);
        $session->set('clwRequirements', $params['Requirements']);
        //$session->set('clwSkillSetThree', $params['Skill_set_three']);

        $formNew = $this->createForm(new stepFive(), $task = NULL, array(
            'action' => $this->generateURL('clw_cover_letter_show_letter'),
            'method' => 'POST',
        ));

        return $this->render('CLWCoverLetterBundle:Default:stepFive.html.twig', array('form' => $formNew->createView(),));
    }

    public function showLetterAction(Request $request) {
        $sectionSelector = new SectionSelector();
        $writer = new CoverLetterWriter();
        $session = $request->getSession();
        $intro = $sectionSelector->introduction($session->get('clwType'));
        $paragraphNumber = $writer->selectParagraph($intro);

        //($intro[$paragraphNumber]);
        return $this->render('CLWCoverLetterBundle:Default:showLetter.html.twig');
    }

}