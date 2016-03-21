namespace SportSystem.Web.Models
{
    using System.Collections.Generic;
    using System.Linq;
    using System.ComponentModel.DataAnnotations;

    using SportSystem.Common;
    using SportSystem.Common.Mappings;
    using SportSystem.Models;
    using System;

    public class MatchDetailViewModel : IMapFrom<Match>
    {
        public int Id { get; set; }

        public int HomeTeamId { get; set; }

        public virtual Team HomeTeam { get; set; }

        public int AwayTeamId { get; set; }

        public virtual Team AwayTeam { get; set; }

        [Display(Name = "Home Bet:")]
        [DataType(DataType.Currency)]
        [RegularExpression(@"\d+(.|,)\d{0,2}", ErrorMessage = GlobalConstants.CurrencyValidationMessage)]
        public decimal HomeBet { get; set; }

        [Display(Name = "Away Bet:")]
        [RegularExpression(@"\d+(.|,)\d{0,2}", ErrorMessage = GlobalConstants.CurrencyValidationMessage)]
        public decimal AwayBet { get; set; }

        public DateTime MatchDate { get; set; }

        public ICollection<BetViewModel> Bets { get; set; }

        public ICollection<CommentViewModel> Comments { get; set; }
    }
}