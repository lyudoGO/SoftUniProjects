namespace Twitter.Web.Models
{
    using System;
    using System.Linq.Expressions;
    using Twitter.Models;

    public class TweetViewModel
    {
        public static Expression<Func<Tweet, TweetViewModel>> Model
        {
            get
            {
                return x => new TweetViewModel
                {
                    Text = x.Text,
                    SendDate = x.SendDate,
                    Author = x.Author.UserName
                };
            }
        }

        public string Text { get; set; }

        public DateTime SendDate { get; set; }

        public string Author { get; set; }
    }
}
