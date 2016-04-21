<?php

namespace cszchen\haffman;

class Encoder
{
    protected $keys = [];
    
    protected $queues = [];
    
    protected $map = [];
    
    public function load($items)
    {
        if (arsort($items)) {
            foreach ($items as $key => $value) {
                $node = new Node($value);
                $this->keys[$key] = $node;
                $this->queues[] = $node;
            }
        }
    }
    
    public function encode()
    {
        $this->makeTree();
        foreach ($this->keys as $key => $node) {
            $this->map[$key] = $node->getCode();
        }
        return $this->map;
    }
    
    protected function makeTree()
    {
        if (count($this->queues) > 1) {
            $left = array_pop($this->queues);
            $right = array_pop($this->queues);
            $node = new Node;
            $node->addChild($left, $right);
            $this->joinNode($node);
            $this->makeTree();
        }
    }
    
    /**
     * add a node to queues
     * @param Node $node
     */
    protected function joinNode(Node $node)
    {
        $len = count($this->queues);
        for ($i = 0; $i < $len; $i++) {
            if ($this->queues[$i]->value <= $node->value) {
                array_splice($this->queues, $i, 0, [$node]);
                break;
            }
        }
    }
}
