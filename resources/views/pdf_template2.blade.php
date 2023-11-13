<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirement</title>
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
            color: #333;
        }

        /* Heading styles */
        h1 {
            text-align: center;
            color:#3f8fff;
            margin-bottom: 20px;
        }
        h2 {

            color: darkslategrey;
            margin-bottom: 20px;
        }
        h3 {

            color: #000000;
            margin-bottom: 20px;
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Other element styles */
        p,image {
            color: grey;
            font-weight: bold;
            line-height: 1.5;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>  Real estate CRM</h1>
    <br>
    <ol>
        <h2>Dashboard :</h2>
        <li><h3>Customer Data Management :</h3></li>
        <p>Save the customer's personal information such as name,email,password,... ;</p>
        <p>Save the customer's order information such as
            property,created at,rent or buy, Bank acceptance status:accept,reject,hanging ; </p>
        <li><h3>Property Search and filter :</h3></li>
        <p>such as price,location,space;</p>
        <li><h3>Scheduling :</h3></li>
        <p>organize appointments with customer;</p>
        <li><h3>Tracking Deal :</h3></li>
        <p>Bank acceptance,meeting with customer ,signing of the contract,Close deal</p>
        <image style="display: block;margin: auto"  width="800px" hight="500px" src="{{asset("Screenshot (153).png")}}" ></image>
        <li><h3>Financial Management :</h3></li>
        <p>inventory : calculate all output and input money; </p>
        <p>show all order for customer; </p>
        <li><h3>Reporting and Analytics :</h3></li>
        <p>number employee,proptory,customer,bank acceptance or reject </p>
        <li><h3>CRUD proptory :</h3></li>
        <p>rate,rent or buy ,rate,location,images </p>
        <li><h3>employee data :</h3></li>
        <p>name,age ,....; </p>
    </ol>
    <br>
    <ol>
        <h2>website :</h2>
        <li><h3>Login</h3></li>
        <li><h3>Property Search and filter :</h3></li>
        <p>such as price,location,space;</p>
        <li><h3>show reservation for customer :</h3></li>
        <p>property,created at,rent or buy,Bank acceptance status:accept,reject,hanging </p>
    </ol>
</div>
</body>
</html>
