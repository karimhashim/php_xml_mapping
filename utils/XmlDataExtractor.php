<?php

class XmlDataExtractor
{
    private array $organizations = [];
    private array $resources;
    public function __construct(SimpleXMLElement $xml)
    {

        foreach ($xml->organizations->organization as $org) {
            $this->organizations[] = new Organization($org);
        }

        foreach ($xml->resources->resource as $res) {
            $this->resources[(string)$res->attributes()->identifier] = new Resource($res);
        }
    }

    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    public function getResources(): array
    {
        return $this->resources;
    }
}


class Organization
{
    public string $identifier;
    public string $structure;
    public array $items = array();

    public function __construct($xml)
    {
        $this->identifier = $xml->attributes()->identifier;
        $this->structure = $xml->attributes()->structure;

        foreach ($xml->item as $item) {
            $this->items[] = new RootItem($item);
        }
    }

}

class RootItem
{
    public string $identifier;
    //public string $title;
    public array $item = array();

    public function __construct($xml)
    {
        $this->identifier = $xml->attributes()->identifier;

        foreach ($xml->item as $item) {
            $this->item[] = $item;

        }
    }
}



class Resource
{
    public string $identifier;
    public string $type;
    public string $href;

    public function __construct($xml)
    {
        $this->identifier = $xml->attributes()->identifier;
        $this->type = $xml->attributes()->type;
        $this->href = $xml->attributes()->href;
    }
}