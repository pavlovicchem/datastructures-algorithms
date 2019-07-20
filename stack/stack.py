
class Stack:
    def __init__(self):
        self.stack = []

    def is_empty(self):
        return self.stack == []

    def push(self, data):
        self.stack.append(data)

    def pop(self):
        data = self.stack[-1]
        del self.stack[-1]
        return data

    def peek(self):
        return self.stack[-1]

    def size(self):
        return len(self.stack)


#Testing implementation
stack = Stack()
print("At instantiation stack is_empty: {}".format(stack.is_empty()))
stack.push(1)
stack.push(11)
stack.push(22)
stack.push(55)
print("Stack has {} elements".format(str(stack.size())))
print("We peek at top and there is: {}".format(stack.peek()))
print(stack.pop())
print(stack.pop())
print(stack.pop())
print("We peek at top again and there is only: {}".format(stack.peek()))
