<?php

abstract class Product
{
    protected $name;
    protected $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getId();
    abstract public function getName();
    abstract public function getPrice();
    abstract public function setId($id);
    abstract public function setName($name);
    abstract public function setPrice($price);
}
