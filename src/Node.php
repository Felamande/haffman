<?php

namespace cszchen\huffman;

class Node
{
    public $value;
    
    protected $leftChild;
    
    protected $rightChild;
    
    protected $parentNode;
    
    protected $code;
    
    public function __construct($value = 0)
    {
        $this->value = $value;
    }
    
    public function addChild(Node $leftNode, Node $rightNode)
    {
        $this->setLeftChild($leftNode);
        $this->setRightChild($rightNode);
        $this->value = $leftNode->value + $rightNode->value;
    }
    
    public function getCode()
    {
        return $this->parentNode ? $this->parentNode->getCode() . $this->code : $this->code;
    }
    
    public function getLeftChild()
    {
        return $this->leftChild;
    }
    
    public function getRightChild()
    {
        return $this->rightChild;
    }
    
    protected function setLeftChild(Node $node)
    {
        $this->leftChild = $node;
        $node->parentNode = $this;
        $node->code = 1;
        return $this;
    }
    
    protected function setRightChild(Node $node)
    {
        $this->rightChild = $node;
        $node->parentNode = $this;
        $node->code = 0;
        return $this;
    }
}
