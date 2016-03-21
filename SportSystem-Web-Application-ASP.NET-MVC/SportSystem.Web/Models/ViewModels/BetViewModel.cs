namespace SportSystem.Web.Models
{
    using SportSystem.Common.Mappings;
    using SportSystem.Models;

    public class BetViewModel : IMapFrom<Bet>
    {
        public decimal HomeBet { get; set; }

        public decimal AwayBet { get; set; }
    }
}