<?php

declare(strict_types=1);

namespace FirstWeb\ManufacturerAddress\Classes;

use RobinTheHood\ModifiedStdModule\Classes\StdController;
use FirstWeb\ManufacturerAddress\Classes\Repository;

class ApiController extends StdController
{
    protected function invokeGetManufacturers(): void
    {
        $repo = new Repository();
        $manufacturers = $repo->getAll();

        $this->echoJson($manufacturers);
    }

    protected function invokeSave()
    {
        $manufacturers = $this->getArrayFromJsonPost();

        $repo = new Repository();
        foreach ($manufacturers as $manufacturer) {
            if ($manufacturer['flag'] !== 'changed') {
                continue;
            }

            $fwManfacturerAddress = $repo->getFwManufacturerAddressByManufacturerId((int) $manufacturer['id']);
            if (!$fwManfacturerAddress) {
                $repo->insertFwManufacturerAddress($manufacturer['fwManufacturerAddress']);
            } else {
                $repo->updateFwManufacturerAddress($manufacturer['fwManufacturerAddress']);
            }
        }
    }
}
