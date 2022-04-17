<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FoneMart</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <form method="post" id="signup">
        <div class="box">
            <div class="box__header">
                <h1>SIGN UP</h1>
            </div>
            <div class="box__main">
                <div class="form__item block">
                    <input type="text" class="form__input" placeholder=" " id="fullname">
                    <label class="form__label">Full Name</label>
                    <span class="message"></span>
                </div>
                <div class="form__item block">
                    <input type="text" class="form__input" placeholder=" " id="username">
                    <label class="form__label">Username</label>
                    <span class="message"></span>
                </div>
                <div class="form__item block">
                    <input type="text" class="form__input" placeholder=" " id="address">
                    <label class="form__label">Address</label>
                    <span class="message"></span>
                </div>
                <div class="form__item">
                    <input type="email" class="form__input" placeholder=" " id="email">
                    <label class="form__label">Email</label>
                    <span class="message"></span>
                </div>
                <div class="form__item">
                    <input type="number" class="form__input" placeholder=" " id="phone">
                    <label class="form__label">Phone Number</label>
                    <span class="message"></span>
                </div>
                <div class="form__item">
                    <input type="password" class="form__input" placeholder=" " id="password">
                    <label class="form__label">Password</label>
                    <span class="message"></span>
                </div>
                <div class="form__item">
                    <input type="password" class="form__input" placeholder=" " id="confirmPw">
                    <label class="form__label">Confirm Password</label>
                    <span class="message"></span>
                </div>
            </div>
            <div class="box__footer">
                <button class="btn">Sign up</button>
                <a href="login.php">I already have an account</a>
            </div>
        </div>
    </form>
</body>
<script src="../assets/js/validation.js"></script>
<script>
Validation({
    'form': '#signup',
    'rules': [
        isRequired('#fullname'),
        isRequired('#username'),
        isRequired('#email'),
        isRequired('#phone'),
        isRequired('#password'),
        isRequired('#confirmPw'),
        isRequired('#address'),
        isEmail('#email'),
        isPhone('#phone'),
        isStrongPw('#password'),
        minLength('#fullname', 8),
        minLength('#fullname', 5),
        confirmPassword('#confirmPw', function() {
            return document.querySelector('#password').value;
        })
    ]
})
</script>

</html>