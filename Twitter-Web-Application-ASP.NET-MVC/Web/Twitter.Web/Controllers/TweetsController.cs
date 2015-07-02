namespace Twitter.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Threading.Tasks;
    using System.Web;
    using System.Web.Mvc;
    using Twitter.Data;
    using Twitter.Models;
    using Twitter.Web.Models;

    public class TweetsController : BaseController
    {
        public TweetsController(ITwitterData data)
            :base(data)
        {

        }

        // GET: /Tweets/Create
        //[HttpGet]
        //[Authorize]
        //public ActionResult Create()
        //{
        //    return this.RedirectToAction("Index", "Users");
        //}

        // POST: /Tweets/Create
        [HttpPost]
        [Authorize]
        [ValidateAntiForgeryToken]
        public ActionResult Create(InputTweetModel model)
        {
            //this.HttpContext.Cache.Remove("tweets");

            if (ModelState.IsValid && model != null)
            {
                var tweet = new Tweet
                {
                    AuthorId = this.UserProfile.Id,
                    SendDate = DateTime.Now,
                    Text = model.Text
                };

                this.Data.Tweets.Add(tweet);
                this.Data.SaveChanges();

                return this.RedirectToAction("Index", "Users"); 
            }

            return this.View("_CreateTweetPartial", model);
        }
	}
}