<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Stock;
use App\Entity\Table;
use App\Entity\TableOrder;
use App\Enums\OrderStatus;
use App\Enums\TableOrderStatus;
use App\Enums\TableStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Criação de Produtos
        $productsData = [
            ['category' => 'Bebidas', 'name' => 'Coca-Cola Lata', 'price' => 5.0, 'description' => 'Refrigerante Coca-Cola de 350ml', 'image' => 'https://andinacocacola.vtexassets.com/arquivos/ids/158244-800-450?v=638628901095270000&width=800&height=450&aspect=true'],
            ['category' => 'Bebidas', 'name' => 'Guaraná Lata', 'price' => 4.5, 'description' => 'Refrigerante Guaraná de 350ml', 'image' => 'https://savegnagoio.vtexassets.com/arquivos/ids/443350-800-450?v=638472488684900000&width=800&height=450&aspect=true'],
            ['category' => 'Comidas', 'name' => 'Hambúrguer', 'price' => 15.0, 'description' => 'Hambúrguer artesanal', 'image' => 'https://supermercadosrondon.com.br/guiadecarnes/images/postagens/quer_fazer_hamburger_artesanal_perfeito_2019-05-14.jpg'],
            ['category' => 'Comidas', 'name' => 'Batata Frita', 'price' => 8.0, 'description' => 'Porção de batata frita', 'image' => 'https://thumb-cdn.soluall.net/prod/shp_products/sp1280fw/259e9eb1-0e9e-48e8-81ec-527a409ed699/5822b377-9147-4db3-89bd-9c9a71cadb38.jpg'],
            ['category' => 'Sobremesas', 'name' => 'Sorvete', 'price' => 10.0, 'description' => 'Taça de sorvete de creme', 'image' => 'https://as2.ftcdn.net/v2/jpg/04/53/95/99/1000_F_453959951_2uhDs3sVsU4FkgkvrEAyqlC80LLexKp6.jpg']
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setCategory($data['category']);
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setImageUrl($data['image']);
            $product->setDescription($data['description']);

            $stock = new Stock();
            $stock->setProduct($product);
            $stock->setQuantity(rand(30, 100));
            $stock->setPurchasePrice($data['price'] * 0.4); // Considerando um markup de 60%
            $stock->setSalePrice($data['price']);
            $stock->setEntryDate(new \DateTime('now'));
            $stock->setExpirationDate(new \DateTime('+1 year'));

            $manager->persist($product);
            $manager->persist($stock);
        }

        // Criação de Mesas
        for ($i = 1; $i <= 10; $i++) {
            $table = new Table();
            $table->setNumber($i);
            $table->setCapacity(rand(2, 6));
            $table->setStatus(TableStatus::EMPTY);

            $manager->persist($table);
        }

        $manager->flush();

        // Criação de comandas
        for ($i = 1; $i <= 5; $i++) {
            $table = $manager->getRepository(Table::class)->findOneBy(['number' => $i]);
            $table->setStatus(TableStatus::OCCUPIED);

            $tableOrder = new TableOrder();
            $tableOrder->setOrderDate(new \DateTime('now'));
            $tableOrder->setOccupiedTable($table);

            $randomStatus = rand(1, 2) == 1 ? TableOrderStatus::ONGOING : TableOrderStatus::FINISHED;
            $table->setStatus($randomStatus == TableOrderStatus::ONGOING ? TableStatus::OCCUPIED : TableStatus::EMPTY);

            $tableOrder->setStatus($randomStatus);

            $manager->persist($table);
            $manager->persist($tableOrder);
            $manager->flush();

            // Criação de Pedidos para cada comanda
            $productsSize = count($productsData);
            $randomItems = array_rand($productsData, rand(1, $productsSize)); // Adjusted to ensure at least 1 item is selected

            $randomItems = (array)$randomItems;

            foreach ($randomItems as $key) {
                $data = $productsData[$key];

                $product = $manager->getRepository(Product::class)->findOneBy(['name' => $data['name']]);

                if ($product) {
                    $order = new Order();
                    $order->setTableOrder($tableOrder);
                    $order->setQuantity(rand(1, 5));
                    $order->setUnitValue($product->getPrice());
                    $order->setSubtotal($order->getQuantity() * $product->getPrice());
                    $order->setProduct($product);

                    if ($randomStatus == TableOrderStatus::FINISHED) {
                        $order->setStatus(OrderStatus::DELIVERED);
                    }

                    $manager->persist($order);
                }
            }
        }
    }
}
