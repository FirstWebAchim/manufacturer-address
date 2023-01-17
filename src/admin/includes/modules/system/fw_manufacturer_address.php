<?php

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

use RobinTheHood\ModifiedStdModule\Classes\StdModule;

class fw_manufacturer_address extends StdModule
{
    public function __construct()
    {
        $this->init('MODULE_FW_MANUFACTURER_ADDRESS');

        $this->checkForUpdate(true);
    }

    public function display()
    {
        return $this->displaySaveButton();
    }

    public function install()
    {
        parent::install();
        $this->setAdminAccess('fw_manufacturer_address');

        xtc_db_query(
            "CREATE TABLE `fw_manufacturer_address` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `manufacturer_id` int(11) DEFAULT NULL,
                `address` text DEFAULT NULL,
            PRIMARY KEY (`id`))
            DEFAULT CHARSET=utf8;"
        );
    }

    public function remove()
    {
        parent::remove();
        $this->deleteAdminAccess('fw_manufacturer_address');
    }
}
