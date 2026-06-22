// Assignment 1 - SECJ2013 - 23241 (Assg1.cpp)
// Group Members:
// 1. MOHAMED ALIF FATHI BIN ABDUL LATIF A23CS0112
// 2. MUHAMMAD AFIQ DANIAL BIN ROZAIDIE A23CS0117
// 3. AHMAD ADIB ZIKRI BIN A.MAZLAM A23CS0205

#include <iostream>
#include <string>
#include <fstream>
#include "Student.h"

using namespace std;

// function headers
void swap(Student* &, Student* &);
void listStudent(Student* [], int);
void sortByName(Student* [], int);
void sortByGrade(Student* [], int);

// main function
int main() {
    const int LIST_SIZE = 10;
    string name;
    int cw, fe, idx = 0;
    Student* studList[LIST_SIZE];

    fstream fileIn("Marks.txt", ios::in);

    if (!fileIn) {
        cout << "File input/output error!\n";
        return 1;

    } else {
        while (fileIn >> name >> cw >> fe) {
            studList[idx] = new Student(name, cw, fe);
            idx++;
        }
        
        int opt = 0;

        while (opt != 4) {
            cout << "\n1. List results (original list)";
            cout << "\n2. List results (sort by name)";
            cout << "\n3. List results (sort by grade)";
            cout << "\n4. Exit\n\n";
            
            cout << "Enter your choice [1, 2, 3, 4]: ";
            cin >> opt;
            
            if (opt == 1) {
                listStudent(studList, idx);
            }

            if (opt == 2) {
                sortByName(studList, idx);
            }

            if (opt == 3) {
                sortByGrade(studList, idx);
            }
            
            if (opt == 4) 
            {
                for(int i = 0; i < idx; i++)
                {
                    delete studList[i];
                }
            }
            system("pause");
        }
        fileIn.close();
    }

    return 0;
}

// function implementation
void listStudent(Student* sl[], int size) {
    for (int i = 0; i < size; i++) {
        sl[i]->printResult();
    }
}

void swap(Student* &a, Student* &b) {
    Student* temp = a;
    a = b;
    b = temp;
}

void sortByName(Student* sl[], int listSize) {
    Student *sn[listSize];
    for (int x = 0; x < listSize; x++)
    {
        sn[x] = sl[x];
    }
    bool sorted = false;

    for (int pass = 1; pass < listSize && !sorted; pass++) {
        sorted = true;
        
        for (int x = 0; x < listSize - pass; x++) {

            if (sn[x]->getName() > sn[x + 1]->getName()) {
                swap(sn[x], sn[x+1]);
                sorted = false;
            }
        }
    }
    listStudent(sn, listSize);
}

void sortByGrade(Student* sl[], int listSize) {
    Student *sg[listSize];
    for (int x = 0; x < listSize; x++)
    {
        sg[x] = sl[x];
    }
    bool sorted = false;

    for (int pass = 1; pass < listSize && !sorted; pass++) {
        sorted = true;
        for (int x = 0; x < listSize - pass; x++) {

            if (sg[x]->getGrade() > sg[x + 1]->getGrade() || (sg[x]->getGrade() == sg[x + 1]->getGrade() && sg[x]->getName() > sg[x + 1]->getName())) {
                swap(sg[x], sg[x+1]);
                sorted = false;
            }
        }
    }
    listStudent(sg, listSize);
}
