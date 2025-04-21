using System;
using System.Net;
using System.Data;
namespace Bai4
{
    class program
    {
        static void Main(string[] args)
        {
            int n,x;
            int tong = 0;
            Console.Write("Nhap so phan tu trong mang: ");
            n = int.Parse(Console.ReadLine());
            Nhap(n);
            Inra(n);
            Tong(n, tong);
            Console.WriteLine("\nNhap gia tri can tim: ");
            x = int.Parse(Console.ReadLine());
            if (Tim(n, x) == 1) Console.Write("Co thay {0} trong mang", x);
            else Console.Write("K thay {0} trong mang", x);

        }

        //Ham Nhap gia tri vao mang
        public static int Nhap(int n)
        {
            int[] a = new int[10];
            for (int i = 1; i <= n; i++)
            {
                Console.Write("Nhap gia tri thu {0} :", i);
                a[i] = int.Parse(Console.ReadLine());
            }
            return 0;
        }

        //Ham in mang 
        public static int Inra(int n)
        {
            int[] a = new int[10];
            for (int i = 1; i <= n; i++)
                Console.Write(" {0}", a[i]);
            return 0;
        }

        //Ham tinh tong gtri mang
        public static int Tong(int n, int tong)
        {
            int[] a = new int[10];
            for (int i = 1; i <= n; i++)
                tong = tong + i;
            return 0;
        }

        //Ham tim x trong mang
        public static int Tim(int n, int x)
        {
            int[] a = new int[10];
            for (int i = 1; i <= n; i++)
                if (x == a[i]) return 1;
            return 0;
        }
    }
}
