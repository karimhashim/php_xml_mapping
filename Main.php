<?php

require_once "models/XmlDataModels.php";
require_once "utils/ValueMapper.php";

$xml = simplexml_load_file("assets/imsmanifest.xml");

$xmlData = new XmlDataModels($xml);



$material = array();

//currently there is only one organization, so we will not make list of materials
$organizationsList = $xmlData->getOrganizations();
foreach ($organizationsList as $org){
    foreach ($org->items[0]->items as $organizationFolder){
        $material[]= ValueMapper::CreateParentFoldersOfOrganization($organizationFolder);
    }
}

echo "ok";
//we need to map each item of parentFolder items to its associative type [Folder or File]




