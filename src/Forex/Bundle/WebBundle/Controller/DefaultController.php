<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|fr"})
 */
class DefaultController extends CoreController
{
    /**
     * @Route("/", name="homepage", options={"sitemap" = true})
     */
    public function homepageAction()
    {
        $user = $this->getUser();

        $template = $this->get('security.context')->isGranted('ROLE_USER')
            ? 'ForexWebBundle:Homepage:homepage.auth.html.twig'
            : 'ForexWebBundle:Homepage:homepage.unauth.html.twig';

        return $this->render($template , array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/contact", name="contact", options={"sitemap" = true})
     * @Template
     */
    public function contactAction()
    {
        $form = $this->createContactForm();

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {

                $data = $form->getData();
                $this->getEmailManager()->sendToEmail('help@forexcashback.com', 'Help Form', 'Help:help-form', $data);
                $this->getEntityManager()->flush();

                $message = $this->getTranslatedKey('help.contact_email_success');
                $this->addMessage('success', $message);

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return array(
            'contactForm' => $form->createView(),
        );
    }

    /**
     * @Route("/referral-program", name="referral-program", options={"sitemap" = true})
     * @Template
     */
    public function referralAction()
    {
        return array();
    }

    /**
     * @Route("/promotions", name="promotions")
     * @Template
     */
    public function promotionsAction()
    {
        $promotions = $this->getRepository('ForexCoreBundle:Promotion')->findActive();

        return array(
            'promotions' => $promotions,
        );
    }
}
