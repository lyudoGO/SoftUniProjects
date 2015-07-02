namespace Twitter.Data.Contracts
{
    using System.Data.Entity;
    using System.Data.Entity.Infrastructure;
    using Twitter.Models;

    public interface ITwitterDbContext
    {
        IDbSet<User> Users { get; set; }

        IDbSet<Tweet> Tweets { get; set; }

        IDbSet<Notification> Notifications { get; set; }

        IDbSet<T> Set<T>() where T : class;

        DbEntityEntry<T> Entry<T>(T entity) where T : class;

        DbContext Context { get; }

        int SaveChanges();
    }
}
