using System;
using System.Net;
using System.Data;

namespace Bai2
{
    class program
    {
        static void Main(string[] args)
        {
            //Viet ham tinh chu vi va dien tich hinh tron
            double r;
            Console.Write("Nhap vao ban kinh r = ");
            r = double.Parse(Console.ReadLine());
            Console.WriteLine("Dien tich hinh tron la: {0}", Dientich(r));
            Console.WriteLine("Chu vi hinh tron la: {0}", Chuvi(r));
        }

        public static double Chuvi(double r)
        {
            return Math.PI* r * 2;
        }

        public static double Dientich(double r)
        {
            return Math.PI*r * r;
        }

    }
}
