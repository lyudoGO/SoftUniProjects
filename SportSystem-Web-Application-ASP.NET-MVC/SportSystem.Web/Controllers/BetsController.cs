namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;

    [Authorize]
    public class BetsController : BaseController
    {
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult DoBet(int matchId)
        {
            var userId = this.UserProfile.Id;

            return null;
        }
	}
}