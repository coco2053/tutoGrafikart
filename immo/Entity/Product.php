<?php

namespace App\Entity;

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $address;
    protected $city;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getCity()
    {
        return $this->city;
    }
}