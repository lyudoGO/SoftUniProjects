namespace SportSystem.Web.Models
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using AutoMapper;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class TeamDetailViewModel : IMapFrom<Team>, IHaveCustomMappings
    {
        public int Id { get; set; }

        public string Name { get; set; }

        public string NickName { get; set; }

        public string WebSite { get; set; }

        public DateTime? DateFounded { get; set; }

        public int? VotesCount { get; set; }

        public bool UserHasVote { get; set; }

        public ICollection<PlayerViewModel> Players { get; set; }

        public void CreateMappings(IConfiguration configuration)
        {
            configuration.CreateMap<Team, TeamDetailViewModel>()
                .ForMember(x => x.VotesCount, cnf => cnf.MapFrom(x => x.Votes.Sum(v => v.Value)));
        }
    }
}