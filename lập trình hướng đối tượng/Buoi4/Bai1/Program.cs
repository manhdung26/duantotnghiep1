using System;
using System.Data;
using System.Net;

namespace bai1
{
    class program
    {
        static void Main(string[] args)
        {
            //Viet ham tinh chu vi, dien tich HCN
            int a, b;
            Console.Write("Nhap cd = ");
            a = int.Parse(Console.ReadLine());
            Console.Write("Nhap cr = ");
            b = int.Parse(Console.ReadLine());
            Console.WriteLine("Dien tich HCN la: {0}", Dientich(a, b));
            Console.WriteLine("Chu vi HCN la: {0}", Chuvi(a, b));
        }

        public static int Dientich(int a, int b)
        {
            return a * b;
        }

        public static int Chuvi(int a, int b)
        {
            return (a + b) * 2;
        }



    }

}
