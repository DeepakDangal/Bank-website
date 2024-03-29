<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #004080;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: left;
            float: left;
        }

        .logo img {
            width: 150px;
            height: auto;
            margin-right: 10px;
            border-radius: 15%;
        }

        .logo h1 {
            font-size: 1.5em;
            margin: 0;
        }

        .search-bar {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        input[type="text"] {
            padding: 0.5em;
            border: none;
            border-radius: 4px;
            margin-right: 0.5em;
            font-size: 14px;
        }

        button {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 0.5em 1em;
            border-radius: 4px;
            cursor: pointer;
        }

        nav {
            background-color: #004080;
            color: #fff;
            padding: 0.5em;
            text-align: right;
            float: right;

        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 1em;
            margin: 0 0.5em;
        }

        main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 2em;
            flex: 1;
        }

        footer {
            background-color: #004080;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .outer {
            display: inline-block;
            width: 100%;
        }

        #exchange-rate-board {
            background-color: #ecf0f1;
            float: right;
            padding: 1em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
        }

        #exchange-rate-list {
            list-style: none;
            padding: 0;
        }

        .exchange-rate-item {
            margin-bottom: 0.5em;
        }
    </style>
</head>

<body>
 <!--  <header>
        <div class="logo">
            <img src="bank of nepal.png" alt="Logo">
            <h1>Welcome to Bank Of Nepal</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
    </header>

    <nav>
        <a href="/class-3/login.php">Login</a>
        <a href="#about">About Us</a>
        <a href="#findmore">Find More</a>
        <a href="#services">Services</a>
        <a href="#contract">Contract</a>
    </nav> !-->
<?php include('header.php');?>
    <main>
        <div class="outer">
            <div id="exchange-rate-board">
                <h2>Exchange Rates Today</h2>
                <ul id="exchange-rate-list"></ul>
            </div>
        </div>
    </main>

   <footer>
        <p>Contact us at: contact@bankofnepal.com</p>
    </footer> 
    

    <script>
        // Fetch and update exchange rates every second
        const exchangeRateApiUrl = 'https://open.er-api.com/v6/latest';

        function fetchExchangeRates() {
            fetch(exchangeRateApiUrl)
                .then(response => response.json())
                .then(data => {
                    const exchangeRateList = document.getElementById('exchange-rate-list');
                    exchangeRateList.innerHTML = ''; // Clear previous entries

                    // Assuming the API returns an object with rates property containing exchange rates
                    const rates = data.rates;

                    // Get the top 5 currencies
                    const topCurrencies = Object.keys(rates).slice(0, 5);

                    // Iterate through the top currencies and add exchange rate items
                    for (const currency of topCurrencies) {
                        const rate = rates[currency];
                        const listItem = document.createElement('li');
                        listItem.classList.add('exchange-rate-item');
                        listItem.textContent = `${currency}: ${rate.toFixed(2)}`;
                        exchangeRateList.appendChild(listItem);
                    }
                })
                .catch(error => console.error('Error fetching exchange rates:', error));
        }

        // Fetch exchange rates on page load
        fetchExchangeRates();

        // Update exchange rates every second
        setInterval(fetchExchangeRates, 1000);
    </script>
</body>

</html>
