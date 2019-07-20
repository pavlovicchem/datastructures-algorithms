<?php

interface PriorityQueue {
  public function enqueue(string $item, int $priority);
  public function dequeue();
  public function peek();
  public function isEmpty();
}

class TaskNode
{
  public $data = NULL;
  public $next = NULL;
  public $prev = NULL;
  public $priority = NULL;

  public function __construct(string $data, int $priority = 1)
  {
    $this->data = $data;
    $this->priority = $priority;
  }
}

class TaskQueue implements PriorityQueue
{
  // DoublyLinkedList propreties
  protected $_firstNode = NULL;
  protected $_lastNode = NULL;
  protected $_totalNodes = 0;
  //Queue implementation properties
  private $limit;

  public function __construct(int $limit = 20)
  {
    $this->limit = $limit;
  }
  /*
    Core linkedlist required methods
  */
  public function insert(string $data, int $priority)
  {
    $newNode = new TaskNode($data, $priority);
    if($this->_totalNodes === 0){
      $this->_firstNode = $newNode;
      $this->_lastNode = $newNode;
    }elseif($priority === 1){
      $firstNode = $this->_firstNode;
      $firstNode->prev = $newNode;
      $newNode->next = $firstNode;
      $this->_firstNode = $newNode;
    }else{
      $currentNode = $this->_firstNode;
      while(($currentNode->priority) < $priority &&
      ($currentNode->next !== NULL)){
        $currentNode = $currentNode->next;
      }
      $afterNode = $currentNode->next;
      if($afterNode === NULL){
        $newNode->next = NULL;
        $newNode->prev = $currentNode;
        $currentNode->next = $newNode;
      }else{
        $newNode->prev = $currentNode;
        $newNode->next = $afterNode;
        $afterNode->prev = $newNode;
        $currentNode->next = $newNode;
      }

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
    if(($this->_lastNode->prev) !== NULL){
      $newLast = ($this->_lastNode)->prev;
      $this->_lastNode = $newLast;
      $newLast->next = NULL;
    }else{
      $this->_lastNode = NULL;
      $this->_firstNode = NULL;
    }
    $this->_totalNodes--;
    return $value;
  }

  public function listSize() : int
  {
    return $this->_totalNodes;
  }

  public function displayForward()
  {
    if($this->_firstNode !== NULL){
      $currentNode = $this->_firstNode;
      while($currentNode !== NULL){
        echo $currentNode->data." with priority: ".$currentNode->priority."\n";
        $currentNode = $currentNode->next;
      }
    }else{
        echo "List is empty";
    }
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
  public function enqueue(string $item, int $priority)
  {
      if($this->listSize() < $this->limit){
        $this->insert($item, $priority);
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


/*
  Testing implementation
*/
try {
  $tasks = new TaskQueue(10);
  $tasks->enqueue("Task1", 1);
  $tasks->enqueue("Task2", 2);
  $tasks->enqueue("Task3", 3);
  $tasks->enqueue("Task4", 4);
  $tasks->enqueue("Task5", 2);
  $tasks->displayForward();
  echo $tasks->dequeue()."\n";
  echo $tasks->dequeue()."\n";
} catch (Exception $e) {
  echo $e->getMessage();
}

 ?>
