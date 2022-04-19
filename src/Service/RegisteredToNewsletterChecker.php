<?php

namespace App\Service;

use App\Entity\NewsLetterUser;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\Security\Core\Security;

class RegisteredToNewsletterChecker
{

    private $em;
    private $security;

    public function __construct(EntityManager $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    function check()
    {
        $user = $this->security->getUser();
        if($user) {
            $newsletterUser = $this->em->getRepository(NewsLetterUser::class)->findOneBy(['user_id' => $user]);

            if($newsletterUser) {
                return true;
            }
        }

        return false;

    }

}