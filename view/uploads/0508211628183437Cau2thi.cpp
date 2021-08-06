#include<iostream>
#include<string>
using namespace std;

class Xe{
	protected:
		float trongluong;
		string bienso;
	public:
		void Nhap()
		{
			cout<<"\nNhap trong luong : ";cin>>trongluong;
			fflush(stdin);
			cout<<"Nhap bien so : ";getline(cin,bienso);
		}
		void Xuat()
		{
			cout<<"\nTrong luong : "<<trongluong;
			cout<<"\nBien so : "<<bienso;
		}
};

class Xecon:public Xe{
	private:
		int sochongoi;
	public:
		void Nhap()
		{
			Xe::Nhap();
			cout<<"\nNhap so cho ngoi : ";cin>>sochongoi;
		}
		void Xuat()
		{
			Xe::Xuat();
			cout<<"\nSo cho ngoi : "<<sochongoi;
		}
		void yeucau(Xecon *a[],int n)
		{
			for(int i = 0 ; i < n ; i ++)
			{
				if(a[i]->trongluong < 1000 && a[i]->sochongoi <6)
				{
					a[i]->Xuat();
				}
			}
		}
		
};

class Xetai:public Xe{
	private:
		float taitrong;
	public:
		void Nhap()
		{
			Xe::Nhap();
			cout<<"\nNhap tai trong :"; cin>>taitrong;
		}
		void Xuat()
		{
			Xe::Xuat();
			cout<<"\nTai trong : "<<taitrong;
		}
		int yeucau(Xetai *b[],int m)
		{
			for(int i =0;i<m;i++)
			{
				if(b[i]->trongluong > 5000){
					return 1;
				}
			}
		}
};

int main()
{
	int n,m;
	cout<<"\nNhap so luong xe con : ";cin>>n;
	Xecon *a[n];
	for(int i=0;i<n;i++)
	{
		cout<<"\nNhap xe thu "<<i+1;
		a[i] = new Xecon();
		a[i]->Nhap();
	}
	a[n]->yeucau(a,n);
	Xetai *b[m];
	cout<<"\nNhap so luong xe tai : ";cin>>m;
	for(int i=0;i<n;i++)
	{
		cout<<"\nNhap xe thu "<<i+1;
		b[i] = new Xetai();
		b[i]->Nhap();
	}
	b[n]->yeucau(b,n);
	delete[] a;
	system("pause");
	return 0;
	
}

