#include <iostream>
#include <string>

using namespace std;

// List class definition
class List {
    private:
        Student *head, *last;
        
    public:
        List() { 
            cout << "Create list...\n";
            head = NULL; last = NULL;
        }
        
        void insertNode(Student *newStud) {
        	cout << "Insert " << newStud->getName() << "\n";

            if (head == NULL)
            {
                head = newStud;
                last = newStud;
            }

            else if (newStud->getName() < head->getName())
            {
                newStud->setNext(head);
                head = newStud;
            }

            else 
            {
                Student *currStud = head;
                while (currStud->getNext() && (currStud->getNext()->getName() < newStud->getName())) {
                    currStud = currStud->getNext();
                }

                newStud->setNext(currStud->getNext());
                currStud->setNext(newStud);

                if (currStud == last) {
                    last = newStud;
                }
            }
        }
        
        Student *findNode(string name) {
            Student *currStud = head;
            while (currStud != NULL) {
                if (name == currStud->getName()) return currStud;
                    currStud = currStud->getNext();
            }
            return NULL;
        }
        
        void deleteNode(string name) {
            Student *stud, *prev;
            stud = head;
            prev = NULL;
            
            while (stud != NULL)
            {
                if (stud->getName()==name)
                {
                    if (stud == head)
                    {
                        head = head->getNext();
                        if (head == NULL) 
                            last = NULL;
                    }
                    
                    else if (stud == last)
                    {
                        last = prev;
                        if (prev != NULL)
                            prev->setNext(NULL);
                    }

                    else 
                    {
                        prev->setNext(stud->getNext());
                    }

                    delete stud;
                    stud = NULL;
                    break;
                }
                prev = stud;
                stud = stud->getNext();
            }
        }
        
        void displayList() {
        	Student *stud = head;
        	
        	while (stud != NULL) {
        		stud->printResult();
        		stud = stud->getNext();
			}
        }
        
        Student *getHead() { return head; }
        Student *getLast() { return last; }
        
        ~List() {
        	Student *stud = head;
        	cout << "Destroy list...\n";
        	while (stud != NULL) {
        		Student *prevStud = stud;
        		stud = stud->getNext();
        		delete prevStud;
			}
		}
};
