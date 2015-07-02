namespace Twitter.Web.Models
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Linq.Expressions;
    using Twitter.Models;

    public class UserViewModel
    {
        public static Expression<Func<User, UserViewModel>> Model
        {
            get
            {
                return x => new UserViewModel
                {
                    UserName = x.UserName,
                    Email = x.Email,
                    Fullname = x.Fullname,
                    Tweets = x.Tweets.AsQueryable().Select(TweetViewModel.Model),
                };
            }
        }

        public string UserName { get; set; }

        public string Email { get; set; }

        public string Fullname { get; set; }

        public virtual IEnumerable<TweetViewModel> Tweets { get; set; }

    }
}