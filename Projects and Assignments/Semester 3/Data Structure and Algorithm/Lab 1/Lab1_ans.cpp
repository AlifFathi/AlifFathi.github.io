// Lab 1 - SECJ2013 - 24251 (Lab1.cpp)
// Group Members:
// 1. MOHAMED ALIF FATHI BIN ABDUL LATIF A23CS0112
// 2. AHMAD ADIB ZIKRI BIN A.MAZLAM A23CS0205

#include <iostream>
#include <string>
#include <fstream> 
#include "Student.h"

using namespace std;

// main function
int main() {
    const int LIST_SIZE = 10;
    Student* studList[LIST_SIZE];

    string name;
    int cwMark, feMark;

    fstream inFile ("Marks.txt", ios::in);
    fstream outFile ("Results.txt", ios::out);


    if (inFile)
    {
        cout << "Student mark info:" << endl;
        int i = 0;
        while (!inFile.eof() && i < LIST_SIZE)
        {
            inFile >> name >> cwMark >> feMark;
            studList[i] = new Student(name, cwMark, feMark);
            studList[i]->printInfo();
            i++;
        }

        cout << endl << "Print and save results to file:" << endl;

        for (int j = 0; j < i; j++)
        {
            studList[j]->printResult();
            studList[j]->printResultFile(outFile);
            delete studList[j];
            studList[j] = nullptr;
        }
    }

    else 
    {
        cout << "File cannot be accessed" << endl;
    }

    inFile.close();
    outFile.close();

    system("pause");
    return 0;
}