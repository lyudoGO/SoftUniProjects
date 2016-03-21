namespace SportSystem.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Text;
    using System.Threading.Tasks;
    using SportSystem.Common;

    public class Player
    {
        [Key]
        public int Id { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [StringLength(50, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Name { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [DataType(DataType.Date)]
        public DateTime BirthDate { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        public double Height { get; set; }

        public int? TeamId { get; set; }

        public virtual Team Team { get; set; }
    }
}
