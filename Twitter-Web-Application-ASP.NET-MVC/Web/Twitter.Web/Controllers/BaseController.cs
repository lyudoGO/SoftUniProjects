﻿namespace Twitter.Web.Controllers
{
    using System;
    //using System.Collections.Generic;
    using System.Linq;
    //using System.Net;
    using System.Web.Mvc;
    using System.Web.Routing;
    using Twitter.Data;
    using Twitter.Models;

    public abstract class BaseController : Controller
    {
        protected ITwitterData data;
        protected User userProfile;
        protected BaseController(ITwitterData data)
        {
            this.Data = data;
        }

        protected BaseController(ITwitterData data, User userProfile)
            :this(data)
        {
            this.UserProfile = userProfile;
        }
        protected ITwitterData Data { get; private set; }

        protected User UserProfile { get; private set; }

        protected override IAsyncResult BeginExecute(RequestContext requestContext, AsyncCallback callback, object state)
        {
            if (requestContext.HttpContext.User.Identity.IsAuthenticated)
            {
                var userName = requestContext.HttpContext.User.Identity.Name;
                var user = this.Data.Users.All().FirstOrDefault(u => u.UserName == userName);
                this.UserProfile = user;
            }
            
            return base.BeginExecute(requestContext, callback, state);
        }
    }
}
