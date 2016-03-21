namespace SportSystem.Data.Migrations
{
    using Microsoft.AspNet.Identity;
    using Microsoft.AspNet.Identity.EntityFramework;
    using System;
    using System.Collections.Generic;
    using System.Data.Entity;
    using System.Data.Entity.Migrations;
    using System.Linq;
    using System.Threading;
    using System.Globalization;
    using SportSystem.Common;
    using SportSystem.Data;
    using SportSystem.Models;

    internal sealed class Configuration : DbMigrationsConfiguration<SportSystemDbContext>
    {
        private UserManager<User> userManager;
        //private IUserStore<User> userStore;

        public Configuration()
        {
            this.AutomaticMigrationsEnabled = true;
            this.AutomaticMigrationDataLossAllowed = true;
        }

        protected override void Seed(SportSystemDbContext context)
        {
            Thread.CurrentThread.CurrentCulture = CultureInfo.InvariantCulture;

            this.userManager = new UserManager<User>(new UserStore<User>(context));
            this.SeedUsers(context);

            if (!context.Teams.Any())
            {
                this.SeedTeams(context);
            }

            if (!context.Matches.Any())
            {
                this.SeedMatches(context);
            }

            if (!context.Players.Any())
            {
                this.SeedPlayers(context);
            }

            if (!context.Comments.Any())
            {
                this.SeedComments(context);
            }

            if (!context.Bets.Any())
            {
                this.SeedBets(context);
            }

            if (!context.Votes.Any())
            {
                this.SeedVotes(context);
            }
        }

        private void SeedTeams(SportSystemDbContext context)
        {
            string[] teams = new string[] {   @"Manchester United F.C. | http://www.manutd.com | 1-Jun-1878	| The Red Devils",
                                              @"Real Madrid | http://www.realmadrid.com |	6-Mar-1902	| The Whites",
                                              @"FC Barcelona  | http://www.fcbarcelona.com	| 12-Nov-1899 | Barca",
                                              @"Bayern Munich  | http://www.fcbayern.de	| 13-Feb-1900 | The Bavarians",
                                              @"Manchester City | http://www.mcfc.com | 1-May-1880	| The Citizens",
                                              @"Chelsea | https://www.chelseafc.com | 10-Mar-1905 | The Pensioners",
                                              @"Arsenal | http://www.arsenal.com | 1-Sep-1886 | The Gunners"
                                         };
            foreach (var teamStr in teams)
            {
                var parameters = teamStr.Split('|');
                var team = new Team()
                {
                    Name = parameters[0].Trim(),
                    WebSite = parameters[1].Trim(),
                    DateFounded = DateTime.Parse(parameters[2].Trim()),
                    NickName = parameters[3].Trim()
                };

                context.Teams.AddOrUpdate(team);
            }

            context.SaveChanges();
        }

        private void SeedMatches(SportSystemDbContext context)
        {
            string[] matches = new string[] {   @"Real Madrid	| Manchester United F.C. | 2015-Jun-13",
                                                @"Bayern Munich	| Manchester United F.C. | 2015-Jun-14",
                                                @"FC Barcelona	| Manchester City |	2015-Jun-15",
                                                @"Chelsea	| FC Barcelona	| 2015-Jun-16",
                                                @"Real Madrid	| Manchester City | 2015-Jun-17",
                                                @"Manchester United F.C. |	Chelsea	| 2015-Jun-18",
                                                @"Arsenal | Bayern Munich | 2015-Jun-12",
                                                @"Chelsea | Real Madrid	| 2015-Jun-11",
                                                @"Chelsea | Manchester City	| 2015-Jun-10",
                                                @"Chelsea | Arsenal	| 2015-Jun-19",
                                                @"Arsenal | FC Barcelona | 2015-Jun-20"
                                         };

            foreach (var matchStr in matches)
            {
                var parameters = matchStr.Split('|');
                var teamOneName = parameters[0].Trim();
                var teamTwoName = parameters[1].Trim();
                var match = new Match()
                {
                    HomeTeam = context.Teams.FirstOrDefault(t => t.Name == teamOneName),
                    AwayTeam = context.Teams.FirstOrDefault(t => t.Name == teamTwoName),
                    MatchDate = DateTime.Parse(parameters[2].Trim()),
                };

                context.Matches.AddOrUpdate(match);
            }
            context.SaveChanges();
        }

        private void SeedPlayers(SportSystemDbContext context)
        {
            string[] players = new string[] {   @"Alexis Sanchez | 1982-01-03	| 1.65	| FC Barcelona",
                                                @"Arjen Robben	| 1982-01-03	| 1.65	| Real Madrid",
                                                @"Franck Ribery	| 1982-01-03	| 1.65	| Manchester United F.C.",
                                                @"Wayne Rooney	| 1982-01-03	| 1.65	| Manchester United F.C.",
                                                @"Lionel Messi	| 1982-01-13	| 1.65	| (NULL)",
                                                @"Theo Walcott	| 1983-02-17	| 1.75	| (NULL)",
                                                @"Cristiano Ronaldo	| 1984-03-16 | 1.85	| (NULL)",
                                                @"Aaron Lennon	| 1985-04-15 | 1.95 |	(NULL)",
                                                @"Gareth Bale	| 1986-05-14 | 1.90	| (NULL)",
                                                @"Antonio Valencia	| 1987-05-23 |	1.82 | (NULL)",
                                                @"Robin van Persie	| 1988-06-13 |	1.84 | (NULL)",
                                                @"Ronaldinho | 1989-07-30 |	1.87 | (NULL)"
                                         };

            foreach (var playerStr in players)
            {
                var parameters = playerStr.Split('|');
                var teamName = parameters[3].Trim() == "(NULL)" ? null : parameters[3].Trim();
                var player = new Player()
                {
                    Name = parameters[0].Trim(),
                    BirthDate = DateTime.Parse(parameters[1].Trim()),
                    Height = double.Parse(parameters[2].Trim()),
                    Team = context.Teams.FirstOrDefault(t => t.Name == teamName)
                };

                context.Players.AddOrUpdate(player);
            }
            context.SaveChanges();
        }

        private void SeedComments(SportSystemDbContext context)
        {
            string[] comments = new string[] {  @"Bayern Munich - Manchester United F.C. | The best match this summer! | alex@usa.net | The good football this evening.	| tanya@gmail.com",
                                                @"FC Barcelona - Manchester City | Barca! | tanya@gmail.com",
                                                @"Real Madrid - Manchester City | Real forever! | alex@usa.net | Real, real, real | alex@usa.net | Real again :) | alex@usa.net",
                                                @"Chelsea - Real Madrid | Chelsea champion! | tanya@gmail.com"
                                             };

            foreach (var commentStr in comments)
            {
                var parameters = commentStr.Split('|');
                var homeTeamName = parameters[0].Split('-')[0].Trim();
                var awayTeamName = parameters[0].Split('-')[1].Trim();
                for (int i = 1; i < parameters.Length; i += 2)
                {
                    var comment = new Comment();
                    var authorEmail = parameters[i + 1].Trim();
                    comment.Author = context.Users.FirstOrDefault(u => u.Email == authorEmail);
                    comment.Content = parameters[i].Trim();
                    comment.Match = context.Matches.FirstOrDefault(m => m.HomeTeam.Name == homeTeamName && m.AwayTeam.Name == awayTeamName);
                    context.Comments.AddOrUpdate(comment);
                }
            }
            context.SaveChanges();
        }

        private void SeedBets(SportSystemDbContext context)
        {
            string[] bets = new string[] {  @"Chelsea - FC Barcelona |	30.00 |	0.00 | alex@usa.net",
                                            @"Chelsea - FC Barcelona | 0.00 | 50.00 | alex@usa.net",
                                            @"Chelsea - FC Barcelona |	0.00 | 120.00 |	alex@usa.net",
                                            @"FC Barcelona - Manchester City |	120.00 | 0.00 |	alex@usa.net",
                                            @"Bayern Munich - Manchester United F.C. |	500.00	| 0.00	| alex@usa.net",
                                            @"Bayern Munich - Manchester United F.C. |	50.00	| 0.00	| tanya@gmail.com",
                                            @"Bayern Munich - Manchester United F.C. |	0.00	| 20.00	| tanya@gmail.com",
                                            @"Chelsea - FC Barcelona |	0.00 | 220.00 |	tanya@gmail.com" 
                                         };

            foreach (var betStr in bets)
            {
                var parameters = betStr.Split('|');
                var homeTeamName = parameters[0].Split('-')[0].Trim();
                var awayTeamName = parameters[0].Split('-')[1].Trim();
                var userEmail = parameters[3].Trim();
                var bet = new Bet()
                {
                    Match = context.Matches.FirstOrDefault(m => m.HomeTeam.Name == homeTeamName && m.AwayTeam.Name == awayTeamName),
                    HomeBet = decimal.Parse(parameters[1].Trim()),
                    AwayBet = decimal.Parse(parameters[2].Trim()),
                    User = context.Users.FirstOrDefault(u => u.Email == userEmail)
                };
                context.Bets.Add(bet);
            }
            context.SaveChanges();
        }

        private void SeedVotes(SportSystemDbContext context)
        {
            string[] votes = new string[] {  @"Bayern Munich	| tanya@gmail.com",
                                            @"Real Madrid	| tanya@gmail.com",
                                            @"Bayern Munich	| alex@usa.net"
                                         };

            foreach (var voteStr in votes)
            {
                var parameters = voteStr.Split('|');
                var teamName = parameters[0].Trim();
                var userEmail = parameters[1].Trim();
                var vote = new Vote()
                {
                    Team = context.Teams.FirstOrDefault(t => t.Name == teamName),
                    User = context.Users.FirstOrDefault(u => u.Email == userEmail),
                    Value = 1
                };
                context.Votes.Add(vote);
            }
            context.SaveChanges();
        }

        private void SeedUsers(SportSystemDbContext context)
        {
            var userOne = new User
            {
                Email = "alex@usa.net",
                UserName = "alex"
            };

            var userTwo = new User
            {
                Email = "tanya@gmail.com",
                UserName = "tanya"
            };

            this.userManager.Create(userOne, "12qw!@QW");
            this.userManager.Create(userTwo, "P@ssW0RD!123");
        }
    }
}
