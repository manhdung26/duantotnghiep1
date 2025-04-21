using System;
using System.Net;
using System.Data;
using System.Runtime.Serialization;

namespace bai3
{
    class program
    {
        static void Main(string[] args)
        {
            //Viet ham kiem tra
            int n;
            double a, b;
            Console.Write("Nhap vao n: ");
            n= int.Parse(Console.ReadLine());
            if (ktsoduong(n) == 0) Console.WriteLine("So {0} la so duong", n);
            else if (ktsoduong(n) == 1) Console.WriteLine("So {0} khong phai so duong", n);
            if (ktsont(n) == 0) Console.WriteLine("So {0} k phai so nguyen to", n);
            else if (ktsont(n) == 1) Console.WriteLine("So {0} la so nguyen to", n);
            Console.WriteLine("Nhap he so a, b: ");
            a = double.Parse(Console.ReadLine());
            b = double.Parse(Console.ReadLine());
            if (pt(a, b) == 0) Console.WriteLine("pt vo nghiem ");
            else Console.WriteLine("Ket qua la: {0}", pt(a, b));


        }
        
        //kiem tra so duong
        public static int ktsoduong(int n)
        {
            if (n > 0) return 0;
            else return 1;
        }
        //kiem tra so nguyen to
        public static int ktsont(int n)
        {
            if (n < 2) return 0;
            for(int i=2; i<=Math.Sqrt(n);i++)
                if (n%i==0) return 0;
            return 1;
        }
        //Giai pt bac nhat\
        public static double  pt(double a, double b)
        {
            if (a == 0) return 0;
            return -b / a;
        }



    }
}
