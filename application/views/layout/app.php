<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php echo $this->template->meta; ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>image/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo base_url();?>image/favicon.png">
    <title>Penang Property Angel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo base_url();?>dist/index.css">
    <?php echo $this->template->stylesheet; ?>
</head>
<body>
<!----------------------Header ------------------------->
<header>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="<?php echo url('/');?>"><img src="<?php echo url('image/logo_1.png');?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">FEATURES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('buy/');?>">BUY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('rent/');?>">RENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('agents');?>">AGENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SELL/LEASE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BLOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('foreigner-handbook');?>">FOREIGNER'S HANDBOOK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT</a>
                </li>
                <li class="nav-item con_none">
                    <a class="nav-link con_none_a" href="#">CONTACT</a>
                </li>
            </ul>
            <ul class="navbar-nav icon">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-envelope-o"></i></a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="dropdown-menu">
                        <?php if(isLogged()) {?>
                            <a class="dropdown-item logoutBtn" href="javascript:void(0);" onclick="return logout();"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">REGISTRATION</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal_1">LOGIN</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php echo $this->template->content; ?>
<!----------------------Footer ------------------------->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <ul>
                    <li><a href="">FEATURES</a></li>
                    <li><a href="">BUY</a></li>
                    <li><a href="">RENT</a></li>
                    <li><a href="">AGENTS</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12">
                <ul>
                    <li><a href="">SELL/LEASE</a></li>
                    <li><a href="">BLOG</a></li>
                    <li><a href="">FOREIGNER'S HANDBOOK</a></li>
                    <li><a href="">ABOUT</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12 footer_1">
                <ul>
                    <li><a href="">CONTACT</a></li>
                    <li><a href="">PRIVACY POLICY</a></li>
                    <li><a href="">TERMS & CONDITIONS</a></li>

                </ul>
            </div>
            <div class="col-md-3 col-12 footer_2">
                <img src="<?php echo url('image/footer_1.png');?>" alt="">
            </div>
        </div>
    </div>
</footer>
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <p><i class="fa fa-copyright"></i> Copyright 2010 penangpropertyangel.com</p>
            </div>
            <div class="col-md-6 col-12 power">
                <p>powered by<img src="<?php echo url('image/footer_2.png');?>" alt=""></p>
            </div>
        </div>
    </div>
</section>
<!-- The Modal -->
<div class="modal register" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">


            <!-- Modal body -->
            <div class="modal-body" id="my-container">
                <div class="container signup-form">
                    <h2>REGISTRATION NOW</h2>
                    <form name="<?php echo $registerForm['name'];?>" id="<?php echo $registerForm['name'];?>" class="was-validated" action="<?php echo $registerForm['action'];?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" name="firstname" autocomplete="off" required>
                            <!--                            <div class="valid-feedback">Valid.</div>-->
                            <!--                            <div class="invalid-feedback">Please fill out this field.</div>-->
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-lastname" placeholder="Enter Lastname" name="lastname" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-email" placeholder="Email Address" name="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-password" placeholder="Enter password" name="password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-confirm" placeholder="Repeat password" name="confirm" autocomplete="off" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="input-agree" type="checkbox" name="agree" required>
                                I agree.
                            </label>
                        </div>
                        <button type="submit" class="btn send">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal register" id="myModal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="loginFormContainer">
                <div class="container loginForm">
                    <h2>SIGN IN</h2>
                    <form name="<?php echo $loginForm['name'];?>" id="<?php echo $loginForm['name'];?>" class="was-validated" action="<?php echo $loginForm['action'];?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-login-email" placeholder="Enter username" name="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-login-password" placeholder="Enter password" name="password" autocomplete="off" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="input-remember" type="checkbox" name="remember" <?php if(isset($_COOKIE["remember_me"])) { ?> checked <?php } ?>>
                                Remember Me.
                            </label>
                        </div>
                        <button type="submit" class="btn send">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>dist/index.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php echo $this->template->javascript; ?>
<script>
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';
    function logout () {
        window.location.href = myLabel.baseUrl + 'logout';
        // return true or false, depending on whether you want to allow the `href` property to follow through or not
    }

    // Loan Calculator
    function calculate() {
        //Look up the input and output elements in the document
        var amount = document.getElementById("amount");
        var downPayment = document.getElementById("down-payment");
        var apr = document.getElementById("apr");
        var years = document.getElementById("years");
        var payment = document.getElementById("payment");
        var total = document.getElementById("total");
        var totalinterest = document.getElementById("totalinterest");
        // Get the user's input from the input elements.
        // Convert interest from a percentage to a decimal, and convert from
        // an annual rate to a monthly rate. Convert payment period in years
        // to the number of monthly payments.
        if(downPayment.length > 0) {
            var principal = parseFloat(downPayment.value - amount.value);
        } else {
            var principal = parseFloat(amount.value);
        }
        var interest = parseFloat(apr.value) / 100 / 12;
        var payments = parseFloat(years.value) * 12;

        // compute the monthly payment figure
        var x = Math.pow(1 + interest, payments); //Math.pow computes powers
        var monthly = (principal*x*interest)/(x-1);

        // If the result is a finite number, the user's input was good and
        // we have meaningful results to display

        if (!isNaN(monthly) &&
            (monthly != Number.POSITIVE_INFINITY) &&
            (monthly != Number.NEGATIVE_INFINITY)) {
            console.log(1);
            // Fill in the output fields, rounding to 2 decimal places
            //payment = monthly.toFixed(2);
            //total.innerHTML = (monthly * payments).toFixed(2);
            //totalinterest.innerHTML = ((monthly*payments)-principal).toFixed(2);
            try { // Catch any errors that occur within these curly braces
                payment.value = (monthly * payments).toFixed(2);
                save(amount.value, apr.value, years.value, downPayment.value, payment.value);
            } catch(e) { /* And ignore those errors */ }
        }
        else {
            console.log(2);
            // Result was Not-a-Number or infinite, which means the input was
            // incomplete or invalid. Clear any previously displayed output.
            payment.value = ""; // Erase the content of these elements
           // total.innerHTML = ""
            //totalinterest.innerHTML = "";
            //  chart(); // With no arguments, clears the chart
        }
    }
    function resetCalculator() {
        if (window.localStorage) {
            localStorage.loan_amount = "";
            localStorage.down = "";
            localStorage.loan_apr = "";
            localStorage.loan_years = "";
            localStorage.payemnt = "";
        }
        document.getElementById("amount").value         = "";
        document.getElementById("apr").value            = "";
        document.getElementById("years").value          = "";
        document.getElementById("down-payment").value   = "";
        document.getElementById("payment").value        = "";
    }
    // Save the user's input as properties of the localStorage object. Those
    // properties will still be there when the user visits in the future
    // This storage feature will not work in some browsers (Firefox, e.g.) if you
    // run the example from a local file:// URL. It does work over HTTP, however.
    function save(amount, apr, years, down, payment) {
        if (window.localStorage) { // Only do this if the browser supports it
            localStorage.loan_amount = amount;
            localStorage.loan_apr = apr;
            localStorage.loan_years = years;
            localStorage.down = down;
            localStorage.payment = payment;
        }
    }
    // Automatically attempt to restore input fields when the document first loads.
    window.onload = function() {
        // If the browser supports localStorage and we have some stored data
        if (window.localStorage && localStorage.loan_amount) {
            document.getElementById("amount").value = localStorage.loan_amount;
            document.getElementById("apr").value = localStorage.loan_apr;
            document.getElementById("years").value = localStorage.loan_years;
            document.getElementById("down-payment").value = localStorage.down;
            document.getElementById("payment").value = localStorage.payment;
            //   document.getElementById("zipcode").value = localStorage.loan_zipcode;
        }
    };

    // Pass the user's input to a server-side script which can (in theory) return
    // a list of links to local lenders interested in making loans. This example
    // does not actually include a working implementation of such a lender-finding
    // service. But if the service existed, this function would work with it.
    function getLenders(amount, apr, years, zipcode) {
        // If the browser does not support the XMLHttpRequest object, do nothing
        if (!window.XMLHttpRequest) return;
        // Find the element to display the list of lenders in
        var ad = document.getElementById("lenders");
        if (!ad) return; // Quit if no spot for output

        // Encode the user's input as query parameters in a URL
        var url = "getLenders.php" + // Service url plus
            "?amt=" + encodeURIComponent(amount) + // user data in query string
            "&apr=" + encodeURIComponent(apr) +
            "&yrs=" + encodeURIComponent(years) +
            "&zip=" + encodeURIComponent(zipcode);
        // Fetch the contents of that URL using the XMLHttpRequest object
        var req = new XMLHttpRequest(); // Begin a new request
        req.open("GET", url); // An HTTP GET request for the url
        req.send(null); // Send the request with no body
        // Before returning, register an event handler function that will be called
        // at some later time when the HTTP server's response arrives. This kind of
        // asynchronous programming is very common in client-side JavaScript.
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status == 200) {
                // If we get here, we got a complete valid HTTP response
                var response = req.responseText; // HTTP response as a string
                var lenders = JSON.parse(response); // Parse it to a JS array
                // Convert the array of lender objects to a string of HTML
                var list = "";
                for(var i = 0; i < lenders.length; i++) {
                    list += "<li><a href='" + lenders[i].url + "'>" +
                        lenders[i].name + "</a>";
                }
                // Display the HTML in the element from above.
                ad.innerHTML = "<ul>" + list + "</ul>";
            }
        }
    }

    // Chart monthly loan balance, interest and equity in an HTML <canvas> element.
    // If called with no arguments then just erase any previously drawn chart.
    function chart(principal, interest, monthly, payments) {
        var graph = document.getElementById("graph"); // Get the <canvas> tag
        graph.width = graph.width; // Magic to clear and reset the canvas element
        // If we're called with no arguments, or if this browser does not support
        // graphics in a <canvas> element, then just return now.
        if (arguments.length == 0 || !graph.getContext) return;
        // Get the "context" object for the <canvas> that defines the drawing API
        var g = graph.getContext("2d"); // All drawing is done with this object
        var width = graph.width, height = graph.height; // Get canvas size
        // These functions convert payment numbers and dollar amounts to pixels
        function paymentToX(n) { return n * width/payments; }
        function amountToY(a) { return height-(a * height/(monthly*payments*1.05));}
        // Payments are a straight line from (0,0) to (payments, monthly*payments)
        g.moveTo(paymentToX(0), amountToY(0)); // Start at lower left
        g.lineTo(paymentToX(payments), // Draw to upper right
            amountToY(monthly*payments));

        g.lineTo(paymentToX(payments), amountToY(0)); // Down to lower right
        g.closePath(); // And back to start
        g.fillStyle = "#f88"; // Light red
        g.fill(); // Fill the triangle
        g.font = "bold 12px sans-serif"; // Define a font
        g.fillText("Total Interest Payments", 20,20); // Draw text in legend
        // Cumulative equity is non-linear and trickier to chart
        var equity = 0;
        g.beginPath(); // Begin a new shape
        g.moveTo(paymentToX(0), amountToY(0)); // starting at lower-left
        for(var p = 1; p <= payments; p++) {
            // For each payment, figure out how much is interest
            var thisMonthsInterest = (principal-equity)*interest;
            equity += (monthly - thisMonthsInterest); // The rest goes to equity
            g.lineTo(paymentToX(p),amountToY(equity)); // Line to this point
        }
        g.lineTo(paymentToX(payments), amountToY(0)); // Line back to X axis
        g.closePath(); // And back to start point
        g.fillStyle = "green"; // Now use green paint
        g.fill(); // And fill area under curve
        g.fillText("Total Equity", 20,35); // Label it in green
        // Loop again, as above, but chart loan balance as a thick black line
        var bal = principal;
        g.beginPath();
        g.moveTo(paymentToX(0),amountToY(bal));
        for(var p = 1; p <= payments; p++) {
            var thisMonthsInterest = bal*interest;
            bal -= (monthly - thisMonthsInterest); // The rest goes to equity
            g.lineTo(paymentToX(p),amountToY(bal)); // Draw line to this point
        }
        g.lineWidth = 3; // Use a thick line
        g.stroke(); // Draw the balance curve
        g.fillStyle = "black"; // Switch to black text
        g.fillText("Loan Balance", 20,50); // Legend entry
        // Now make yearly tick marks and year numbers on X axis
        g.textAlign="center"; // Center text over ticks
        var y = amountToY(0); // Y coordinate of X axis
        for(var year=1; year*12 <= payments; year++) { // For each year
            var x = paymentToX(year*12); // Compute tick position
            g.fillRect(x-0.5,y-3,1,3); // Draw the tick
            if (year == 1) g.fillText("Year", x, y-5); // Label the axis
            if (year % 5 == 0 && year*12 !== payments) // Number every 5 years
                g.fillText(String(year), x, y-5);
        }
        // Mark payment amounts along the right edge
        g.textAlign = "right"; // Right-justify text
        g.textBaseline = "middle"; // Center it vertically
        var ticks = [monthly*payments, principal]; // The two points we'll mark
        var rightEdge = paymentToX(payments); // X coordinate of Y axis
        for(var i = 0; i < ticks.length; i++) { // For each of the 2 points
            var y = amountToY(ticks[i]); // Compute Y position of tick

            g.fillRect(rightEdge-3, y-0.5, 3,1); // Draw the tick mark
            g.fillText(String(ticks[i].toFixed(0)), // And label it.
                rightEdge-5, y);
        }
    }
</script>
</body>
</html>