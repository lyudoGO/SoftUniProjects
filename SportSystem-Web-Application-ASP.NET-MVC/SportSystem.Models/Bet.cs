namespace SportSystem.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Text;
    using System.Threading.Tasks;

    public class Bet
    {
        [Key]
        public int Id { get; set; }

        [DataType(DataType.Currency)]
        public decimal HomeBet { get; set; }

        [DataType(DataType.Currency)]
        public decimal AwayBet { get; set; }

        public int MatchId { get; set; }

        public virtual Match Match { get; set; }

        public string UserId { get; set; }

        public virtual User User { get; set; }
    }
}
