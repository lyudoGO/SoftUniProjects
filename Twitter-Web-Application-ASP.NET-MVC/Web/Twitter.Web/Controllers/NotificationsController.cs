namespace Twitter.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;
    using PagedList;
    using Twitter.Data;
    using Twitter.Web.Models;

    public class NotificationsController : BaseController
    {
        const int pageSize = 3;

        public NotificationsController(ITwitterData data)
            :base(data)
        {

        }
   
        // GET: /Notifications/
        public ActionResult Index(int? page)
        {
            if (this.UserProfile == null)
	        {
		        return this.RedirectToAction("Index", "Home");
	        }

            int pageNumber = page ?? 1;

            var notifications = this.Data.Notifications
                                    .All()
                                    .Where(n => n.User.UserName == this.UserProfile.UserName)
                                    .OrderByDescending(n => n.Date)
                                    .Select(NotificationViewModel.Model)
                                    .ToPagedList(pageNumber, pageSize);

            return this.View(notifications);
        }
	}
}