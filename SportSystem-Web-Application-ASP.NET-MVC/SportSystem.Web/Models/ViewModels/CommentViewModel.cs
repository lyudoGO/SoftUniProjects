namespace SportSystem.Web.Models
{
    using System.Linq;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;
    using System;

    public class CommentViewModel : IMapFrom<Comment>, IHaveCustomMappings
    {
        public int Id { get; set; }

        public string Content { get; set; }

        public DateTime? CreatedDate { get; set; }

        public string Author { get; set; }

        public void CreateMappings(AutoMapper.IConfiguration configuration)
        {
            configuration.CreateMap<Comment, CommentViewModel>()
                .ForMember(m => m.Author, cfg => cfg.MapFrom(e => e.Author.UserName));
        }
    }
}