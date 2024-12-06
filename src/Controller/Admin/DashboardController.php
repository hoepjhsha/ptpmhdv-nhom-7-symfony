<?php
/**
 * @project ptpmhdv-nhom-7-symfony
 * @author hoepjhsha
 * @email hiepnguyen3624@gmail.com
 * @date 06/12/2024
 * @time 05:46
 */

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/admin', name: 'admin_')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends BaseController
{
    #[Route(path: '/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'page_title' => 'Dashboard'
        ]);
    }
}