<?php

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

$fwBoxName = [
    'de' => 'Hersteller Adressen (First-Web)',
    'en' => 'Manufacturer Addresses (First-Web)',
];
$fwLanguageCode = $_SESSION['language_code'] ?? '';
$fwSelectedBoxName = $fwBoxName[$fwLanguageCode] ?? $fwBoxName['de'];

$add_contents[BOX_HEADING_CATALOG][] = [
    'admin_access_name' => 'fw_manufactury_address',    // Eintrag fuer Adminrechte
    'filename' => 'fw_manufactury_address.php',         // Dateiname der neuen Admindatei
    'boxname' => $fwSelectedBoxName,                    // Anzeigename im Menue
    'parameters' => '',                                 // zusaetzliche Parameter z.B. 'set=export'
    'ssl' => ''                                         // SSL oder NONSSL, kein Eintrag = NONSSL
];
