namespace SportSystem.Web.Controllers
{
    using System.Collections.Generic;
    using SportSystem.Web.Models;
   
    public class HomeViewModel
    {
        public IEnumerable<TeamViewModel> Teams { get; set; }

        public IEnumerable<MatchViewModel> Matches { get; set; }
    }
}
