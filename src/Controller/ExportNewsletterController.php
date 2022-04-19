<?php

namespace App\Controller;

use App\Repository\NewsLetterUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Doctrine\ORM\EntityManagerInterface;
use SymfonyComponentHttpFoundationStreamedResponse;

use App\Entity\NewsLetterUser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportNewsletterController extends AbstractController
{
     /**
     * @var EntityManagerInterface
     */

    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }


    private function getData(): array
    {
        /**
         * @var $user User[]
         */
        $list = [];
        $newsletterUsersregistred = $this->entityManager->getRepository(NewsLetterUser::class)->findAll();

        foreach ($newsletterUsersregistred as $user) {
            $list[] = [
                $user->getNom(),
                $user->getPrenom(),
                $user->getMail(),
                $user->getVille(),
                $user->getCodePostal(),
            ];
        }
        return $list;
    }

    /**
     * @Route("/export/newsletter", name="newsletter_data")
     */
    public function exportPage(NewsLetterUserRepository $NewsLetterUserRepository):Response
    {

         $newsletterUser = $NewsLetterUserRepository->findAll();

         return $this->render('newsletter/data.html.twig' , [
             'newsletterUsers' => $newsletterUser
         ]);

    }


    /********************************************autre essai************************************************/ 
     
    /**
     * @Route("/export/newsletter/XLS",  name="export")
     */
        public function exportXLSAction()
        {
            $results = $this->getDoctrine()->getManager()
                ->getRepository(NewsLetterUser::class)->findAll();
    
            $response = new StreamedResponse();
            $response->setCallback(
                function () use ($results) {
                    $handle = fopen('php://output', 'r+');
                    foreach ($results as $row) {
                        //array list fields you need to export
                        $data = array(
                            $row->getId(),
                            $row->getNom(),
                            $row->getPrenom(),
                            $row->getMail(),
                            $row->getVille(),
                            $row->getCodePostal(),
                        );
                        fputcsv($handle, $data);
                    }
                    fclose($handle);
                }
            );
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-Disposition', 'attachment; filename="export.xls"');
    
            return $response;
        }
}
