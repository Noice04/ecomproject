<?php

    namespace controllers;

    use models\Product;
    use views\ProductList;
    use views\ProductListCategory;

    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/products/productlist.php");
    require(dirname(__DIR__)."/resources/views/products/productlistcategory.php");

    class ProductController{

        private Products $product;

        public function read(){
            

            $product = new Product();
            $data = $product->read();
            $categories = $product->getCategories();
            (new ProductList())->render($data,$categories); 

        }
        public function create($data){
            $product = new Product();
            $proddata = $product->readByCategory($data['selectedcategory']);
            $category = $product->getCategoryName($data['selectedcategory']);
            (new ProductListCategory())->render($proddata,$category[0]['name'],$data['page'] ?? 0); 
        }


    }


?>