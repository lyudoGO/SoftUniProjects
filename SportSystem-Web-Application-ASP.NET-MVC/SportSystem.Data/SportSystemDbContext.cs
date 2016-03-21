namespace SportSystem.Data
{
    using Microsoft.AspNet.Identity.EntityFramework;
    using System.Data.Entity;

    using SportSystem.Data.Migrations;
    using SportSystem.Models;

    public class SportSystemDbContext : IdentityDbContext<User>, ISportSystemDbContext
    {
        public SportSystemDbContext()
            : base("SportSystemConnection")
        {
            Database.SetInitializer(new MigrateDatabaseToLatestVersion<SportSystemDbContext, Configuration>());
        }

        public static SportSystemDbContext Create()
        {
            return new SportSystemDbContext();
        }

        public IDbSet<Team> Teams { get; set; }

        public IDbSet<Player> Players { get; set; }

        public IDbSet<Match> Matches { get; set; }

        public IDbSet<Bet> Bets { get; set; }

        public IDbSet<Comment> Comments { get; set; }

        public IDbSet<Vote> Votes { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Match>()
                .HasRequired(x => x.AwayTeam)
                .WithMany(x => x.Matches)
                .WillCascadeOnDelete(false);
            //modelBuilder.Entity<Match>()
            //    .HasRequired(x => x.HomeTeam)
            //    .WithMany(x => x.Matches)
            //    .WillCascadeOnDelete(false);

            base.OnModelCreating(modelBuilder);
        }

    }
}
