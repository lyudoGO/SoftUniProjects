namespace SportSystem.Web.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Web;
    using System.Web.Mvc;
    using AutoMapper;
    using AutoMapper.QueryableExtensions;
    using SportSystem.Data.UnitOfWork;
    using SportSystem.Common;
    using SportSystem.Web.Models;
    using SportSystem.Web.Infrastructure.CacheService;

    public class HomeController : BaseController
    {
        private ICacheService cacheService;

        public HomeController()
        {
        }

        public HomeController(ISportSystemData data, ICacheService cacheService)
            :base(data)
        {
            this.cacheService = cacheService;
        }

        public ActionResult Index()
        {
            //var teams = this.Data.Teams
            //                    .All()
            //                    .OrderByDescending(b => b.Votes.Sum(v => v.Value))
            //                    .ThenBy(t => t.Name)
            //                    .Take(GlobalConstants.HomePageNumber)
            //                    .Project()
            //                    .To<TeamViewModel>()
            //                    .ToList();

            //var matches = this.Data.Matches
            //                       .All()
            //                       .OrderByDescending(m => m.Bets.Sum(v => (v.HomeBet + v.AwayBet)))
            //                       .ThenBy(m => m.Id)
            //                       .Take(GlobalConstants.HomePageNumber)
            //                       .Project()
            //                       .To<MatchViewModel>()
            //                       .ToList();

            var viewModel = new HomeViewModel
            {
                Teams = this.cacheService.Teams, 
                Matches = this.cacheService.Matches
            };

            return this.View(viewModel);
        }

    }
}