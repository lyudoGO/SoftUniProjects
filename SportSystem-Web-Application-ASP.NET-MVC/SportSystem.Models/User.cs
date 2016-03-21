namespace SportSystem.Models
{
    using System.Collections.Generic;
    using Microsoft.AspNet.Identity.EntityFramework;
    using System.Threading.Tasks;
    using System.Security.Claims;
    using Microsoft.AspNet.Identity;

    public class User : IdentityUser
    {
        protected ICollection<Comment> comments;
        protected ICollection<Bet> bets;

        public User()
        {
            this.comments = new HashSet<Comment>();
            this.bets = new HashSet<Bet>();
        }

        public ICollection<Comment> Comments 
        {
            get { return this.comments; }
            set { this.comments = value; }
        }

        public ICollection<Bet> Bets
        {
            get { return this.bets; }
            set { this.bets = value; }
        }

        public async Task<ClaimsIdentity> GenerateUserIdentityAsync(UserManager<User> manager)
        {
            // Note the authenticationType must match the one defined in CookieAuthenticationOptions.AuthenticationType
            var userIdentity = await manager.CreateIdentityAsync(this, DefaultAuthenticationTypes.ApplicationCookie);
            // Add custom user claims here
            return userIdentity;
        }
    }
}
