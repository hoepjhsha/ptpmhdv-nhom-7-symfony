<?php
/**
 * @project ptpmhdv-nhom-7-symfony
 * @author hoepjhsha
 * @email hiepnguyen3624@gmail.com
 * @date 07/12/2024
 * @time 06:03
 */

namespace App\Controller\Shop;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/shop', name: 'shop_')]
#[IsGranted('PUBLIC_ACCESS')]
class ShopController extends BaseController
{
    #[Route(path: '', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig');
    }
}