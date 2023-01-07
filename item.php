<?php
class Item {
    public $id;
    public $name;
    public $price;
    public $description;
    public $image;

    public function __construct($item)
    {
        $this->id = $item['item_id'];
        $this->name = $item['item_name'];
        $this->price = $item['item_price'];
        $this->description = $item['item_text'];
        $this->image = $item['item_image'];
    }

    public function __destruct()
    {
        $this->id = null;
        $this->name = null;
        $this->price = null;
        $this->description = null;
        $this->image = null;
    }
}

?>