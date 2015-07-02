namespace Twitter.Web.Models
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Linq.Expressions;
    using Twitter.Models;

    public class UserProfileViewModel
    {
        public static Expression<Func<User, UserProfileViewModel>> Model
        {
            get
            {
                return x => new UserProfileViewModel
                {
                    UserName = x.UserName,
                    Email = x.Email,
                    Fullname = x.Fullname,
                    Tweets = x.Tweets.AsQueryable().Select(TweetViewModel.Model),
                    Followers = x.FollowerUsers.AsQueryable().Select(UserViewModel.Model),
                    Followings = x.FollowingUsers.AsQueryable().Select(UserViewModel.Model),
                    Favorites = x.FavouriteTweets.AsQueryable().Select(TweetViewModel.Model)
                };
            }
        }

        public string UserName { get; set; }

        public string Email { get; set; }

        public string Fullname { get; set; }

        public virtual IEnumerable<TweetViewModel> Tweets { get; set; }

        public virtual IEnumerable<UserViewModel> Followers { get; set; }

        public virtual IEnumerable<UserViewModel> Followings { get; set; }

        public virtual IEnumerable<TweetViewModel> Favorites { get; set; }

    }
}