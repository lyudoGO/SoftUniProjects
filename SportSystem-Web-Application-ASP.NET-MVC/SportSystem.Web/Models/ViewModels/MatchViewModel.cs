namespace SportSystem.Web.Models
{
    using System;

    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class MatchViewModel : IMapFrom<Match>
    {
        public int Id { get; set; }

        public int HomeTeamId { get; set; }

        public virtual Team HomeTeam { get; set; }

        public int AwayTeamId { get; set; }

        public virtual Team AwayTeam { get; set; }

        public DateTime MatchDate { get; set; }
    }
}