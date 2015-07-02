namespace Twitter.Web.Models
{
    using System;
    using System.Linq.Expressions;
    using Twitter.Models;

    public class NotificationViewModel
    {
        public static Expression<Func<Notification, NotificationViewModel>> Model
        {
            get
            {
                return x => new NotificationViewModel
                {
                    Content = x.Content,
                    Date = x.Date,
                    UserName = x.User.UserName
                };
            }
        }

        public string UserName { get; set; }

        public string Content { get; set; }

        public DateTime Date { get; set; }
    }
}