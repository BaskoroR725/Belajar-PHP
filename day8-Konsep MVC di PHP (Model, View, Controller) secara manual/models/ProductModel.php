<?php
class ProductModel
{
    public function getAllProducts(): array
    {
        return [
            ['id' => 1, 'nama' => 'Keyboard', 'harga' => 250000],
            ['id' => 2, 'nama' => 'Mouse', 'harga' => 150000],
            ['id' => 3, 'nama' => 'Monitor', 'harga' => 1750000],
        ];
    }
}
