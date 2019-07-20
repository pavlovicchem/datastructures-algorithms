<?php
/*
  Implemented operations:
    Inserting at the first node
    Inserting at the last node
    Inserting before a specific node
    Inserting after a specific node
    Deleting the first node
    Deleting the last node
    Searching for and deleting one node
    Displaying the list forward
    Displaying the list backward
*/

class ListNode
{
  public $data;
  public $prev = NULL;
  public $next = NULL;

  public function __construct(string $data)
  {
    $this->data = $data;
  }
}

class DoublyLinkedList
{
  private $_firstNode = NULL;
  private $_lastNode = NULL;
  private $_totalNodes = 0;

  // Inserting at the first node
  public function insertFirst(string $data)
  {
    $newNode = new ListNode($data);
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
  // Inserting at the last node
  public function insertLast(string $data)
  {
    $newNode = new ListNode($data);
    if($this->_firstNode === NULL){
      $this->_firstNode = $newNode;
      $this->_lastNode = $newNode;
    }else{
      $currentNode = $this->_lastNode;
      $currentNode->next = $newNode;
      $newNode->prev = $currentNode;
      $this->_lastNode = $newNode;
    }
    $this->_totalNodes++;
    return true;
  }
  // Inserting before a specific node
  public function insertBefore(string $data, string $query)
  {
    $newNode = new ListNode($data);
    if($this->_firstNode === NULL){
      throw new Exception("
      List is empty, it cannot be queried,
       in order to query, try filling it first
      ");
    }
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data === $query){
        $newNode->prev = $currentNode->prev;
        $newNode->next = $currentNode;
        ($currentNode->prev)->next = $newNode;
        $currentNode->prev = $newNode;
        $this->_totalNodes++;
        return true;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }

  // Inserting after a specific node
  public function insertAfter(string $data, string $query)
  {
    $newNode = new ListNode($data);
    if($this->_firstNode === NULL){
      throw new Exception("
      List is empty, it cannot be queried,
       in order to query, try filling it first
      ");
    }
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data === $query){
        $newNode->next = $currentNode->next;
        $newNode->prev = $currentNode;
        ($currentNode->next)->prev = $newNode;
        $currentNode->next = $newNode;
        $this->_totalNodes++;
        return true;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }
  // Deleting the first node
  public function deleteFirst()
  {
    if($this->_firstNode === NULL){
      throw new Exception(
        "List already empty, cannot delete from empty list"
      );
    }
    $newFirst = ($this->_firstNode)->next;
    $this->_firstNode = $newFirst;
    $newFirst->prev = NULL;
    $this->_totalNodes--;
    return true;
  }
  // Deleting the last node
  public function deleteLast()
  {
    if($this->_lastNode === NULL){
      throw new Exception(
        "List already empty, cannot delete from empty list"
      );
    }
    $newLast = ($this->_lastNode)->prev;
    $this->_lastNode = $newLast;
    $newLast->next = NULL;
    $this->_totalNodes--;
    return true;
  }
  // Searching for and deleting one node
  public function search(string $query)
  {
    if($this->_firstNode === NULL){
      throw new Exception("
      List is empty, it cannot be queried,
       in order to query, try filling it first
      ");
    }
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data === $query){
        return $currentNode->data;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }

  public function delete(string $query)
  {
    if($this->_firstNode === NULL){
      throw new Exception("
      List is empty, it cannot be queried for delete,
       in order to query and/or delete, try filling it first
      ");
    }
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data === $query){
        $afterNode = $currentNode->next;
        $beforeNode = $currentNode->prev;
        $beforeNode->next = $afterNode;
        $afterNode->prev = $beforeNode;
        $this->_totalNodes--;
        return true;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }
  // Returning list size
  public function getSize(): int
  {
    return $this->_totalNodes;
  }
  // Displaying the list forward
  public function displayForward()
  {
    if($this->_firstNode !== NULL){
      $currentNode = $this->_firstNode;
      while($currentNode !== NULL){
        echo $currentNode->data."\n";
        $currentNode = $currentNode->next;
      }
    }else{
        echo "List is empty";
    }
  }
  // Displaying the list backward
  public function displayBackward()
  {
    if($this->_lastNode !== NULL){
      $currentNode = $this->_lastNode;
      while($currentNode !== NULL){
        echo $currentNode->data."\n";
        $currentNode = $currentNode->prev;
      }
    }else{
        echo "List is empty";
    }
  }
}

/*
  Testing implementation
*/
$phpBooksList = new DoublyLinkedList();
try{
  $phpBooksList->insertBefore("PHP Glazami Hakera 2e","PHP Web Services and APIs");
}catch(Exception $e){
  echo $e->getMessage()."\n";
}
$phpBooksList->insertFirst("PHP Glazami Hakera 2e");
$phpBooksList->insertFirst("PHP Web Services and APIs");
$phpBooksList->insertLast("Practical PHP Testing");
$phpBooksList->insertLast("Yii2 By Example");
$phpBooksList->insertLast("Securing PHP Web Applications");
$phpBooksList->insertBefore("PHP Brilliance","Practical PHP Testing");
$phpBooksList->insertAfter("Yii Application Development 3ed","Practical PHP Testing");
echo "List has ".$phpBooksList->getSize()." books \n";
$phpBooksList->displayForward();
$phpBooksList->deleteFirst();
$phpBooksList->deleteLast();
$phpBooksList->delete("Practical PHP Testing");
echo "List has ".$phpBooksList->getSize()." books \n";
$phpBooksList->displayBackward();

?>
