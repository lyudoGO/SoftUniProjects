namespace Twitter.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.ComponentModel.DataAnnotations.Schema;

    public class Tweet
    {
        //protected ICollection<User> allowedUsers;
        protected ICollection<User> favouriteUsers;
        protected ICollection<User> retweetedUsers;
        protected ICollection<User> reportedUsers;

        public Tweet()
        {
            //this.allowedUsers = new HashSet<User>();
            this.favouriteUsers = new HashSet<User>();
            this.retweetedUsers = new HashSet<User>();
            this.reportedUsers = new HashSet<User>();
        }

        [Key]
        public int Id { get; set; }

        [Required]
        [MaxLength(140)]
        public string Text { get; set; }

        public DateTime SendDate { get; set; }

        public string AuthorId { get; set; }

        public virtual User Author { get; set; }

        //public virtual ICollection<User> AllowedUsers 
        //{
        //    get { return this.allowedUsers;}
        //    set { this.allowedUsers = value; } 
        //}

        [InverseProperty("FavouriteTweets")]
        public virtual ICollection<User> FavouriteUsers
        {
            get { return this.favouriteUsers; }
            set { this.favouriteUsers = value; }
        }

        [InverseProperty("RetweetedTweets")]
        public virtual ICollection<User> RetweetedUsers
        {
            get { return this.retweetedUsers; }
            set { this.retweetedUsers = value; }
        }

        [InverseProperty("ReportedTweets")]
        public virtual ICollection<User> ReportedUsers
        {
            get { return this.reportedUsers; }
            set { this.reportedUsers = value; }
        }
    }
}
