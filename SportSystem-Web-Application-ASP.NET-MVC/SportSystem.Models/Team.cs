namespace SportSystem.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Text;
    using System.Threading.Tasks;
    using SportSystem.Common;

    public class Team
    {
        protected ICollection<Player> players;
        protected ICollection<Vote> votes;
        protected ICollection<Match> matches;

        public Team()
        {
            this.players = new HashSet<Player>();
            this.votes = new HashSet<Vote>();
            this.matches = new HashSet<Match>();
        }

        [Key]
        public int Id { get; set; }

        [Required(ErrorMessage = GlobalConstants.RequiredValidationMessage)]
        [StringLength(50, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 5)]
        public string Name { get; set; }

        [StringLength(30, ErrorMessage = GlobalConstants.StringLengthValidationMessage, MinimumLength = 3)]
        public string NickName { get; set; }

        [DataType(DataType.Url)]
        [Url]
        public string WebSite { get; set; }

        [DataType(DataType.DateTime)]
        public DateTime? DateFounded { get; set; }

        public virtual ICollection<Player> Players
        {
            get { return this.players; }
            set { this.players = value; }
        }

        public virtual ICollection<Vote> Votes
        {
            get { return this.votes; }
            set { this.votes = value; }
        }

        public virtual ICollection<Match> Matches
        {
            get { return this.matches; }
            set { this.matches = value; }
        }
    }
}
