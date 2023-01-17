<?php

namespace FirstWeb\ManufacturerAddress\Classes;

class Repository
{
    public function getAll()
    {
        $sql = "SELECT * FROM manufacturers m LEFT JOIN fw_manufacturer_address ma ON m.manufacturers_id = ma.manufacturer_id";

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
