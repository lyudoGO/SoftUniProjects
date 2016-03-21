namespace SportSystem.Web.Models
{
    using System.Collections.Generic;
    using System.Linq;

    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class TeamViewModel : IMapFrom<Team>, IHaveCustomMappings
    {
        public int Id { get; set; }

        public string Name { get; set; }

        public string WebSite { get; set; }

        public int? VotesCount { get; set; }

        public void CreateMappings(AutoMapper.IConfiguration configuration)
        {
            configuration.CreateMap<Team, TeamViewModel>()
                .ForMember(x => x.VotesCount, cnf => cnf.MapFrom(x => x.Votes.Sum(v => v.Value)));
        }
    }
}