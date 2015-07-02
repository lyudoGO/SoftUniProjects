namespace Twitter.Data
{
    using System;
    using System.Collections.Generic;
    using System.Data.Entity;
    using System.Linq;
    using Twitter.Data.Contracts;
    using Twitter.Models;

    public interface ITwitterData : IDisposable
    {
        IRepository<User> Users { get; }

        IRepository<Tweet> Tweets { get; }

        IRepository<Notification> Notifications { get; }

        ITwitterDbContext Context { get; }

        int SaveChanges();
    }
}
