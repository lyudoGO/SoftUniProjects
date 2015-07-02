namespace Twitter.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;
    using Twitter.Data;
    using Twitter.Web.Models;

    public class UsersController : BaseController
    {
        public UsersController(ITwitterData data)
            :base(data)
        {

        }


        //
        // GET: /User/
        [Authorize]
        public ActionResult Index()
        {
            var followers = this.UserProfile.FollowerUsers
                                .AsQueryable()
                                .Select(UserViewModel.Model)
                                .ToList();

            return this.View(followers);
        }

        // GET: /User/Profile/username
        [ActionName("Profile")]
        public ActionResult PublicProfile(string username)
        {
            if (username == null)
            {
                return this.RedirectToAction("Index", "Home");
            }

            var currentUser = this.Data.Users
                                  .All()
                                  .Select(UserProfileViewModel.Model)
                                  .FirstOrDefault(u => u.UserName == username);
 
            return this.View(currentUser);
        }

        // GET: /Users/EditProfile/
        [HttpGet]
        [Authorize]
        public ActionResult EditProfile()
        {
            var currentUser = new UserEditProfileModel
            {
                UserName = this.UserProfile.UserName,
                PhoneNumber = this.UserProfile.PhoneNumber,
                Fullname = this.UserProfile.Fullname,
                Email = this.UserProfile.Email,
            };

            return this.View(currentUser);
        }

        // POST: /Users/EditProfile/
        [HttpPost]
        [Authorize]
        [ValidateAntiForgeryToken]
        public ActionResult EditProfile(UserEditProfileModel model)
        {
            if (ModelState.IsValid && model != null)
            {
                var currentUser = this.UserProfile;

                currentUser.UserName = model.UserName;
                currentUser.PhoneNumber = model.PhoneNumber;
                currentUser.Fullname = model.Fullname;
                currentUser.Email = model.Email;

                this.Data.Users.Update(currentUser);
                this.Data.SaveChanges();

                return this.RedirectToAction("Profile", "Users", new { username = model.UserName });
            }

            return this.View(model);
        }

        // GET: /User/Details/5
        public ActionResult Details(int id)
        {
            return View();
        }

        //
        // GET: /User/Create
        public ActionResult Create()
        {
            return View();
        }

        //
        // POST: /User/Create
        [HttpPost]
        public ActionResult Create(FormCollection collection)
        {
            try
            {
                // TODO: Add insert logic here

                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }

        //
        // GET: /User/Edit/5
        public ActionResult Edit(int id)
        {
            return View();
        }

        //
        // POST: /User/Edit/5
        [HttpPost]
        public ActionResult Edit(int id, FormCollection collection)
        {
            try
            {
                // TODO: Add update logic here

                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }

        //
        // GET: /User/Delete/5
        public ActionResult Delete(int id)
        {
            return View();
        }

        //
        // POST: /User/Delete/5
        [HttpPost]
        public ActionResult Delete(int id, FormCollection collection)
        {
            try
            {
                // TODO: Add delete logic here

                return RedirectToAction("Index");
            }
            catch
            {
                return View();
            }
        }
    }
}
