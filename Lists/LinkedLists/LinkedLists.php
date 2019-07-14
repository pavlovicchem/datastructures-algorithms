<?php
/*
Single Linked List - implemented next functionalities:

Inserting at the first node
Inserting at the last node
Searching for a node
Inserting before a specific node
Inserting after a specific node
Deleting the first node
Deleting the last node
Searching for and deleting one node
Reversing a linked list
Getting Nth position element
Retruning Size of List
Displaying nodes(items) in List
*/
class ListNode
{
  public $data = NULL; // data that node will hold
  public $next = NULL; // pointer to next node, if NULL its the END-node

  public function __construct($data)
  {
    $this->data = $data;
  }
}

class LinkedList
{
  protected $_firstNode = NULL;
  protected $_totalNodes = 0;
  // O(1) time complexity
  public function insertFirst(string $data): bool
  {
    $newNode = new ListNode($data);
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
  // O(N) time complexity
  public function insertLast(string $data): bool
  {
    $newNode = new ListNode($data);
    if($this->_firstNode === NULL){
      $this->_firstNode = &$newNode;
    }else{
      $currentNode = $this->_firstNode;
      while($currentNode->next !== NULL){
        $currentNode = $currentNode->next;
      }
      $currentNode->next = $newNode;
      $this->_totalNodes++;
      return true;
    }
  }

  public function insertBefore(string $data, string $query)
  {
    $newNode = new ListNode($data);
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->next->data === $query){
        $afterNode = $currentNode->next;
        $beforeNode = $currentNode;
        $beforeNode->next = $newNode;
        $newNode->next = $afterNode;
        $this->_totalNodes++;
        return true;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }

  public function insertAfter(string $data, string $query)
  {
    $newNode = new ListNode($data);
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data === $query){
        $afterNode = $currentNode->next;
        $beforeNode = $currentNode;
        $beforeNode->next = $newNode;
        $newNode->next = $afterNode;
        $this->_totalNodes++;
        return true;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }
  // Deleting the first node O(1) time complexity
  public function deleteFirst(): bool
  {
    if($this->_firstNode !== NULL){
      if($this->_firstNode->next !== NULL){
        $this->_firstNode = $this->_firstNode->next;
      }else{
        $this->_firstNode = NULL;
      }
      $this->_totalNodes--;
      return true;
    }
    return false;
  }

  // Deleting the last node O(N) time complexity
  public function deleteLast(): bool
  {
    if($this->_firstNode !== NULL){
      $currentNode = $this->_firstNode;
      while($currentNode->next !== NULL){
        $beforeNode = $currentNode;
        $currentNode = $currentNode->next;
      }
      $beforeNode->next = NULL;
      $this->_totalNodes--;
      return true;
    }
    return false;
  }
  // Searching for and deleting one node O(N) time complexity
  public function delete(string $query): bool
  {
    $currentNode = $this->_firstNode;
    if($currentNode->data === $query){
      $this->_firstNode = $currentNode->next;
      $this->_totalNodes--;
      return true;
    }else{
      while($currentNode->next !== NULL){
        $beforeNode = $currentNode;
        $currentNode = $currentNode->next;
        if($currentNode->data == $query){
            $currentNode = $currentNode->next;
            $beforeNode->next =$currentNode;
            $this->_totalNodes--;
            return true;
        }
      }
    }
    return false;
  }
  // Reversing a linked list
  public function reverse()
  {
    if($this->_totalNodes < 2){
      return false;
    }
    $nextNode = $this->_firstNode->next;
    $lastNode = $this->_firstNode;
    $lastNode->next = NULL;
    while($nextNode->next !== NULL){
      $tempNode = $nextNode->next;
      $nextNode->next = $lastNode;
      $lastNode = $nextNode;
      $nextNode = $tempNode;
    }
    $this->_firstNode = $nextNode;
    $nextNode->next = $lastNode;
    return true;

  }
  // Getting Nth position element
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
  // Retruning Size of List
  public function listSize() : int
  {
    return $this->_totalNodes;
  }

  public function display()
  {
    if($this->_totalNodes === 0)
    {
      return "List is empty";
    }
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      echo  $currentNode->data."\n";
      $currentNode = $currentNode->next;
    }
  }
  // O(N) time complexity for search operation
  public function search(string $query)
  {
    $currentNode = $this->_firstNode;
    while($currentNode !== NULL){
      if($currentNode->data == $query){
        return $currentNode;
      }
      $currentNode = $currentNode->next;
    }
    return false;
  }
}

// Testing implemented operations
$phpBooksList = new LinkedList();
$phpBooksList->insertFirst("Mastering PHP 7");
$phpBooksList->insertFirst("Pro PHP 7");
$phpBooksList->insertFirst("Datastructures and algorithms in php 7");
$phpBooksList->insertFirst("High Performance PHP 7");
$phpBooksList->insertLast("Design Patterns PHP 7");
$phpBooksList->insertLast("PHP Unit Book");
$phpBooksList->insertBefore("Persistence in PHP 7", "Pro PHP 7");
$phpBooksList->insertAfter("Cake PHP Cookbook", "Pro PHP 7");
echo "List has ".$phpBooksList->listSize()." books \n";
$phpBooksList->display();
$phpBooksList->reverse();
echo "List has ".$phpBooksList->listSize()." books \n";
$phpBooksList->display();
if($phpBooksList->search("Pro PHP 7")){
  echo "Item found!\n";
}else{
  echo "Not found!\n";
}
$phpBooksList->deleteFirst();
$phpBooksList->deleteLast();
$phpBooksList->delete("Pro PHP 7");
$phpBooksList->delete("Datastructures and algorithms in php 7");
$phpBooksList->delete("Mastering PHP 7");
echo "List has ".$phpBooksList->listSize()." books \n";
$phpBooksList->display();


 ?>
