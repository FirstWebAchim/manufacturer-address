<?php

use FirstWeb\ManufacturerAddress\Classes\Repository;

if (rth_is_module_disabled('MODULE_FW_MANUFACTURER_ADDRESS')) {
    return;
}

class FwManufacturerAddressProductEnd
{
    public function invoke($productData)
    {
        $repo = new Repository();
        $manufacturerId = (int) $productData['manufacturers_id'];
        $manufacturer = $repo->getManufacturerByManufacturerId($manufacturerId);

        $this->fillSmarty($manufacturer);
    }

    private function fillSmarty($manufacturer)
    {
        global $info_smarty;
        $smarty = new Smarty();
        $smarty->assign('manufacturer', $manufacturer);
        $fwManufacturerAddress = $smarty->fetch(CURRENT_TEMPLATE . '/module/fw_manufacturer_address.smarty');
        $info_smarty->assign('FW_MANUFACTURER_ADDRESS', $fwManufacturerAddress);
    }
}

$fwManufacturerAddressProductEnd = new FwManufacturerAddressProductEnd();
$fwManufacturerAddressProductEnd->invoke($product->data);
