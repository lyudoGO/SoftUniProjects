namespace SportSystem.Web.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class PlayerViewModel : IMapFrom<Player>
    {
        public int Id { get; set; }

        public string Name { get; set; }

        [DisplayFormat(DataFormatString = "{0:dd.MM.yyyy)")]
        public DateTime BirthDate { get; set; }

        public double Height { get; set; }
    }
}