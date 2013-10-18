using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SQLite;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SimpleSQLiteExample
{
	class Program
	{
		static void Main(string[] args)
		{
			// Create sqlite connection
			SQLiteConnection connection = new SQLiteConnection(string.Format(@"Data Source={0}\SimpleDatabase.s3db", Environment.CurrentDirectory));

			// Open sqlite connection
			connection.Open();

			// Get all rows from example_table
			SQLiteDataAdapter db = new SQLiteDataAdapter("SELECT * FROM Names", connection);

			// Create a dataset
			DataSet ds = new DataSet();

			// Fill dataset
			db.Fill(ds);

			// Create a datatable
			DataTable dt = new DataTable("Names");
			dt = ds.Tables[0];

			// Close connection
			connection.Close();

			// Print table
			foreach (DataRow row in dt.Rows)
			{
				Console.WriteLine(string.Format("{0} {1}", row["Firstname"], row["Surname"]));
			}

			Console.ReadLine();
		}
	}
}
