namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;
    using System.Web.Routing;

    using SportSystem.Common.SystemMessages;
    using SportSystem.Data.UnitOfWork;
    using SportSystem.Models;

    public abstract class BaseController : Controller
    {
        protected ISportSystemData data;
        protected User userProfile;

        public BaseController()
        {
        }

        protected BaseController(ISportSystemData data)
        {
            this.Data = data;
        }

        protected BaseController(ISportSystemData data, User userProfile)
            : this(data)
        {
            this.UserProfile = userProfile;
        }

        protected ISportSystemData Data { get; private set; }

        protected User UserProfile { get; private set; }

        protected override IAsyncResult BeginExecute(RequestContext requestContext, AsyncCallback callback, object state)
        {
            var result = base.BeginExecute(requestContext, callback, state);

            if (!requestContext.HttpContext.Request.IsAjaxRequest())
            {
                // This should be after base.BeginExecute so we can access TempData
                var systemMessages = this.PrepareSystemMessages();
                this.ViewBag.SystemMessages = systemMessages;
            }

            if (requestContext.HttpContext.User.Identity.IsAuthenticated)
            {
                var userName = requestContext.HttpContext.User.Identity.Name;
                var user = this.Data.Users.All().FirstOrDefault(u => u.UserName == userName);
                this.UserProfile = user;
            }

            return result;
        }

        protected void AddSystemMessage(string message, SystemMessageType type)
        {
            this.TempData[type.ToString()] = message;
        }

        private object PrepareSystemMessages()
        {
            var messages = new List<SystemMessage>();
            if (this.TempData.ContainsKey(SystemMessageType.Information.ToString()))
            {
                messages.Add(new SystemMessage
                {
                    Content = this.TempData[SystemMessageType.Information.ToString()].ToString(),
                    Type = SystemMessageType.Information
                });
            }

            if (this.TempData.ContainsKey(SystemMessageType.Error.ToString()))
            {
                messages.Add(new SystemMessage
                {
                    Content = this.TempData[SystemMessageType.Error.ToString()].ToString(),
                    Type = SystemMessageType.Error
                });
            }

            if (this.TempData.ContainsKey(SystemMessageType.Success.ToString()))
            {
                messages.Add(new SystemMessage
                {
                    Content = this.TempData[SystemMessageType.Success.ToString()].ToString(),
                    Type = SystemMessageType.Success
                });
            }

            if (this.TempData.ContainsKey(SystemMessageType.Warning.ToString()))
            {
                messages.Add(new SystemMessage
                {
                    Content = this.TempData[SystemMessageType.Warning.ToString()].ToString(),
                    Type = SystemMessageType.Warning
                });
            }

            return messages;
        }
	}
}