<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $filePath = __DIR__ . '/../../data/UV_Product2.xlsx';
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $first = true;

        foreach ($worksheet->getRowIterator() as $row) {
            if ($first) {
                $first = false;
                continue;
            }

            $rowData = [];
            $rowData[] = $worksheet->getCell('B' . $row->getRowIndex())->getValue();
            $rowData[] = $worksheet->getCell('C' . $row->getRowIndex())->getValue();
            $rowData[] = $worksheet->getCell('J' . $row->getRowIndex())->getValue();
            $rowData[] = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
            $rowData[] = $worksheet->getCell('R' . $row->getRowIndex())->getValue();
            $rowData[] = $worksheet->getCell('S' . $row->getRowIndex())->getValue();

            $data[] = $rowData;
        }

        foreach ($data as $row) {
            if (in_array(null, $row, true)) {
                continue;
            }

            if ($row[3] == 2) {
                continue;
            }

            $item = new Item();
            $item->setItemCode($row[0]);
            $item->setItemName($row[1]);
            $item->setItemPrice($row[2]);
            $item->setItemCategoryId((int)$row[3]);
            $item->setItemImage($row[4]);
            $item->setItemDescription($row[5]);

            $manager->persist($item);
        }

        $dataCat = [];
        $first = true;

        foreach ($worksheet->getRowIterator() as $row) {
            if ($first) {
                $first = false;
                continue;
            }

            $columnE = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
            $columnD = $worksheet->getCell('D' . $row->getRowIndex())->getValue();

            if ($columnE == 2) {
                continue;
            }

            $existing = array_column($dataCat, 0);

            if (!in_array($columnE, $existing, true)) {
                $dataCat[] = [$columnE, $columnD];
            }
        }

        foreach ($dataCat as $row) {
            if (in_array(null, $row, true)) {
                continue;
            }

            $category = new Category();
            $category->setId($row[0]);
            $category->setCategoryName($row[1]);

            $manager->persist($category);
        }

        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('$2y$13$tP0AkqVmDq/by3xXk8tViOXInr8fjNe/.o/.rxmKoeASXK.dnYLZ6');
        $user->setRoles(['ROLE_ADMIN']);

        $user2 = new User();
        $user2->setUsername('user');
        $user2->setPassword('$2y$13$iUrmZpZDMiS9u.Fy3GzwNeWs6CvYp052po8YkHlKssMdwVgmnceJa');
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($user);
        $manager->persist($user2);

        $manager->flush();
    }
}
