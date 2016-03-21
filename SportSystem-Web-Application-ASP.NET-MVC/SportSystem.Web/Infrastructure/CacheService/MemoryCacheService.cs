namespace SportSystem.Web.Infrastructure.CacheService
{
    using System.Collections.Generic;
    using System.Linq;

    using AutoMapper.QueryableExtensions;

    using SportSystem.Data.UnitOfWork;
    using SportSystem.Web.Models;
    using SportSystem.Common;

    public class MemoryCacheService : BaseCacheService, ICacheService
    {
        private readonly ISportSystemData data;

        public MemoryCacheService(ISportSystemData data)
        {
            this.data = data;
        }

        public IList<TeamViewModel> Teams
        {
            get
            {
                return this.Get<IList<TeamViewModel>>("Teams", () =>
                    this.data.Teams
                        .All()
                        .OrderByDescending(x => x.Votes.Sum(v => v.Value))
                        .Take(GlobalConstants.HomePageNumber)
                        .Project()
                        .To<TeamViewModel>()
                        .ToList()
                );
            }
        }

        public IList<MatchViewModel> Matches
        {
            get 
            {
                return this.Get<IList<MatchViewModel>>("Matches", () =>
                    this.data.Matches
                             .All()
                             .OrderByDescending(x => x.Bets.Sum(v => (v.HomeBet + v.AwayBet)))
                             .Take(GlobalConstants.HomePageNumber)
                             .Project()
                             .To<MatchViewModel>()
                             .ToList()
                );
            }
        }
    }
}