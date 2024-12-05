<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(path: '/auth', name: 'app_')]
#[IsGranted('PUBLIC_ACCESS')]
class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

//    #[Route(path: '/test', name: 'test')]
//    public function test(): Response
//    {
//        $filePath = __DIR__ . '/../../data/UV_Product2.xlsx';
//        $spreadsheet = IOFactory::load($filePath);
//        $worksheet = $spreadsheet->getActiveSheet();
//
//        $data = [];
//        $first = true;
//
//        foreach ($worksheet->getRowIterator() as $row) {
//            if ($first) {
//                $first = false;
//                continue;
//            }
//
//            $rowData = [];
//            $rowData[] = $worksheet->getCell('B' . $row->getRowIndex())->getValue();
//            $rowData[] = $worksheet->getCell('C' . $row->getRowIndex())->getValue();
//            $rowData[] = $worksheet->getCell('J' . $row->getRowIndex())->getValue();
//            $rowData[] = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
//            $rowData[] = $worksheet->getCell('R' . $row->getRowIndex())->getValue();
//            $rowData[] = $worksheet->getCell('S' . $row->getRowIndex())->getValue();
//
//            $data[] = $rowData;
//        }
//
//        foreach ($data as $row) {
//            if (in_array(null, $row, true)) {
//                continue;
//            }
//
//            $item = new Item();
//            $item->setItemCode($row[0]);
//            $item->setItemName($row[1]);
//            $item->setItemPrice($row[2]);
//            $item->setItemCategoryId((int)$row[3]);
//            $item->setItemImage($row[4]);
//            $item->setItemDescription($row[5]);
//
////            $manager->persist($item);
//        }
//
//        $dataCat = [];
//        $first = true;
//
//        foreach ($worksheet->getRowIterator() as $row) {
//            if ($first) {
//                $first = false;
//                continue;
//            }
//
//            $columnE = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
//            var_dump($columnE);
//            die();
//            $columnD = $worksheet->getCell('D' . $row->getRowIndex())->getValue();
//
//            if ($columnE == 2) {
//                continue;
//            }
//
//            $existing = array_column($dataCat, 0);
//
//            if (!in_array($columnE, $existing, true)) {
//                $dataCat[] = [$columnE, $columnD];
//            }
//        }
//
//        foreach ($dataCat as $row) {
//            if (in_array(null, $row, true)) {
//                continue;
//            }
//
//            $category = new Category();
//            $category->setId($row[0]);
//            $category->setCategoryName($row[1]);
//
////            $manager->persist($category);
//        }
//        return $this->render('auth/login.html.twig');
//    }
}
