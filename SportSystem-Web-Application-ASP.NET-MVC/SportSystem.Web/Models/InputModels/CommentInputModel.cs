namespace SportSystem.Web.Models
{
    using SportSystem.Common;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Web;

    public class CommentInputModel : IMapTo<Comment>
    {
        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [Display(Name = "Comment Text")]
        [StringLength(150, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Content { get; set; }

        public string AuthorId { get; set; }

        public int MatchId { get; set; }
    }
}