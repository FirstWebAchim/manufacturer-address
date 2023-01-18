<?php

declare(strict_types=1);

namespace FirstWeb\ManufacturerAddress\Classes;

class Repository
{
    public function getAll()
    {
        $sql = "SELECT * FROM manufacturers m LEFT JOIN fw_manufacturer_address ma ON m.manufacturers_id = ma.manufacturer_id ORDER BY m.manufacturers_name";

        $query = xtc_db_query($sql);
        $manufacturers = [];
        while ($row = xtc_db_fetch_array($query)) {
            $manufacturers[] = [
                'id' => $row['manufacturers_id'],
                'name' => $row['manufacturers_name'],
                'fwManufacturerAddress' => [
                    'id' => $row['id'],
                    'manufacturerId' => $row['manufacturers_id'],
                    'address' => $row['address']
                ]
            ];
        }
        return $manufacturers;
    }

    public function getFwManufacturerAddressByManufacturerId(int $manufacturerId)
    {
        $sql = "SELECT * FROM fw_manufacturer_address WHERE manufacturer_id = $manufacturerId";
        $query = xtc_db_query($sql);
        return xtc_db_fetch_array($query);
    }

    public function insertFwManufacturerAddress($fwManufacturerAddress)
    {
        $manufacturerId = $fwManufacturerAddress['manufacturerId'];
        $address = $fwManufacturerAddress['address'];

        $sql = "INSERT INTO fw_manufacturer_address 
                    (manufacturer_id, address) 
                VALUES 
                    ('$manufacturerId', '$address')";

        $query = xtc_db_query($sql);
        return xtc_db_insert_id();
    }

    public function updateFwManufacturerAddress($fwManufacturerAddress)
    {
        $id = $fwManufacturerAddress['id'];
        $address = $fwManufacturerAddress['address'];

        $sql = "UPDATE fw_manufacturer_address
                SET address = '$address'
                WHERE id = $id";

        $query = xtc_db_query($sql);
    }
}
