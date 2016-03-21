namespace SportSystem.Web.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;

    using SportSystem.Common;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class TeamInputModel : IMapTo<Team>
    {
        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [StringLength(50, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Name { get; set; }

        [Display(Name = "Nickname")]
        [StringLength(30, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 3)]
        public string NickName { get; set; }

        [Url(ErrorMessage = GlobalConstants.InvalidValidationMessage)]
        public string WebSite { get; set; }

        [Display(Name = "Date Founded")]
        [DataType(DataType.Date, ErrorMessage = GlobalConstants.InvalidValidationMessage)]
        [DisplayFormat(DataFormatString = "{0:dd-MM-yyyy}", ApplyFormatInEditMode = true)]
        public DateTime? DateFounded { get; set; }

        public HashSet<int> PlayersId { get; set; }

    }
}