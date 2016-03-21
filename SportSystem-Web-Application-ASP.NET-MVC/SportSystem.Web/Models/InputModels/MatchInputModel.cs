namespace SportSystem.Web.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using SportSystem.Common;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class MatchInputModel : IMapTo<Match>
    {
        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        public int? HomeTeamId { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        public int? AwayTeamId { get; set; }

        public Team HomeTeam { get; set; }
        
        public Team AwayTeam { get; set; }

        [Display(Name = "Date of Match")]
        [DataType(DataType.Date, ErrorMessage = GlobalConstants.InvalidValidationMessage)]
        [DisplayFormat(DataFormatString = "{0:dd.MM.yyyy}", ApplyFormatInEditMode = true)]
        public DateTime MatchDate { get; set; }
    }
}