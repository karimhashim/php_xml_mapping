<?php

class XmlDataExtractor
{
    private  $organizations = [];
    private  $resources;
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
    public  $identifier;
    public  $structure;
    public  $items = array();

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
    public  $identifier;
    //public string $title;
    public  $item = array();

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
    public  $identifier;
    public  $type;
    public  $href;

    public function __construct($xml)
    {
        $this->identifier = $xml->attributes()->identifier;
        $this->type = $xml->attributes()->type;
        $this->href = $xml->attributes()->href;
    }
}