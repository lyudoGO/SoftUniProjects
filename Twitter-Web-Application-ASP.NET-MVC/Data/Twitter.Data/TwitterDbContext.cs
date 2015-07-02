namespace Twitter.Data
{
    using Microsoft.AspNet.Identity.EntityFramework;
    using System;
    using System.Data.Entity;
    using Twitter.Data.Contracts;
    using Twitter.Data.Migrations;
    using Twitter.Models;

    public class TwitterDbContext : IdentityDbContext<User>, ITwitterDbContext
    {
        public TwitterDbContext()
            : base("Twitter")
        {
            Database.SetInitializer(new MigrateDatabaseToLatestVersion<TwitterDbContext, Configuration>());
            //this.Database.Initialize(false);
        }

        public IDbSet<Tweet> Tweets { get; set; }

        public IDbSet<Notification> Notifications { get; set; }


        public new IDbSet<T> Set<T>() where T : class
        {
            return base.Set<T>();
        }

        //protected override void Dispose(bool disposing)
        //{
        //    base.Dispose(disposing);
        //}

        public DbContext Context
        {
            get { return this; }
        }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Tweet>().HasMany(x => x.FavouriteUsers)
                                        .WithMany(y => y.FavouriteTweets)
                                        .Map(m => { m.ToTable("TweetUserFavourites"); });

            modelBuilder.Entity<Tweet>().HasMany(x => x.ReportedUsers)
                                        .WithMany(y => y.ReportedTweets)
                                        .Map(m => { m.ToTable("TweetUserReporteds"); });

            modelBuilder.Entity<Tweet>().HasMany(x => x.RetweetedUsers)
                                        .WithMany(y => y.RetweetedTweets)
                                        .Map(m => { m.ToTable("TweetUserRetweeteds"); });

            modelBuilder.Entity<User>().HasMany(u => u.FollowerUsers)
                                       .WithMany()
                                       .Map(m => { m.ToTable("UserFollowerUsers"); m.MapLeftKey("UserId"); m.MapRightKey("FollowerId"); });
            modelBuilder.Entity<User>().HasMany(u => u.FollowingUsers)
                                      .WithMany()
                                      .Map(m => { m.ToTable("UserFollowingUsers"); m.MapLeftKey("UserId"); m.MapRightKey("FollowingId"); });

            base.OnModelCreating(modelBuilder);
        }
    }
}
