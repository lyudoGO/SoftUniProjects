namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Data.Entity;
    using System.Web.Mvc;
    using Microsoft.AspNet.Identity;

    using AutoMapper;
    using AutoMapper.QueryableExtensions;
    using PagedList;
    using System.Web.Mvc.Expressions;

    using SportSystem.Data.UnitOfWork;
    using SportSystem.Models;
    using SportSystem.Web.Models;
    using SportSystem.Common;
    using SportSystem.Common.SystemMessages;

    [Authorize]
    public class TeamsController : BaseController
    {
        public TeamsController(ISportSystemData data)
            :base(data)
        {
        }

        [AllowAnonymous]
        public ActionResult Index(int? page)
        {
            var teams = this.Data.Teams
                                .All()
                                .OrderBy(b => b.Name)
                                .Project()
                                .To<TeamViewModel>()
                                .ToPagedList(page ?? GlobalConstants.DefaultPageNumber, GlobalConstants.DefaultPageSize);

            return this.View(teams);
        }
        
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return this.RedirectToAction(x => x.Index(GlobalConstants.DefaultPageNumber));
            }

            var teams = this.Data.Teams
                               .All()
                               .Include(x => x.Votes)
                               .FirstOrDefault(b => b.Id == id);
            var teamsModel = Mapper.Map<TeamDetailViewModel>(teams);

            var userId = this.User.Identity.GetUserId();
            teamsModel.UserHasVote = teams.Votes.Any(x => x.UserId == userId);

            return this.View(teamsModel);
        }

        [HttpGet]
        public ActionResult Create()
        {
            this.LoadFreePlayers();
            return this.View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(TeamInputModel model)
        {
            var existingTeam = this.Data.Teams.All().FirstOrDefault(t => t.Name == model.Name);
            if (existingTeam != null)
            {
                this.AddSystemMessage(string.Format("Team {0} allready exist.", existingTeam.Name), SystemMessageType.Warning);
                return this.RedirectToAction(x => x.Create());
            }

            if (model != null && this.ModelState.IsValid)
            {
                var team = Mapper.Map<Team>(model);
                this.Data.Teams.Add(team);

                foreach (var playerId in model.PlayersId)
                {
                    if (playerId != 0)
                    {
                        var player = this.Data.Players.All().FirstOrDefault(x => x.Id == playerId);
                        player.Team = team;
                        this.AddSystemMessage(string.Format("Player {0} added to team {1}.", player.Name, team.Name), SystemMessageType.Information);
                    }
                }

                this.Data.SaveChanges();
                this.AddSystemMessage(string.Format("Team {0} added to DB.", team.Name), SystemMessageType.Success);

                return this.RedirectToAction(x => x.Details(team.Id));
            }

            this.LoadFreePlayers();
            return this.View(model);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Vote(int id)
        {
            var team = this.Data.Teams
                               .All()
                               .FirstOrDefault(b => b.Id == id);

            if (team != null)
            {
                var userHasVote = team.Votes.Any(v => v.UserId == this.User.Identity.GetUserId());
                if (!userHasVote)
                {
                    this.Data.Votes.Add(new Vote
                    {
                        TeamId = team.Id,
                        UserId = this.User.Identity.GetUserId(),
                        Value = 1
                    });

                    this.Data.SaveChanges();
                }

                var votesCount = team.Votes.Sum(v => v.Value);
                return this.Content(votesCount.ToString());
            }

            return new EmptyResult();
        }

        [HttpGet]
        public ActionResult GetPlayersList()
        {
            this.LoadFreePlayers();
            return this.PartialView("_ListPlayersPartial");
        }

        private void LoadFreePlayers()
        {
            this.ViewBag.Players = this.Data
                                       .Players
                                       .All()
                                       .Where(x => x.TeamId == null)
                                       .Select(x => new SelectListItem
                                       {
                                            Value = x.Id.ToString(),
                                            Text = x.Name
                                       });
        }
	}
}