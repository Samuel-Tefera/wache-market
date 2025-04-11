<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My&dash;Profile Wache Market</title>
    <link rel="stylesheet" href="../assets/css/home.css" />
    <link rel="stylesheet" href="../assets/css/profile.css" />
</head>

<body>
    <header>
        <nav class="navigation">
            <a class="logo" href="#">wache market</a>
            <ul>
                <li><a class="nav-btn" href="#">Home</a></li>
                <li><a class="nav-btn" href="#">Profile</a></li>
                <li><a class="nav-btn" href="#">Transaction</a></li>
                <li><a class="nav-btn" href="#">Cart</a></li>
                <li><a class="nav-btn sign-up__btn" href="#">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section class="profile-container">
        <div>
            <img class="profile-pic" alt="User profile image" src="../assets/images/person-img/henock.jpg" />
            <div>
                <p>Name: <span>Henock Abebe</span></p>
                <p>Email: <span>henockabebe82@gmail.com</span></p>
                <p>Address: Block-<span>12</span>, Drom &num; <span>204</span></p>
                <p>Mode: <span>Buyer</span></p>
            </div>
        </div>
        <div>
            <p>Wallet Info</p>
            <div class="wallet-info">
                <p>Amount: <span>3041.00</span> ETB </p>
                <div class="wallet-btns">
                    <a href="#">Deposit</a>
                    <a href="#">Withdraw</a>
                </div>
            </div>
            <p>User Mode</p>
            <div>
                <form action="#">
                    <input type="radio" name="mode" value="seller">Seller
                    <input type="radio" name="mode" value="seller">Buyer
                </form>
            </div>
        </div>
    </section>
</body>

</html>