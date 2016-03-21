namespace SportSystem.Web.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using SportSystem.Common;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class PlayerInputModel : IMapTo<Player>
    {
        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [StringLength(50, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Name { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [DataType(DataType.Date)]
        public DateTime BirthDate { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [DisplayFormat(DataFormatString = "{0:0.00}", ApplyFormatInEditMode = true)]
        public double Height { get; set; }

        public int? TeamId { get; set; }
    }
}