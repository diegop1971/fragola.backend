<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

class ProductDTO
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $enabled;
    

    public function __construct($id, $name, $description, $price, $category_id, $category_name, $enabled)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->enabled = $enabled;
    }
}
