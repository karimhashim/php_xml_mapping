<?php

require_once "utils/XmlDataExtractor.php";
require_once "utils/ValueMapper.php";
require_once "utils/XmlDirectoryBfsParser.php";

$xml = simplexml_load_file("assets/imsmanifest.xml");

$xmlData = new XmlDataExtractor($xml);

$rootItem = $xmlData->getOrganizations()[0]->items[0]->item[0];

$xmlDirectoryBfsParser = new XmlDirectoryBfsParser($rootItem);

$directoryStructure =  $xmlDirectoryBfsParser->getDirectoryStructure();

print_r($directoryStructure);

echo "ok";




