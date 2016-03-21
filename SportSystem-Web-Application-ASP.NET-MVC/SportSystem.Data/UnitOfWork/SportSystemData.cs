namespace SportSystem.Data.UnitOfWork
{
    using System;
    using System.Collections.Generic;

    using SportSystem.Data.Repositories;
    using SportSystem.Models;

    public class SportSystemData : ISportSystemData
    {
        private ISportSystemDbContext context;
        private IDictionary<Type, object> repositories;

        public SportSystemData(ISportSystemDbContext context)
        {
            this.context = context;
            this.repositories = new Dictionary<Type, object>();
        }

        public IRepository<User> Users
        {
            get { return this.GetRepository<User>(); }
        }

        public IRepository<Comment> Comments
        {
            get { return this.GetRepository<Comment>(); }
        }

        public IRepository<Team> Teams
        {
            get { return this.GetRepository<Team>(); }
        }

        public IRepository<Player> Players
        {
            get { return this.GetRepository<Player>(); }
        }

        public IRepository<Match> Matches
        {
            get { return this.GetRepository<Match>(); }
        }

        public IRepository<Bet> Bets
        {
            get { return this.GetRepository<Bet>(); }
        }

        public IRepository<Vote> Votes
        {
            get { return this.GetRepository<Vote>(); }
        }

        public int SaveChanges()
        {
            return this.context.SaveChanges();
        }

        private IRepository<T> GetRepository<T>() where T : class
        {
            var type = typeof(T);
            if (!this.repositories.ContainsKey(type))
            {
                var typeOfRepository = typeof(GenericRepository<T>);
                //                if (type.IsAssignableFrom(typeof(Game)))
                //                {
                //                    typeOfRepository = typeof(GamesRepository);
                //                }

                var repository = Activator.CreateInstance(typeOfRepository, this.context);
                this.repositories.Add(type, repository);
            }

            return (IRepository<T>)this.repositories[type];
        }
    }
}
