// Lab 2 - SECJ2013 - 23241 (Lab2.cpp)
// Group Members:
// 1. MOHAMED ALIF FATHI BIN ABDUL LATIF A23CS0112
// 2. MUHAMMAD MUKHRITZ AL IMAN BIN MOHD RAFFI A23CS0250

#include <iostream>
#include <string>

using namespace std;

void printStar(int n) {
    if(n > 0) 
    {
        cout << "*";
        printStar(n - 1);
    }
}

void printNum(int n) {
    if(n > 0)
    {
        printNum(n - 1);
        cout << n << "-";
        printStar(n);
        cout << endl;
    }
}

int totalOdd(int list[], int n) {
    int total = 0;

    if(n > 0) {
        total = totalOdd(list, n - 1);
        if (list[n - 1] % 2 != 0) {
            cout << list[n - 1] << " ";
            total += list[n - 1];
        }
    }
    return total;
}

// Main function
int main(int argc, char *argv[])
{
    printNum(6);

    cout << "\n\n";

    int num[6] = {0, 1, 2, 3, 4, 5};
    int result = totalOdd(num, 6);
    cout << "= " << result << endl;
    
    system("pause");

    return 0;
}

