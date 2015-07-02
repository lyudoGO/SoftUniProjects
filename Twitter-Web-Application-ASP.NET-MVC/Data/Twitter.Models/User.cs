namespace Twitter.Models
{
    using Microsoft.AspNet.Identity.EntityFramework;
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.ComponentModel.DataAnnotations.Schema;

    public class User : IdentityUser
    {
        private ICollection<User> followerUsers;
        private ICollection<User> followingUsers;
        private ICollection<Tweet> tweets;
        private ICollection<Tweet> favouriteTweets;
        private ICollection<Tweet> retweetedTweets;
        private ICollection<Tweet> reportedTweets;
        private ICollection<Notification> notifications;

        public User()
        {
            this.followerUsers = new HashSet<User>();
            this.followingUsers = new HashSet<User>();
            this.tweets = new HashSet<Tweet>();
            this.favouriteTweets = new HashSet<Tweet>();
            this.retweetedTweets = new HashSet<Tweet>();
            this.reportedTweets = new HashSet<Tweet>();
            this.notifications = new HashSet<Notification>();
        }

        [MaxLength(50)]
        public string Fullname { get; set; }

        [Required]
        public DateTime RegistrationDate { get; set; }

        public virtual ICollection<User> FollowerUsers
        {
            get { return this.followerUsers; }
            set { this.followerUsers = value; }
        }

        public virtual ICollection<User> FollowingUsers
        {
            get { return this.followingUsers; }
            set { this.followingUsers = value; }
        }

        [InverseProperty("Author")]
        public virtual ICollection<Tweet> Tweets
        {
            get { return this.tweets; }
            set { this.tweets = value; }
        }

        public virtual ICollection<Tweet> FavouriteTweets
        {
            get { return this.favouriteTweets; }
            set { this.favouriteTweets = value; }
        }

        public virtual ICollection<Tweet> RetweetedTweets
        {
            get { return this.retweetedTweets; }
            set { this.retweetedTweets = value; }
        }

        public virtual ICollection<Tweet> ReportedTweets
        {
            get { return this.reportedTweets; }
            set { this.reportedTweets = value; }
        }

        public virtual ICollection<Notification> Notifiacations
        {
            get { return this.notifications; }
            set { this.notifications = value; }
        }
    }
}
