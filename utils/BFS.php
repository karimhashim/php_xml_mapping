<?php


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

    public function __construct()
    {
        $this->exploredNodes = new SplQueue();
        $this->visited = array();
    }


    public function search(RootItem $rootNode){
        $currentExploringNode = null; //SimpleXMLElement
        $rootFolder = $rootNode->item[0];
        //Add the first level of root node as initial nodes
        foreach ($rootFolder->item as $node){
            $nodeIdentifier = (string)$node->attributes()->identifier;
            $this->visited[$nodeIdentifier] = $node;
            $this->exploredNodes->enqueue($node);
        }
        while (!$this->exploredNodes->isEmpty()){
            $currentExploringNode = $this->exploredNodes->dequeue();
            foreach ($currentExploringNode->item as $node){
                $nodeIdentifier = (string)$node->attributes()->identifier;
                if (!array_key_exists($nodeIdentifier, $this->visited) ){
                    $this->visited[$nodeIdentifier] = $node;
                    $this->exploredNodes->enqueue($node);

                }
            }

        }

    }


}