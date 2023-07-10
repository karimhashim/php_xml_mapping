<?php

require_once "models/XmlDataModels.php";
require_once "utils/ValueMapper.php";
require_once "utils/BFS.php";

$xml = simplexml_load_file("assets/imsmanifest.xml");

$xmlData = new XmlDataModels($xml);

$rootItem = $xmlData->getOrganizations()[0]->items[0];

$dfs = new BFS();

$dfs->search($rootItem);


echo "ok";




