<?php

interface Queue {
  public function enqueue(string $item);
  public function dequeue();
  public function peek();
  public function isEmpty();
}

class AgentNode
{
  public $data = NULL; // data that node will hold
  public $prev = NULL;
  public $next = NULL;

  public function __construct($data)
  {
    $this->data = $data;
  }
}

class AgentQueue implements Queue
{
  // DoublyLinkedList propreties
  protected $_firstNode = NULL;
  protected $_lastNode = NULL;
  protected $_totalNodes = 0;
  //Queue implementation properties
  private $limit;
  private $queue;

  public function __construct(int $limit = 20)
  {
    $this->limit = $limit;
    $this->queue = [];
  }
  /*
    Core linkedlist required methods
  */
  public function insertFirst(string $data)
  {
    $newNode = new AgentNode($data);
    if($this->_firstNode === NULL){
      $this->_firstNode = $newNode;
      $this->_lastNode = $newNode;
    }else{
      $currentNode = $this->_firstNode;
      $currentNode->prev = $newNode;
      $newNode->next = $currentNode;
      $this->_firstNode = $newNode;
    }
    $this->_totalNodes++;
    return true;
  }

  public function deleteLast()
  {
    if($this->_lastNode === NULL){
      throw new Exception(
        "List already empty, cannot delete from empty list"
      );
    }
    $value = $this->_lastNode->data;
    $newLast = ($this->_lastNode)->prev;
    $this->_lastNode = $newLast;
    $newLast->next = NULL;
    $this->_totalNodes--;
    return $value;
  }

  public function listSize() : int
  {
    return $this->_totalNodes;
  }

  public function getNthNode(int $n = 0) {
    $count = 1;
    if ($this->_firstNode !== NULL) {
      $currentNode = $this->_firstNode;
      while ($currentNode !== NULL) {
        if ($count === $n) {
          return $currentNode;
        }
        $count++;
        $currentNode = $currentNode->next;
      }
    }
  }
  /*
    Queue operations methods
  */
  public function enqueue(string $item)
  {
      if($this->listSize() < $this->limit){
        $this->insertFirst($item);
      }else {
        throw new OverflowException('Queue is full');
      }
  }
  public function dequeue()
  {
    if ($this->isEmpty()) {
      throw new UnderflowException('Queue is empty');
    } else {
      return $this->deleteLast();
    }
  }
  public function peek()
  {
    return ($this->_lastNode->data);
  }
  public function isEmpty()
  {
    return ($this->listSize() ? false : true);
  }
}

try {
   $agents = new AgentQueue(10);
   $agents->enqueue("Fred");
   $agents->enqueue("John");
   $agents->enqueue("Keith");
   $agents->enqueue("Adiyan");
   $agents->enqueue("Mikhael");
   echo $agents->dequeue()."\n";
   echo $agents->dequeue()."\n";
   echo $agents->peek()."\n";
} catch (Exception $e) {
  echo $e->getMessage();
}
 ?>
