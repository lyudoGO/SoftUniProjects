namespace SportSystem.Web.Infrastructure.CacheService
{
    using System.Collections.Generic;
    using SportSystem.Web.Models;

    public interface ICacheService
    {
        IList<TeamViewModel> Teams { get; }

        IList<MatchViewModel> Matches { get; }
    }
}
