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
            ['category' => 'Bebidas', 'name' => 'Suco de Laranja', 'price' => 6.0, 'description' => 'Suco natural de laranja de 300ml', 'image' => 'https://cardapio.primeirobar.com.br/wp-content/uploads/2022/04/laranja.jpg'],
            ['category' => 'Bebidas', 'name' => 'Cerveja Long Neck', 'price' => 7.5, 'description' => 'Cerveja de 355ml', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuuBM5Aq8oCehllI-tjkZ_4Q49C4BjMKMWpQ&s'],

            ['category' => 'Comidas', 'name' => 'Hambúrguer', 'price' => 15.0, 'description' => 'Hambúrguer artesanal', 'image' => 'https://supermercadosrondon.com.br/guiadecarnes/images/postagens/quer_fazer_hamburger_artesanal_perfeito_2019-05-14.jpg'],
            ['category' => 'Comidas', 'name' => 'Batata Frita', 'price' => 8.0, 'description' => 'Porção de batata frita', 'image' => 'https://thumb-cdn.soluall.net/prod/shp_products/sp1280fw/259e9eb1-0e9e-48e8-81ec-527a409ed699/5822b377-9147-4db3-89bd-9c9a71cadb38.jpg'],
            ['category' => 'Comidas', 'name' => 'Pizza Marguerita', 'price' => 30.0, 'description' => 'Pizza de marguerita com molho de tomate, queijo e manjericão', 'image' => 'https://laticiniosbomdestino.com.br/2016/wp-content/uploads/2023/03/pizza-marguerita-com-mozzarella-de-bufala-bom-destino-scaled.jpg'],
            ['category' => 'Comidas', 'name' => 'Sushi Combo', 'price' => 50.0, 'description' => 'Combo com 15 peças de sushi variado', 'image' => 'https://anota.ai/bloganotaai/wp-content/uploads/sites/5/2020/08/Equipamentos-Para-Fazer-Sushi-1.jpg'],

            ['category' => 'Sobremesas', 'name' => 'Sorvete', 'price' => 10.0, 'description' => 'Taça de sorvete de creme', 'image' => 'https://as2.ftcdn.net/v2/jpg/04/53/95/99/1000_F_453959951_2uhDs3sVsU4FkgkvrEAyqlC80LLexKp6.jpg'],
            ['category' => 'Sobremesas', 'name' => 'Cheesecake', 'price' => 12.0, 'description' => 'Cheesecake com calda de frutas vermelhas', 'image' => 'https://www.receitasnestle.com.br/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/8fafc3935c766bf8c9f1331a325e48a9.jpg'],
            ['category' => 'Sobremesas', 'name' => 'Brownie', 'price' => 9.0, 'description' => 'Brownie de chocolate com nozes', 'image' => 'https://s2-receitas.glbimg.com/YYrJO2uFS4x0uHq-_fRmGbVG5m4=/0x0:275x183/924x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_e84042ef78cb4708aeebdf1c68c6cbd6/internal_photos/bs/2020/y/H/ZSIYRzRsmXIb73mnAP0Q/brownie-de-chocolate.jpg'],
            ['category' => 'Sobremesas', 'name' => 'Pudim', 'price' => 8.0, 'description' => 'Pudim de leite condensado', 'image' => 'https://s2-receitas.glbimg.com/Rk9SgtGOMV4--rt2mdDUXAI35z4=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_1f540e0b94d8437dbbc39d567a1dee68/internal_photos/bs/2023/z/0/RsipkzTEu0Y1PGiavCpA/pudim-de-leite-condensado.jpg'],

            ['category' => 'Snacks', 'name' => 'Chips de Batata', 'price' => 4.0, 'description' => 'Pacote de chips de batata crocante', 'image' => 'https://acdn.mitiendanube.com/stores/002/043/397/products/foto-chips-de-batata-tradicional1-4531dd71eecc7eeb2916451113922439-1024-1024.jpg'],
            ['category' => 'Snacks', 'name' => 'Amendoim Torrado', 'price' => 3.5, 'description' => 'Pacote de amendoim torrado e salgado', 'image' => 'https://www.receitasnestle.com.br/sites/default/files/srh_recipes/9cc2e90b6ee45c1aa5e4fe295d4c1b53.jpg'],
            ['category' => 'Snacks', 'name' => 'Chocolate', 'price' => 6.0, 'description' => 'Barra de chocolate ao leite', 'image' => 'https://cdn.awsli.com.br/600x700/1030/1030675/produto/226285342b909f9539e.jpg'],
            ['category' => 'Snacks', 'name' => 'Barrinha de Cereal', 'price' => 2.5, 'description' => 'Barrinha de cereal com mel e aveia', 'image' => 'https://emporio4estrelas.vtexassets.com/arquivos/ids/228002/Barrinha-Bold-Bar-Cookies-e-Cream-60g-Bold-Nutrition-ProEmbImagem-1519.jpg']
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
