// Lab 3 - SECJ2013 - 24251 (Lab3.cpp)
// Group Members:
// 1. MOHAMED ALIF FATHI BIN ABDUL LATIF A23CS0112
// 2. MUHAMMAD AFIQ DANIAL BIN ROZAIDIE A23CS0117

#include <iostream>
#include <string>

using namespace std;

// Class section
class Node {
  public:
    int data;
    Node *next, *prev;

    Node(int n) {
        data = n;
        next = NULL;
        prev = NULL;
    }
};

// List class (linked list)
class List {
    private:
       Node *head;
       Node *last;

    public:
        List() { head = NULL; last = NULL; }

        ~List() {
            Node *n = head;

            while (n != NULL) {
                Node *temp = n;
                n = n->next;
                delete(temp);
            }
        }

        bool isEmpty() {  return head == NULL; }

        // please complete the insertNode function
        void insertNode(int val) {
            Node *newNode = new Node(val);

            if (isEmpty()) 
            {
                head = newNode;
                last = newNode;
            } 

            else 
            {
                Node *currNode = head;
                while (currNode != NULL && currNode->data < val) {
                    currNode = currNode->next;
                }

                if (currNode == head) {
                    newNode->next = head;
                    head->prev = newNode;
                    head = newNode;
                } 

                else if (currNode == NULL) 
                { 
                    last->next = newNode;
                    newNode->prev = last;
                    last = newNode;
                } 
                
                else 
                {
                    newNode->next = currNode;
                    newNode->prev = currNode->prev;
                    currNode->prev->next = newNode;
                    currNode->prev = newNode;
                }
            }

        }

        int findNode(int n) {
           Node *currNode = head;
           int post = 1;
           while (currNode != NULL) {
               if (n == currNode->data) return post;
               currNode = currNode->next;
               post++;
           }

           return 0;
        }

        // please complete the deleteNode function
        int deleteNode(int n) {
            Node *currNode = head;
            int position = 1;

            while (currNode != NULL) {
                if (currNode->data == n) {
                    if (currNode == head) 
                    {
                        head = head->next;
                        if (head != NULL) head->prev = NULL;
                        else last = NULL;
                    }

                    else if (currNode == last) 
                    {
                        last = last->prev;
                        last->next = NULL;
                    }

                    else 
                    {
                        currNode->prev->next = currNode->next;
                        currNode->next->prev = currNode->prev;
                    }

                    delete currNode;
                    cout << "\nDelete node " << n << " at position = " << position << endl << endl;
                    break;
                }
                currNode = currNode->next;
                position++;
            }

            return 0;
        }

        void displayList() {
            Node *n = head;
            cout << "displayList:\n";
            
            while (n != NULL) {
                cout << n->data << " ";
                n = n->next;
            }
            
            cout << "\n";
        }
        
        void displayListReverse() {
            Node *n = last;
            cout << "displayListReverse:\n";
            
            while (n != NULL) {
                cout << n->data << " ";
                n = n->prev;
            }
            
            cout << "\n";
        }
};


// Main function section
int main() {
   List linkedList;

   // do not change this insert values sequence
   linkedList.insertNode(0);
   linkedList.insertNode(9);
   linkedList.insertNode(1);
   linkedList.insertNode(6);
   linkedList.insertNode(5);

   linkedList.displayList();
   linkedList.displayListReverse();
   
   linkedList.deleteNode(5);
   linkedList.displayList();
   linkedList.displayListReverse();
   
   linkedList.deleteNode(0);
   linkedList.displayList();
   linkedList.displayListReverse();
   
   linkedList.deleteNode(9);
   linkedList.displayList();
   linkedList.displayListReverse();
   
   system("pause");
   return 0;
}
