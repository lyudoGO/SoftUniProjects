namespace SportSystem.Web.Models
{
    using SportSystem.Common.Mappings;
    using SportSystem.Models;
    using System.ComponentModel.DataAnnotations;

    public class BetInputModel : IMapTo<Bet>
    {
        [DataType(DataType.Currency)]
        public decimal HomeBet { get; set; }

        [DataType(DataType.Currency)]
        public decimal AwayBet { get; set; }

        public int MatchId { get; set; }

        public string UserId { get; set; }
    }
}