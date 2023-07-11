<?php

require_once "models/FolderModel.php";
require_once "models/FileModel.php";
require_once "ValueMapper.php";
/**
 * The class use custom algorithm based on Breadth First Search technique for
 * searching in a specific structure of given XML to extract directory structure.
 */
class XmlDirectoryBfsParser {
    /**
     * @var SplQueue Used for tracking which node currently explored
     */
    private  $exploredNodes;

    /**
     * @var array Used for tracking visited node
     */
    private  $visited;

    /**
     * @var array The array indicated the structure of file system
     */
    private  $directoryStructure;

    /**
     * @var SimpleXMLElement The starting point for processing root node of graph directory structure
     */
    private  $rootNode;

    public function __construct(SimpleXMLElement $rootNode)
    {
        $this->rootNode = $rootNode;
        $this->exploredNodes = new SplQueue();
        $this->visited = array();
        $this->directoryStructure = array();
    }

    /**
     * The function use Breadth first search algorithm to process folder structure the existed in xml file
     * @return void
     */
    public function process(): void {

        $this->addRootDirectory();

        while (!$this->exploredNodes->isEmpty()){
            $parentNode = $this->exploredNodes->dequeue(); //current exploring node
            $parentNodeId = (string)$parentNode->attributes()->identifier;

            foreach ($parentNode->item as $childNode){
                $childNodeId = (string)$childNode->attributes()->identifier;
                if (!array_key_exists($childNodeId, $this->visited) ){
                    $this->visited[$childNodeId] =  $this->parseXmlNode($childNode, $parentNodeId);
                    $this->exploredNodes->enqueue($childNode);
                    $this->connectChildrenToParents($parentNodeId, $childNodeId);
                }
            }
        }
    }

    private function connectChildrenToParents(string $parentNodeId, string $childNodeId) : void {
        $parentFolder = &$this->visited[$parentNodeId];
        if($this->visited[$childNodeId] instanceof FolderModel) {
            $parentFolder->addToChildrenFolders($this->visited[$childNodeId]);
        }
        else {
            $parentFolder->addToChildrenFiles($this->visited[$childNodeId]);
        }
    }

    /**
     * @param SimpleXMLElement $xmlNode the processing xml element
     * @param string $parentId the parentFolderId
     * @return FileModel|FolderModel
     */
    private function parseXmlNode(SimpleXMLElement $xmlNode, string $parentId) {
        $identifierref = $xmlNode->attributes()->identifierref;

        if (is_null($identifierref) || empty((string)$identifierref)){
            $parsedNode = ValueMapper::convertToFolderModel($xmlNode,$parentId);
        }
        else {
            $parsedNode = ValueMapper::ConvertToFileModel($xmlNode,$parentId);
        }
        return $parsedNode;
    }

    /**
     * Add the directory base (root) level
     * @return void
     */
    private function addRootDirectory(): void {
        $parsedXmlNode = $this->parseXmlNode($this->rootNode, "root");
        $this->visited[$parsedXmlNode->getId()] = $parsedXmlNode;
        $this->exploredNodes->enqueue($this->rootNode);
        $this->directoryStructure[] = $parsedXmlNode;
    }

    public function getDirectoryStructure() : array{
        $this->process();
        return $this->directoryStructure;
    }


}