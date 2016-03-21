namespace SportSystem.Web.Controllers
{
    using System.Linq;
    using System.Web.Mvc;
    using System.Web.Mvc.Expressions;
    using AutoMapper;
    using AutoMapper.QueryableExtensions;
    using PagedList;
    using SportSystem.Common;
    using SportSystem.Common.SystemMessages;
    using SportSystem.Data.UnitOfWork;
    using SportSystem.Models;
    using SportSystem.Web.Models;

    [Authorize]
    public class PlayersController : BaseController
    {
        public PlayersController(ISportSystemData data)
            :base(data)
        {
        }

        [AllowAnonymous]
        public ActionResult Index(int? page)
        {
            var players = this.Data
                              .Players
                              .All()
                              .OrderBy(p => p.Name)
                              .ThenBy(p => p.BirthDate)
                              .Project()
                              .To<PlayerViewModel>()
                              .ToPagedList(page ?? GlobalConstants.DefaultPageNumber, GlobalConstants.DefaultPageSize);

            return this.View(players);
        }

        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return this.RedirectToAction(x => x.Index(GlobalConstants.DefaultPageNumber));
            }

            var player = this.Data
                             .Players
                             .All()
                             .FirstOrDefault(p => p.Id == id);

            var playerModel = Mapper.Map<PlayerDetailViewModel>(player);

            return this.View(playerModel);
        }

        [HttpGet]
        public ActionResult Create()
        {
            return this.View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(PlayerInputModel model)
        {
            var existPlayer = this.Data
                                  .Players
                                  .All()
                                  .Any(p => p.Name == model.Name);
            if (existPlayer)
            {
                this.AddSystemMessage(string.Format("Player {0} allready exist!", model.Name), SystemMessageType.Warning);
                return this.RedirectToAction(x => x.Create());
            }
            if (model != null && this.ModelState.IsValid)
            {
                var player = Mapper.Map<Player>(model);
                this.Data.Players.Add(player);
                this.Data.SaveChanges();
                this.AddSystemMessage(string.Format("Player {0} added to DB!", model.Name), SystemMessageType.Success);
                return this.RedirectToAction(x => x.Details(player.Id));
            }

            this.AddSystemMessage(string.Format("Somting go wrong!"), SystemMessageType.Warning);
            return this.RedirectToAction(x => x.Create());
        }
	}
}