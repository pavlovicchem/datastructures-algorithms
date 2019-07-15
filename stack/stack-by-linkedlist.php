<?php


/**
 * Stack interface to implement on BookList class
 */
interface Stack
{
  public function push(string $data);
  public function pop():string;
  public function peek():string;
  public function isEmpty():bool;
}

class BookNode
{
  public $data = NULL; // data that node will hold
  public $next = NULL; // pointer to next node, if NULL its the END-node

  public function __construct($data)
  {
    $this->data = $data;
  }
}

class BookList implements Stack
{
  protected $_firstNode = NULL;
  protected $_totalNodes = 0;
  protected $_limit;


  /*
    Implemented LinkedList methods required by stack operations
  */
  public function __construct(int $limit = 20)
  {
    $this->limit = $limit;
  }

  public function insertFirst(string $data): bool
  {
    $newNode = new BookNode($data);
    if($this->_firstNode === NULL){
      $this->_firstNode = &$newNode;
    }else{
      $nextNode = $this->_firstNode;
      $this->_firstNode = $newNode;
      $this->_firstNode->next = $nextNode;
    }
    $this->_totalNodes++;
    return true;
  }

  public function listSize() : int
  {
    return $this->_totalNodes;
  }

  public function deleteFirst()
  {
    if($this->_firstNode !== NULL){
      $firstNode = $this->_firstNode;
      if($this->_firstNode->next !== NULL){
        $this->_firstNode = $this->_firstNode->next;
      }else{
        $this->_firstNode = NULL;
      }
      $this->_totalNodes--;
      return $firstNode->data;
    }
    return false;
  }

  /*
    Stack operation methods implementation
  */
  public function push(string $data)
  {
    if($this->_totalNodes < $this->limit){
       $this->insertFirst($data);
    }else{
      throw new OverflowException("Stack is full");
    }
  }

  public function pop():string
  {
    if ($this->isEmpty()) {
        throw new UnderflowException('Stack is empty');
    } else {
        return $this->deleteFirst();
    }
  }

  public function peek():string
  {
    if ($this->isEmpty()) {
        throw new UnderflowException('Stack is empty');
    } else {
        return $this->_firstNode->data;
    }
  }
  public function isEmpty(): bool
  {
    return ($this->_totalNodes ? false : true);
  }
}

/*
  Testing implemented Stack interface functionality
*/
try {
  $programmingBooks = new BookList(10);
  $programmingBooks->push("Introduction to PHP7");
  $programmingBooks->push("Mastering JavaScript");
  $programmingBooks->push("MySQL Workbench tutorial");
  echo $programmingBooks->pop()."\n";
  echo $programmingBooks->peek()."\n";
} catch (Exception $e) {
  echo $e->getMessage();
}
 ?>
