// Lab 1 - SECJ2013 - 24251 (Student.h)
// Group Members:
// 1. MOHAMED ALIF FATHI BIN ABDUL LATIF A23CS0112
// 2. AHMAD ADIB ZIKRI BIN A.MAZLAM A23CS0205

#include <iostream>
#include <string>
#include <fstream>

using namespace std;

// Class definition
class Student {

private:
    string name;
    int cwMark;
    int feMark;

public:
    Student (string name = "", int cwMark = 0, int feMark = 0)
    {
        this->name = name;
        this->cwMark = cwMark;
        this->feMark = feMark;
    }

    int getTotalMark();
    string getGrade();
    void printInfo();
    void printResult();
    void printResultFile(fstream &);
    ~Student()
    {
        cout << "Destroy student object - " << name << endl;
    }
    
};

int Student::getTotalMark()
{
    return cwMark + feMark;
}

string Student::getGrade()
{
    int totalMark = getTotalMark();
    
    if (totalMark <= 100 && totalMark >= 75)
        return "A";
    else if (totalMark <= 74 && totalMark >= 65)
        return "B";
    else if (totalMark <= 64 && totalMark >= 50)
        return "C";
    else if (totalMark <= 49 && totalMark >= 35)
        return "D";
    else if (totalMark <= 34 && totalMark >= 0)
        return "E";
    else
        return "Input error";
}

void Student::printInfo()
{
    cout << "Name: " << name << endl;
    cout << "Coursework: " << cwMark << endl;
    cout << "Final Exam: " << feMark << endl << endl;
}

void Student::printResult()
{
    cout << name << " " << getTotalMark() << " " << getGrade() << endl;
}

void Student::printResultFile(fstream &out)
{
    out << name << " " << getTotalMark() << " " << getGrade() << endl;
}