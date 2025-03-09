<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steganography</title>
    <style media="screen">
        html, body {
            color: #333;
            font-family: "Poppins", sans-serif;
            width: 100%;
            height: 100%;
            background-color: #f0f4f8;
            overflow-x: hidden;
        }

        ::selection {
            background-color: #82c0ff;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav .logo {
            font-size: 1.8rem;
            font-weight: 600;
            color: #007acc;
            font-family: 'Poiret One', cursive;
        }

        nav .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
        }

        nav .nav-links li {
            margin: 0 1rem;
        }

        nav .nav-links a {
            color: #333;
            text-decoration: none;
            font-weight: 400;
            position: relative;
            transition: color 0.3s;
        }

        nav .nav-links a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #007acc;
            transition: width 0.3s;
        }

        nav .nav-links a:hover {
            color: #007acc;
        }

        nav .nav-links a:hover::after {
            width: 100%;
        }

 .main-content {
            display: flex;
            justify-content: space-between;
            height: calc(100vh - 70px);
            align-items: center;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .left-side,
        .right-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .left-side {
            animation: slideInLeft 1s ease-in-out;
        }

        .left-side .encrypt-button,
        .left-side .decrypt-button {
            padding: 1rem 7rem;
            margin: 1rem 10rem;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            font-family: 'Montserrat', sans-serif;
            color: #ffffff;
            border-radius: 12px;
            background: linear-gradient(145deg, #caf0f8, #82c0ff);
            box-shadow: 3px 3px 6px #c2e9fb, -3px -3px 6px #ffffff;
            transition: all 0.3s ease;
        }

        .left-side .encrypt-button:hover,
        .left-side .decrypt-button:hover {
            background: linear-gradient(145deg, #82c0ff, #007acc);
            box-shadow: 5px 5px 10px #82c0ff, -5px -5px 10px #ffffff;
            transform: translateY(-3px);
        }

        .right-side {
            animation: slideInRight 1s ease-in-out;
        }

        .right-side img {
            max-width: 90%;
            border-radius: 15px;
            margin-right: 10rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            nav .nav-links {
                flex-direction: column;
                align-items: flex-start;
                background: rgba(255, 255, 255, 0.8);
                position: absolute;
                top: 90px;
                left: 0;
                right: 0;
                padding: 10px 0;
                display: none;
                border-radius: 12px;
            }

            nav .nav-links li {
                margin: 0.5rem 0;
                width: 100%;
                text-align: center;
            }

            nav .nav-links.show {
                display: flex;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
            }

            .menu-toggle .bar {
                width: 25px;
                height: 3px;
                background-color: #333;
                margin: 5px 0;
                transition: 0.3s;
            }

            .menu-toggle.active .bar1 {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .menu-toggle.active .bar2 {
                opacity: 0;
            }

            .menu-toggle.active .bar3 {
                transform: rotate(45deg) translate(-5px, -6px);
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Data Encryption and Steganography</div>
        <div class="menu-toggle" id="mobile-menu">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="uses.html">about</a></li>
            <li><a href="uses.html#usermanual">User Manual</a></li>
            <li><a href="history.php">history</a></li>
            <li><a href="index.php?action=logout">Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="left-side">
            <button class="encrypt-button" onclick="location.href='encryption.html';">Encryption</button>
            <button class="encrypt-button" onclick="location.href='decryption.html';">Decryption</button>
        </div>
        <div class="right-side" style="background-size:cover;">
            <img src="img/bg.png" alt="Steganography Image" width="400px">
        </div>
    </div>

    <script src="js/encrypt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script>
        document.getElementById('mobile-menu').addEventListener('click', function () {
            document.querySelector('.nav-links').classList.toggle('show');
            this.classList.toggle('active');
        });
    </script>
</body>
</html>