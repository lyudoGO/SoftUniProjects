namespace Twitter.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;
    using PagedList;
    //using PagedList.Mvc;
    using Twitter.Data;
    using Twitter.Web.Models;

    public class HomeController : BaseController
    {
        const int pageSize = 5;

        public HomeController(ITwitterData data)
            :base(data)
        {

        }

        // GET: /Home/
        public ActionResult Index(int? page)
        {
            if (this.UserProfile != null)
            {
                return this.RedirectToAction("Index", "Users");
            }

            int pageNumber = page ?? 1;

            IPagedList tweets = this.Data.Tweets
                                    .All()
                                    .OrderByDescending(t => t.SendDate)
                                    .Select(TweetViewModel.Model)
                                    .ToPagedList(pageNumber, pageSize);

            return this.View(tweets);
        }
    }
}