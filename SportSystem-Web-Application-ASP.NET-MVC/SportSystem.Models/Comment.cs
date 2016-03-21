namespace SportSystem.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using SportSystem.Common;

    public class Comment
    {
        [Key]
        public int Id { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [StringLength(150, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Content { get; set; }

        public DateTime? CreatedDate { get; set; }

        public string AuthorId { get; set; }

        public virtual User Author { get; set; }

        public int MatchId { get; set; }

        public virtual Match Match { get; set; }

    }
}
