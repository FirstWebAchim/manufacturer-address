<?php

declare(strict_types=1);

namespace FirstWeb\ManufacturerAddress\Classes;

use FirstWeb\ManufacturerAddress\Classes\Repository;
use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\HtmlView;

class Controller
{
    public const FILE_NAME = 'fw_manufacturer_address.php';
    public const SESSION_PREFIX = 'fw_manufacturer_address';
    public const TEMPLATE_PATH = '../vendor-no-composer/firstweb/ManufacturerAddress/Templates/';

    public function invoke(): void
    {
        $action = $_GET['fwAction'] ?? '';

        if ($action == 'save') {
            $this->invokeSave();
        } elseif ($action == 'getManufacturers') {
            $this->invokeGetManufacturers();
        } else {
            $this->invokeIndex();
        }
    }

    private function invokeIndex(): void
    {
        $page = new Page();
        $page->setHeading('Herstelleradressen by First-Web');
        $page->setSubHeading('Katalog');

        $htmlView = new HtmlView();
        $htmlView->loadHtml(self::TEMPLATE_PATH . 'Index.tmpl.php', [
            'controller' => $this,
        ]);
        $page->addComponent($htmlView);

        $page->render();
        die();
    }

    private function invokeGetManufacturers(): void
    {
        $repo = new Repository();
        $manufacturers = $repo->getAll();

        $this->echoJson($manufacturers);
    }

    private function invokeSave()
    {
        $manufacturers = $this->getArrayFromPost();

        $repo = new Repository();
        foreach ($manufacturers as $manufacturer) {
            if ($manufacturer['flag'] !== 'changed') {
                continue;
            }

            if (!$manufacturer['fwManufacturerAddress']['id']) {
                $repo->insertFwManufacturerAddress($manufacturer['fwManufacturerAddress']);
            } else {
                $repo->updateFwManufacturerAddress($manufacturer['fwManufacturerAddress']);
            }
        }
    }

    private function echoJson(array $array): void
    {
        header('Content-Type: application/json');
        echo \json_encode($array);
    }

    private function getArrayFromPost()
    {
        $json = file_get_contents('php://input');
        $array = \json_decode($json, true);
        return $array;
    }
}
