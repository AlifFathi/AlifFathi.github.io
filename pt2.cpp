// name 1: Muhammad Afiq Danial bin Rozaidie A23CS0117
// name 2: Mohamed Alif Fathi bin Abdul Latif A23CS0112

#include <iostream>
using namespace std;

void displayAccountInfo (int);
int deposit (int&);
int withdraw (int&);

int main(){
	int balance = 200;
	char decision;

	do{
		displayAccountInfo(balance);
		deposit (balance);
		withdraw (balance);
		displayAccountInfo(balance);
		
		cout << "Do you want to perform another transaction? (Y/N): ";
		cin >> decision;
		cout << "\n\n";
	} while (decision == 'Y' || decision == 'y');
	
	return 0;
}

void displayAccountInfo (int i){
	cout << "<<<<< My Accounts Overview >>>>>" << endl;
	cout << "Account Holder Name: User 1" << endl;
	cout << "Account Number: 1013202341" << endl;
	cout << "Balance: RM " << i << "\n\n";	
}

int deposit(int &k){
	cout << "<<<<< Deposit Transaction >>>>>" << endl;
	cout << "Deposit of RM 500 successful.\n\n";
	k += 500;
	return k;
}

int withdraw (int &p){
	cout << "<<<<< Withdrawal Transaction >>>>>" << endl;
	if (p >= 200){
		cout << "Withdrawal of RM 200 successful.\n\n";
	}
	else 
		cout << "Insufficient funds for withdrawal\n\n";
	p -= 200;
	return p;
}
