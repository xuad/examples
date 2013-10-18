using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace EntityFrameworkWithSQLite
{
	class Program
	{
		static void Main(string[] args)
		{
			using (var instance = new MovieDatabaseEntities())
			{
				// Clear table
				instance.Database.ExecuteSqlCommand("DELETE FROM movies");

				// Create new movie
				Movies movie = new Movies();
				movie.Name = "Kill Bill: Vol. 1";
				movie.Director = "Quentin Tarantino";
				movie.Playtime = 111;

				// Add movie to database table
				instance.Movies.Add(movie);

				// Add more movies
				instance.Movies.Add(new Movies("Pulp Fiction", "Quentin Tarantino", 1540));
				instance.Movies.Add(new Movies("Reservoir Dogs", "Quentin Tarantino", 99));
				instance.Movies.Add(new Movies("Wall-E", "Andrew Stanton", 98));
				instance.Movies.Add(new Movies("Drive ", "Nicolas Winding Refn", 100));

				// Save movies
				instance.SaveChanges();

				// Get a movie
				Movies wantedMovie = instance.Movies.SingleOrDefault(item => item.Name == "Pulp Fiction");
				wantedMovie.Playtime = 154;

				// Save changed movie
				instance.SaveChanges();

				// Show changed movie
				Console.WriteLine(string.Format("Filmname: {0}, Regisseur: {1}, Spielzeit: {2} min",
					wantedMovie.Name,
					wantedMovie.Director,
					wantedMovie.Playtime.ToString()));

				// Get all movies
				List<Movies> allMovies = instance.Movies.ToList();

				// Show all movies
				foreach (Movies showMovie in allMovies)
				{
					Console.WriteLine(string.Format("Filmname: {0}, Regisseur: {1}, Spielzeit: {2} min",
					showMovie.Name,
					showMovie.Director,
					showMovie.Playtime.ToString()));
				}

				// Wait for input
				Console.ReadLine();
			}
		}
	}
}
