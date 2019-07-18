

class ListNode():

    def __init__(self, data):
        self.data = data
        self.next = None


class LinkedList():

    def __init__(self):
        self._firstNode = None
        self._totalNodes = 0

    def insertFirst(self, data):
        newNode = ListNode(data)
        if not self._firstNode:
            self._firstNode = newNode
        else:
            newNode.next = self._firstNode
            self._firstNode = newNode
        self._totalNodes+=1

    def size(self):
        return self._totalNodes

    def getNthElement(self, n):
        count = 1
        if n > self.size():
            raise ValueError("""
            Cannot seek for number of element greater than
            the number of total elements in the list
            """)
        currentNode = self._firstNode
        while count != n:
            count+=1
            currentNode = currentNode.next
        return currentNode.data

    def insertLast(self, data):
        newNode = ListNode(data)
        if not self._firstNode:
            self._firstNode = newNode
        else:
            currentNode = self._firstNode
            while currentNode.next:
                currentNode = currentNode.next
            currentNode.next = newNode
        self._totalNodes+=1

    def traverseList(self):
        currentNode = self._firstNode
        while currentNode is not None:
            print(currentNode.data)
            currentNode = currentNode.next

    def remove(self, query):
        if self._firstNode is None:
            return False
        else:
            currentNode = self._firstNode
            previousNode = None
            while currentNode.data != query:
                previousNode = currentNode
                currentNode = currentNode.next
                if currentNode.data == query:
                    previousNode.next = currentNode.next
                    self._totalNodes-=1
                    return True
        return False


taskList = LinkedList()
taskList.insertFirst("Task0")
taskList.insertFirst("Task1")
taskList.insertFirst("Task2")
taskList.insertLast("Task3")
taskList.insertLast("Task4")
try:
    taskList.traverseList()
    print(taskList.remove("Task3"))
    taskList.traverseList()
    print(taskList.getNthElement(6))
except ValueError:
    print("""
    Cannot seek for number of element greater than
    the number of total elements in the list
    """)
