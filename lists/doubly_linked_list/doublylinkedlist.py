

class ListNode:
    def __init__(self,data):
        self.data = data
        self.next = None
        self.prev = None


class DoublyLinkedList:
    def __init__(self):
        self._first_node = None
        self._last_node = None
        self._total_nodes = 0

    def insert_first(self, data):
        new_node = ListNode(data)
        if not self._first_node:
            self._first_node = new_node
            self._last_node = new_node
        else:
            self._first_node.prev = new_node
            new_node.next = self._first_node
            self._first_node = new_node
        self._total_nodes += 1
        return True

    def insert_last(self, data):
        new_node = ListNode(data)
        if not self._last_node:
            self._first_node = new_node
            self._last_node = new_node
        else:
            self._last_node.next = new_node
            new_node.prev = self._last_node
            self._last_node = new_node
        self._total_nodes += 1
        return True

    def get_nth_element(self, n):
        count = 1
        if n > self.size():
            raise ValueError("""
            Cannot seek for number of element greater than
            the number of total elements in the list
            """)
        current_node = self._first_node
        while count != n:
            count+=1
            current_node = current_node.next
        return current_node.data

    def size(self):
        return self._total_nodes

    def remove_first(self):
        if self.size() > 0:
            first_val = self._first_node.data
            self._first_node = self._first_node.next
            self._first_node.prev = None
            self._total_nodes -= 1
            #return first_val
        return True

    def remove_last(self):
        if self.size() > 0:
            last_val = self._first_node.data
            self._last_node = self._last_node.prev
            self._last_node.next = None
            self._total_nodes -= 1
            #return last_val
        return True

    def traverse_list(self):
        current_node = self._first_node
        while current_node is not None:
            print(current_node.data)
            current_node = current_node.next

    def traverse_list_backwards(self):
        current_node = self._last_node
        while current_node is not None:
            print(current_node.data)
            current_node = current_node.prev


    def remove(self, query):
        if self._first_node is None:
            return False
        else:
            current_node = self._first_node
            previous_node = None
            while current_node.data != query:
                previous_node = current_node
                current_node = current_node.next
                if current_node.data == query:
                    previous_node.next = current_node.next
                    current_node.next.prev = previous_node
                    self._total_nodes -= 1
                    return True
        return False



# Testing implementation
task_list = DoublyLinkedList()
task_list.insert_first("Task0")
task_list.insert_first("Task1")
task_list.insert_first("Task2")
task_list.insert_last("Task3")
task_list.insert_last("Task4")
try:
    task_list.traverse_list()
    print(task_list.remove("Task3"))
    task_list.remove_last()
    task_list.remove_first()
    task_list.traverse_list_backwards()
    print(task_list.get_nth_element(6))
except ValueError:
    print("""
    Cannot seek for number of element greater than
    the number of total elements in the list
    """)
