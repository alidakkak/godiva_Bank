<!-- resources/views/pdf_template.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your PDF styling here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td,h1 {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1> Voucher Details</h1>
<table>
    <thead>
    <tr>

        <th>Voucher Id</th>
        <th>Customer Name</th>
        <th>Customer Phone</th>
        <th>Customer Id</th>
        <th>Created At</th>
        <th>Updated At</th>

        <!-- Add more columns as needed -->
    </tr>
    </thead>
    <tbody>
    @foreach ($vouchers as $voucher)
        <tr>
            <td >{{ "#".$voucher->id }}</td>
            <td >{{ $voucher->customer->name }}</td>
            <td>{{   $voucher->customer->phone }}</td>
            <td>{{   $voucher->customer->id }}</td>
            <td>{{   $voucher->created_at}}</td>
            <td>{{   $voucher->updated_at}}</td>
            <!-- Add more columns as needed -->
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
