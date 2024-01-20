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
            border-radius: 15%;
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

        .balance {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        #transaction-form {
            background-color: #ecf0f1;
            float: right;
            padding: 1em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
        }

        #transaction-form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        #transaction-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #transaction-form button {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
        }

        #transaction-form button:hover {
            background-color: #216a94;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="bank of nepal.png" alt="Logo">
            <h1>Welcome to Bank Of Nepal</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button>Search</button>
            <button onclick="signOut()">Sign Out</button>
           

        </div>
    </header>

    <nav>
        <a href="/class-3/page.php">Home</a>
        <a href="#about">About Us</a>
        <a href="#findmore">Find More</a>
        <a href="#services">Services</a>
        <a href="#contract">Contract</a>
    </nav>

    <main>
        

    <div id="transaction-form">
    <h2>Transaction Form</h2>
    <p class="balance" id="balance-display">Current Balance: $1000.00</p>

    <form id="bank-transaction-form" onsubmit="submitTransaction(); return false;">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>

        <label for="transaction-type">Transaction Type:</label>
        <select id="transaction-type" name="transaction-type" required>
            <option value="deposit">Deposit</option>
            <option value="withdrawal">Withdrawal</option>
        </select>

        <button type="submit">Submit</button>
    </form>
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

        // Function to simulate submitting a transaction (for demonstration purposes)
        function submitTransaction() {
            const amountInput = document.getElementById('amount');
            const transactionTypeSelect = document.getElementById('transaction-type');
            const balanceDisplay = document.getElementById('balance-display');

            // Get the amount and transaction type from the form
            const amount = parseFloat(amountInput.value);
            const transactionType = transactionTypeSelect.value;

            // Simulate updating the balance (replace this with server-side logic)
            let currentBalance = 1000; // Replace with the actual current balance from the server
            if (transactionType === 'deposit') {
                currentBalance += amount;
            } else {
                // Ensure sufficient balance for withdrawal
                if (amount <= currentBalance) {
                    currentBalance -= amount;
                } else {
                    alert('Insufficient funds!');
                    return;
                }
            }

            // Update the balance display
            balanceDisplay.textContent = `Current Balance: $${currentBalance.toFixed(2)}`;

            // Additional logic to send the transaction data to the server should be implemented here
            function signOut() {
            // Simulate signing out logic (replace with actual sign-out logic)
            alert('Signing out...'); // You can remove this line in a real implementation

            // Redirect to the home page (replace '/home' with the actual home page URL)
            window.location.href = 'page.php';
        }
        }
    </script>
</body>

</html>
