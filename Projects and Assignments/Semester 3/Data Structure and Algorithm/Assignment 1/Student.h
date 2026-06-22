#include <iostream>
#include <string>

using namespace std;

// Class defintion
class Student {
  private:
    string name;
    int cwMark;
    int feMark;

  public:
    Student() {
    }

    Student(string n, int cw, int fe) {
      this->name = n;
      this->cwMark = cw;
      this->feMark = fe;
    }
    
    string getName() {
        return this->name;
    }

    int getTotalMark() {
      return cwMark + feMark;
    }

    string getGrade() {
        int totalMark = this->getTotalMark();
        if (totalMark >= 75) return "A";
        if (totalMark >= 65) return "B";
        if (totalMark >= 50) return "C";
        if (totalMark >= 35) return "D";
        return "E";
    }

    void printLine() {
        cout << this->name << " " << this->cwMark << " " << this->feMark << "\n";
    }

    void printInfo() {
      cout << "Name: " << this->name << "\n";
      cout << "Coursework: " << this->cwMark << "\n";
      cout << "Final Exam: " << this->feMark << "\n";
    }

    void printResult() {
      cout << this->name << " " << this->getTotalMark() << " " << this->getGrade() << "\n";
    }

    void printResultFile(fstream &fo) {
      fo << this->name << " " << this->getTotalMark() << " " << this->getGrade() << "\n";
    }

    ~Student() {
      cout << "Destroy student object - " << this->name << "\n";
    }
};
