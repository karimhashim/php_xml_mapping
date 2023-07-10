<?php

require_once "models/FolderModel.php";
require_once "models/FileModel.php";
require_once "ValueMapper.php";
/**
 * Custom algorithm based on Breadth First Search Algorithm for
 * searching in a specific structure of given XML to extract folder structure.
 */
class BFS {
    /**
     * @var RootItem The root node which is considered the starting point
     */
    private RootItem $rootNode;
    /**
     * @var SplQueue Used for tracking which node currently explored
     */
    private SplQueue $exploredNodes;

    /**
     * @var array Used for tracking visited node
     */
    private array $visited;

    /**
     * @var array The array indicated the structure of file system
     */
    private array $directoryStructure;

    public function __construct()
    {
        $this->exploredNodes = new SplQueue();
        $this->visited = array();
        $this->directoryStructure = array();
    }


    public function search(RootItem $rootNode){
        $currentExploringNode = null; //SimpleXMLElement
        $rootFolder = $rootNode->item[0];
        //Add the first level of root node as initial nodes
        foreach ($rootFolder->item as $node){
            $parsedXmlNode = $this->parseXmlNode($node);
            $this->visited[$parsedXmlNode->getId()] = $parsedXmlNode;
            $this->exploredNodes->enqueue($node);
            $this->directoryStructure[] = $parsedXmlNode; // add the first (base) level of root folder
        }
        while (!$this->exploredNodes->isEmpty()){
            $currentExploringNode = $this->exploredNodes->dequeue(); //1
            foreach ($currentExploringNode->item as $node){
                $childNodeIdentifier = (string)$node->attributes()->identifier;
                if (!array_key_exists($childNodeIdentifier, $this->visited) ){
                    $this->visited[$childNodeIdentifier] =  $this->parseXmlNode($node,$currentExploringNode->attributes()->identifier);
                    $this->exploredNodes->enqueue($node);
                    $parentFolder = &$this->visited[(string)$currentExploringNode->attributes()->identifier];
                    if($this->visited[$childNodeIdentifier] instanceof FolderModel) {
                        $parentFolder->addToChildrenFolders($this->visited[$childNodeIdentifier]);
                    }
                    else {
                        $parentFolder->addToChildrenFiles($this->visited[$childNodeIdentifier]);
                    }
                }
            }
        }
    }

    private function parseXmlNode(SimpleXMLElement $xmlNode, string $parentId = ""){
        $parsedNode = null;
        $identifierref = $xmlNode->attributes()->identifierref;

        if (is_null($identifierref) || empty((string)$identifierref)){
            $parsedNode = ValueMapper::convertToFolderModel($xmlNode,$parentId);
        }
        else {
            $parsedNode = ValueMapper::ConvertToFileModel($xmlNode,$parentId);
        }
        return $parsedNode;
    }

    public function getDirectoryStructure() : array{
        return $this->directoryStructure;
    }


}