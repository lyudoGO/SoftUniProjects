namespace Twitter.Web.Models
{
    using System;
    using System.ComponentModel.DataAnnotations;
    using System.Linq;
    using System.Linq.Expressions;
    using System.Web;
    using Twitter.Models;

    public class UserEditProfileModel
    {
        public static Expression<Func<User, UserEditProfileModel>> Model
        {
            get
            {
                return x => new UserEditProfileModel
                {
                    UserName = x.UserName,
                    Email = x.Email,
                    Password = x.PasswordHash,
                    Fullname = x.Fullname,
                    PhoneNumber = x.PhoneNumber
                };
            }
        }

        [StringLength(15, ErrorMessage = "The {0} must be at least {2} characters long and max {1}.", MinimumLength = 3)]
        [Display(Name = "User name")]
        public string UserName { get; set; }

        [EmailAddress(ErrorMessage = "Invalid e-mail address!")]
        [DataType(DataType.EmailAddress)]
        [Display(Name = "E-mail")]
        [DisplayFormat(NullDisplayText = "Not entered")]
        public string Email { get; set; }

        [StringLength(100, ErrorMessage = "The {0} must be at least {2} characters long.", MinimumLength = 6)]
        [DataType(DataType.Password)]
        [Display(Name = "Password")]
        public string Password { get; set; }

        [StringLength(150, ErrorMessage = "The {0} must be at least {2} characters long and max {1}.", MinimumLength = 3)]
        [Display(Name = "Fullname")]
        [DisplayFormat(NullDisplayText = "Not entered")]
        public string Fullname { get; set; }

        [RegularExpression(@"^[0-9\+]{1,}[0-9\-]{3,15}$", ErrorMessage = "Invalid phone number!")]
        [DataType(DataType.PhoneNumber)]
        [Display(Name = "Phone number")]
        [DisplayFormat(NullDisplayText = "Not entered")]
        public string PhoneNumber { get; set; }
    }
}