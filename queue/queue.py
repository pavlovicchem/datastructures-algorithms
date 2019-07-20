

class Queue:
    def __init__(self):
        self.queue = []

    def is_empty(self):
        return self.queue == []

    def size(self):
        return len(self.queue)

    def enqueue(self, data):
        self.queue.append(data)

    def dequeue(self):
        data = self.queue[0]
        del self.queue[0]
        return data

    def peek(self):
        return self.queue[0]


#Testing implementation

task_queue = Queue()
task_queue.enqueue("task1")
task_queue.enqueue("task2")
task_queue.enqueue("task3")
print("Dequeue: {} ".format(task_queue.dequeue()))
print("Dequeue: {} ".format(task_queue.dequeue()))
print("Size is: {} ".format(task_queue.size()))
print("Peeking: {} ".format(task_queue.peek()))
