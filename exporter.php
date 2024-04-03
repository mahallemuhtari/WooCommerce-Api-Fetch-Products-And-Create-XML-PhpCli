<?php

function fetchProductsAndCreateXML($total_products, $site_link, $username, $password, $xml_file)
{

    $per_page = 1;

    $xml = new SimpleXMLElement('<products/>');

    $products_count = 0;

    while ($products_count < $total_products) {
        // Page Number
        $page = ceil($products_count / $per_page) + 1;

        $url = $site_link . '/wp-json/wc/v3/products';

        // Query Params
        $query_params = array(
            'status' => 'publish',
            'page' => $page,
            'per_page' => $per_page
        );

        // Add Params
        $url .= '?' . http_build_query($query_params);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $product_data = json_decode($response, true);

        if (!empty($product_data)) {
            // <product> single
            foreach ($product_data as $product) {
                // Terminal Msg
                echo $products_count . "- <3 SynexExporter - Added This Product : {$product['name']}\n";

                //Added Product Xml Element
                $product_node = $xml->addChild('product');
                $product_node->addChild('id', $product['id']);
                $product_node->addChild('name', $product['name']);
                $product_node->addChild('slug', $product['slug']);
                $product_node->addChild('date_created', $product['date_created']);
                $product_node->addChild('type', $product['type']);
                $product_node->addChild('status', $product['status']);
                $product_node->addChild('description', htmlspecialchars($product['description']));
                $product_node->addChild('price', $product['price']);
                $product_node->addChild('regular_price', $product['regular_price']);
                $product_node->addChild('sale_price', $product['sale_price']);
                $product_node->addChild('manage_stock', $product['manage_stock']);
                $product_node->addChild('stock_quantity', $product['stock_quantity']);

                // Added Categories
                $categories_node = $product_node->addChild('categories');
                foreach ($product['categories'] as $category) {
                    $category_node = $categories_node->addChild('category');
                    $category_node->addChild('id', $category['id']);
                    $category_node->addChild('name', $category['name']);
                    $category_node->addChild('slug', $category['slug']);
                }

                // Added Images
                $images_node = $product_node->addChild('images');
                foreach ($product['images'] as $image) {
                    $image_node = $images_node->addChild('image');
                    $image_node->addChild('id', $image['id']);
                    $image_node->addChild('src', $image['src']);
                    $image_node->addChild('name', $image['name']);
                    $image_node->addChild('alt', $image['alt']);
                }

                // Added Attributes
                if (isset($product['attributes'])) {
                    $attributes_node = $product_node->addChild('attributes');
                    foreach ($product['attributes'] as $attribute) {
                        $attribute_node = $attributes_node->addChild('attribute');
                        $attribute_node->addChild('name', $attribute['name']);
                        //Added in options
                        if (isset($attribute['options'])) {
                            $options_node = $attribute_node->addChild('options');
                            foreach ($attribute['options'] as $option) {
                                $options_node->addChild('option', $option);
                            }
                        }
                    }
                }

                // Variants Added
                if (!empty($product['variations'])) {
                    // Add in Xml Variant
                    $variations_node = $product_node->addChild('variations');
                    foreach ($product['variations'] as $variation_id) {

                        $variation_url = $site_link . "/wp-json/wc/v3/products/{$product['id']}/variations/{$variation_id}";

                        $ch_variation = curl_init();
                        curl_setopt($ch_variation, CURLOPT_URL, $variation_url);
                        curl_setopt($ch_variation, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch_variation, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch_variation, CURLOPT_USERPWD, "$username:$password");

                        $response_variation = curl_exec($ch_variation);

                        if (curl_errno($ch_variation)) {
                            echo 'Curl Error: ' . curl_error($ch_variation);
                        }

                        curl_close($ch_variation);

                        $variation_data = json_decode($response_variation, true);

                        // Added Variand Xml Elements
                        $variation_node = $variations_node->addChild('variation');
                        $variation_node->addChild('id', isset($variation_data['id']) ? $variation_data['id'] : '');
                        $variation_node->addChild('price', isset($variation_data['price']) ? $variation_data['price'] : '');
                        $variation_node->addChild('stock_quantity', isset($variation_data['stock_quantity']) ? $variation_data['stock_quantity'] : '');
                        $variation_node->addChild('image', isset($variation_data['image']['src']) ? $variation_data['image']['src'] : '');

                        // Added Variation_data Xml Elements
                        if (isset($variation_data['attributes'])) {
                            $attributes_node = $variation_node->addChild('attributes');
                            foreach ($variation_data['attributes'] as $attribute) {
                                $attribute_node = $attributes_node->addChild('attribute');
                                $attribute_node->addChild('name', $attribute['name']);
                                $attribute_node->addChild('option', $attribute['option']);
                            }
                        }
                    }
                }

                $products_count++;

                // if End
                if ($products_count >= $total_products) {
                    break 2;
                }
            }
        } else {
            echo "API is Empty.";
            break;
        }
    }

    file_put_contents($xml_file, $xml->asXML());

    echo "Xml Created: $xml_file\n";
}



$total_products = 10;   // Toplam Kaç Tane Ürün Çekilecek
$site_link = 'https://siteadi.com';  // Site Linki
$username = 'ck_dsafsdfsdfsdfsdfsdfdafsdfsdfsdfsdfsdfdafsdfsdfsd'; // Api Key  
$password = 'cs_5safsdfsdfsdfsdfsdfdafsdfsdfsdfsdfsdfdafsdfsdfsd';  // Api Secret
$xml_file = 'products'.time().rand(1,1548).'.xml';


fetchProductsAndCreateXML($total_products, $site_link, $username, $password, $xml_file);
);

?>
