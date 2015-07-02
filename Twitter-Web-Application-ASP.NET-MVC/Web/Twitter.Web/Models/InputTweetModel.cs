namespace Twitter.Web.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Linq.Expressions;
    using System.Web;
    using Twitter.Models;

    public class InputTweetModel
    {
        public static Expression<Func<Tweet, InputTweetModel>> Model
        {
            get
            {
                return x => new InputTweetModel
                {
                    Text = x.Text,
                 };
            }
        }

        [Required]
        [Display(Name = "Tweet message")]
        [StringLength(140, ErrorMessage = "The {0} must be at least {2} characters long and max {1}.", MinimumLength = 3)]
        public string Text { get; set; }

        public DateTime CreatedDate { get; set; }

        public string AuthorId { get; set; }
    }
}