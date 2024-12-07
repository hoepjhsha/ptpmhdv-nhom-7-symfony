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
    #[Route(path: '/', name: 'list', methods: ['GET'])]
    public function index(): Response
    {
        $items = $this->getJsonArray('http://dastonehdv.local' . $this->generateUrl('api_item_shop_list'));

        if (is_null($items)) {
            $this->addFlash('error', 'No products found in the system.');
        }

        return $this->render('shop/index.html.twig', [
            'page_title' => 'Product List',
            'items' => $items
        ]);
    }

    #[Route(path: '/product/{id}', name: 'view', methods: ['GET'])]
    public function viewProduct(int $id): Response
    {
        $item = $this->getJsonArray('http://dastonehdv.local' . $this->generateUrl('api_item_shop_view', ['id' => $id]));

        if (is_null($item)) {
            $this->addFlash('error', 'Product not found in the system.');
        }

        return $this->render('shop/view.html.twig', [
            'page_title' => 'Product Detail',
            'item' => $item
        ]);
    }

    /**
     * Function handle get data from API
     *
     * @param string $url
     *
     * @return mixed
     */
    private function getJsonArray(string $url): mixed
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: main_deauth_profile_token=74722a'
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response, true)['data'];

        curl_close($curl);

        return $response;
    }
}