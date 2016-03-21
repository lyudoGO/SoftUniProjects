namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Data.Entity;
    using System.Web.Mvc;
    using AutoMapper;
    using AutoMapper.QueryableExtensions;
    using System.Web.Mvc.Expressions;
    using PagedList;
    using SportSystem.Common;
    using SportSystem.Common.SystemMessages;
    using SportSystem.Data.UnitOfWork;
    using SportSystem.Models;
    using SportSystem.Web.Models;

    [Authorize]
    public class MatchesController : BaseController
    {
        public MatchesController(ISportSystemData data)
            :base(data)
        {
        }

        [AllowAnonymous]
        public ActionResult Index(int? page)
        {
            var matches = this.Data.Matches
                             .All()
                             .OrderBy(m => m.MatchDate)
                             .ThenBy(m => m.Id)
                             .Project()
                             .To<MatchViewModel>()
                             .ToPagedList(page ?? GlobalConstants.DefaultPageNumber, GlobalConstants.DefaultPageSize);

            return this.View(matches);
        }

        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return this.RedirectToAction(x => x.Index(GlobalConstants.DefaultPageNumber));
            }

            var matches = this.Data
                              .Matches
                              .All()
                              .Include(x => x.Comments)
                              .FirstOrDefault(b => b.Id == id);

            var teamsModel = Mapper.Map<MatchDetailViewModel>(matches);

            return this.View(teamsModel);
        }
        
        [HttpGet]
        public ActionResult Create()
        {
            this.LoadTeams();
            return this.View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(MatchInputModel model)
        {
            if (model.AwayTeamId == null || model.HomeTeamId == null || 
                model.HomeTeamId == model.AwayTeamId)
            {
                this.AddSystemMessage(string.Format("Please select teams from drop menu"), SystemMessageType.Warning);
                return this.RedirectToAction(x => x.Create());   
            }

            var existingMatch = this.Data.Matches.All().FirstOrDefault(m => m.HomeTeamId == model.HomeTeamId && 
                                                            m.AwayTeamId == model.AwayTeamId);
            if (existingMatch != null)
            {
                this.AddSystemMessage(string.Format("Match {0} - {1} allready exist!", existingMatch.HomeTeam.Name, existingMatch.AwayTeam.Name), SystemMessageType.Warning);
                return this.RedirectToAction(x => x.Create());
            }

            var homeTeam = this.Data.Teams.All().FirstOrDefault(t => t.Id == model.HomeTeamId);
            var awayTeam = this.Data.Teams.All().FirstOrDefault(t => t.Id == model.AwayTeamId);
            model.HomeTeam = homeTeam;
            model.AwayTeam = awayTeam;
            
            if (model != null && this.ModelState.IsValid)
            {
                var match = Mapper.Map<Match>(model);
                this.Data.Matches.Add(match);
                this.Data.SaveChanges();
                this.AddSystemMessage(string.Format("Match {0} - {1} added to DB.", match.HomeTeam.Name, match.AwayTeam.Name), SystemMessageType.Success);
                return this.RedirectToAction(x => x.Details(match.Id));
            }

            return this.RedirectToAction(x => x.Create());
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Bet(int id, decimal? HomeBet, decimal? AwayBet)
        {
            var match = this.Data.Matches
                                 .All()
                                 .Include(x => x.Bets)
                                 .FirstOrDefault(b => b.Id == id);

            if (match != null)
            {
                this.Data.Bets
                         .Add(new Bet
                         {
                             HomeBet = HomeBet ?? 0,
                             AwayBet = AwayBet ?? 0,
                             MatchId = id,
                             UserId = this.UserProfile.Id
                         });

                this.Data.SaveChanges();

                var homeBets = match.Bets.Sum(v => v.HomeBet);
                var awayBets = match.Bets.Sum(v => v.AwayBet);

                if (HomeBet != null)
                {
                    return this.Content(homeBets.ToString());
                }

                return this.Content(awayBets.ToString());
            }

            return new EmptyResult();
        }

        private void LoadTeams()
        {
            this.ViewBag.Teams = this.Data
                                     .Teams
                                     .All()
                                     .Select(x => new SelectListItem
                                     {
                                         Value = x.Id.ToString(),
                                         Text = x.Name
                                     });
        }
	}
}