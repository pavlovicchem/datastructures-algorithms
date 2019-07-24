
class AVLNode:

    def __init__(self, data):
        self.data = data
        self.height = 0
        self.left_child = None
        self.right_child = None


class AVLTree:

    def __init__(self):
        self._root = None
        self._total_nodes = 0

    def insert(self, data):
        self._root = self.insert_node(data, self._root)

    def insert_node(self, data, node):
        if not node:
            print("inserting {}".format(data))
            return AVLNode(data)
        if data < node.data:
            node.left_child = self.insert_node(data, node.left_child)
        else:
            node.right_child = self.insert_node(data, node.right_child)
        node.height = max(self.calc_height(node.left_child),
                          self.calc_height(node.right_child)) + 1

        return self.settle_violation(data, node)

    def settle_violation(self, data, node):
        balance = self.calc_balance(node)
        #case 1 -> left left heavy situation
        if balance > 1 and data < node.left_child.data:
            print("case 1 -> left left heavy situation")
            return self.rotate_right(node)
        #case 2 -> right right heavy situation
        if balance < -1 and data > node.right_child.data:
            print("case 2 -> right right heavy situation")
            return self.rotate_left(node)
        #case 3 -> left right heavy situation
        if balance > 1 and data > node.left_child.data:
            print("case 3 -> left right heavy situation")
            node.left_child = self.rotate_left(node.left_child)
            return self.rotate_right(node)
        #case 4 -> right left heavy situation
        if balance < -1 and data < node.right_child.data:
            print("case 4 -> right left heavy situation")
            node.right_child = self.rotate_right(node.right_child)
            return self.rotate_left(node)

        return node


    def calc_height(self, node):
        if not node:
            return -1

        return node.height

    def calc_balance(self, node):
        """
        if it returns value > 1:
            it means it is a left heavy tree -> perform right rotation
        if it returns value < -1:
            it means it is a right heavy tree -> perfrom left rotation
        else returns 0:
            it is balanced
        """
        if not node:
            return 0

        return self.calc_height(node.left_child) - self.calc_height(node.right_child)

    def rotate_right(self, node):
        """
        temporarily storing left child of our node and its right child
        so we can  update the references, making our node right_child of its
        own left_child and left left_child of it would be left_child's right_child
        """
        temp_left_child = node.left_child
        t = temp_left_child.right_child
        #making rotation to the right by updating the references
        temp_left_child.right_child = node
        node.left_child = t
        #recalculating height parameters for nodes after rotation
        node.height = max(self.calc_height(node.left_child),
                          self.calc_height(node.right_child)) + 1
        temp_left_child.height = max(self.calc_height(temp_left_child.left_child),
                                     self.calc_height(temp_left_child.right_child)) + 1
        # we return left child since it is now root for that subtree
        return temp_left_child

    def rotate_left(self, node):
        """
        temporarily storing right_child of our node and its  left_child
        so we can  update the references, making our node be left_child of its
        own right_child and right_child of it would be right_child's left_child
        """
        temp_right_child = node.right_child
        t = temp_right_child.left_child
        #making rotation to the right by updating the references
        temp_right_child.left_child = node
        node.right_child = t
        #recalculating height parameters for nodes after rotation
        node.height = max(self.calc_height(node.left_child),
                          self.calc_height(node.right_child)) + 1
        temp_right_child.height = max(self.calc_height(temp_right_child.left_child),
                                     self.calc_height(temp_right_child.right_child)) + 1
        # we return left child since it is now root for that subtree
        return temp_right_child

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
        if not node:
            return node #if the tree has just a single node
        node.height = max(self.calc_height(node.left_child),
                          self.calc_height(node.right_child)) + 1
        balance = self.calc_balance(node)
        #doubly left heavy situation
        if balance > 1 and self.calc_balance(node.left_child) >= 0:
            return self.rotate_right(node)
        #left right situation
        if balance > 1 and  self.calc_balance(node.left_child) < 0:
            node.left_child = self.rotate_left(node.left_child)
            return self.rotate_right(node)
        #doubly right situation
        if balance < -1 and self.calc_balance(node.right_child) <= 0:
            return self.rotate_left(node)
        #right left situation
        if balance < -1 and self.calc_balance(node.right_child) > 0:
            node.right_child = self.rotate_right(node.right_child)
            return self.rotate_left

        return node

    def get_predecessor(self, node):
        if node.right_child:
            return self.get_predecessor(node.right_child)
        return node

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



#Testing implementation
avltree = AVLTree()
avltree.insert(10)
avltree.insert(20)
avltree.insert(30)
avltree.insert(40)
avltree.insert(50)
avltree.insert(60)
avltree.insert(100)
avltree.insert(90)
avltree.insert(80)
avltree.insert(70)
avltree.traverse()
avltree.remove(10)
avltree.remove(30)
avltree.remove(70)
print("Minimum item is: {}".format(avltree.get_min_value()))
print("Maximum item is: {}".format(avltree.get_max_value()))
avltree.traverse()
