namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using Microsoft.AspNet.Identity;
    using AutoMapper;
    using AutoMapper.QueryableExtensions;
    using System.Web.Mvc;
    using SportSystem.Web.Models;
    using SportSystem.Common.SystemMessages;
    using System.Net;
    using SportSystem.Data.UnitOfWork;
    using SportSystem.Models;

    [Authorize]
    public class CommentsController : BaseController
    {
        public CommentsController(ISportSystemData data)
            : base(data)
        {
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Add(CommentInputModel model)
        {
            if (model != null && this.ModelState.IsValid)
            {
                model.AuthorId = this.UserProfile.Id;
                var comment = Mapper.Map<Comment>(model);

                this.Data.Comments.Add(comment);
                this.Data.SaveChanges();

                var createdComment = this.Data.Comments
                                         .All()
                                         .Where(c => c.Id == comment.Id)
                                         .Project()
                                         .To<CommentViewModel>()
                                         .FirstOrDefault();

                this.AddSystemMessage(string.Format("Comment from {0} added.", createdComment.Author), SystemMessageType.Success);
                return this.PartialView("DisplayTemplates/CommentViewModel", createdComment);
            }

            this.AddSystemMessage("Cannot add comment!", SystemMessageType.Error);
            return this.Json(this.ModelState);
        }

        [HttpPost]
        public ActionResult Delete(int id)
        {
            var comment = this.Data.Comments.All().FirstOrDefault(c => c.Id == id);
            if (comment != null && this.User.Identity.GetUserId() == comment.AuthorId)
            {
                this.Data.Comments.Delete(comment);
                this.Data.SaveChanges();

                this.AddSystemMessage(string.Format("Comment {0} was deleted.", comment.Id), SystemMessageType.Success);
                return this.Content(string.Empty);
            }

            return new HttpStatusCodeResult(HttpStatusCode.BadRequest, "Cannot delete comment!");
        }
	}
}