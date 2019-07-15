<?php

/**
 * Stack interface to implement on class
 */
interface Stack
{
  public function push(string $data);
  public function pop():string;
  public function peek():string;
  public function isEmpty():bool;
}


class Books implements Stack
{
  private $limit;
  private $stack;

  public function __construct(int $limit = 20)
  {
    $this->limit = $limit;
    $this->stack = [];
  }

  public function push(string $data)
  {
    if(count($this->stack) < $this->limit){
      array_push($this->stack, $data);
    }else{
      throw new OverflowException("Stack is full");
    }
  }

  public function pop():string
  {
    if ($this->isEmpty()) {
        throw new UnderflowException('Stack is empty');
    } else {
        return array_pop($this->stack);
    }
  }

  public function peek():string
  {
    if ($this->isEmpty()) {
        throw new UnderflowException('Stack is empty');
    } else {
        return end($this->stack);
    }
  }
  public function isEmpty(): bool
  {
    return empty($this->stack);
  }
}

/*
  Testing implemented Stack interface functionality
*/
try {
  $programmingBooks = new Books(10);
  $programmingBooks->push("Introduction to PHP7");
  $programmingBooks->push("Mastering JavaScript");
  $programmingBooks->push("MySQL Workbench tutorial");
  echo $programmingBooks->pop()."\n";
  echo $programmingBooks->peek()."\n";
} catch (Exception $e) {
  echo $e->getMessage();
}


 ?>
