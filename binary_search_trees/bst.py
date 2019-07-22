
class TreeNode:

    def __init__(self, data):
        self.data = data
        self.left_child = None
        self.right_child = None


class BinarySearchTree:

    def __init__(self):
        self._root = None
        self._total_nodes = 0

    def insert(self, data):
        if not self._root:
            self._root = TreeNode(data)
            self._total_nodes += 1
        else:
            self.insert_node(data, self._root)

    def insert_node(self, data, node):
        if node.data > data:
            if node.left_child == None:
                node.left_child = TreeNode(data)
                self._total_nodes += 1
                return True
            else:
                return self.insert_node(data, node.left_child)
        else:
            if node.right_child == None:
                node.right_child = TreeNode(data)
                self._total_nodes += 1
                return True
            else:
                return self.insert_node(data, node.right_child)

    def get_min_value(self):
        if self._root:
            return self.get_min(self._root)
        return False

    def get_min(self, node):
        if node.left_child:
            return self.get_min(node.left_child)
        return node.data

    def get_max_value(self):
        if self._root:
            return self.get_max(self._root)
        return False

    def get_max(self, node):
        if node.right_child:
            return self.get_max(node.right_child)
        return node.data

    def traverse(self):
        if self._root:
            self.traverse_in_order(self._root)

    def traverse_in_order(self, node):
        if node.left_child:
            self.traverse_in_order(node.left_child)
        print("{}".format(node.data))
        if node.right_child:
            self.traverse_in_order(node.right_child)


    def remove(self, data):
        if self._root:
            self._root = self.remove_node(data, self._root)
        return False

    def remove_node(self, data, node):
        if not node:
            return node

        if data < node.data:
            node.left_child = self.remove_node(data, node.left_child)
        elif data > node.data:
            node.right_child = self.remove_node(data, node.right_child)
        else:
            if not node.left_child and not node.right_child:
                print("Removing a leaf node:{}".format(node.data))
                del node;
                self._total_nodes -= 1
                return None;
            elif not node.left_child:
                print("Removing node with single right child:{}".format(node.data))
                temp = node.right_child;
                del node;
                self._total_nodes -= 1
                return temp;
            elif not node.right_child:
                print("Removing node with single left child:{}".format(node.data))
                temp = node.left_child;
                del node;
                self._total_nodes -= 1
                return temp;
            else:
                print("Removing node with two children:{}".format(node.data))
                temp = self.get_predecessor(node.left_child)
                node.data = temp.data
                node.left_child = self.remove_node(temp.data, node.left_child)
        return node


    def get_predecessor(self, node):
        if node.right_child:
            return self.get_predecessor(node.right_child)
        return node






# Testing implementation

bst = BinarySearchTree()
bst.insert(10)
bst.insert(12)
bst.insert(7)
bst.insert(5)
bst.insert(9)
bst.insert(20)
bst.insert(15)
print(bst)
print(bst._total_nodes)
print(bst._root.data)
print(bst._root.left_child.data)
print(bst._root.right_child.data)
print(bst._root.left_child.left_child.data)
print(bst._root.left_child.right_child.data)
print("Minimal value: {}".format(bst.get_min_value()))
print("Maxmimum value: {}".format(bst.get_max_value()))
print("In order traversal algorithm outputs: \n")
bst.traverse()
bst.remove(7)
bst.remove(15)
bst.traverse()
