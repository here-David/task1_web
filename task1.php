<!DOCTYPE html>
<html>
<head>
    <title>Task 1 - Table Processing</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Table 1 - Input Data</h2>
    <table>
        <tr>
            <th>Index #</th>
            <th>Value</th>
        </tr>
        <?php
        // Read the CSV file
        $file = fopen("Table_Input.csv", "r");
        $data = [];
        $headers = fgetcsv($file); // Read the header row

        while (($row = fgetcsv($file)) !== false) {
            $data[$row[0]] = (int)$row[1];
            echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td></tr>";
        }
        fclose($file);
        ?>
    </table>

    <h2>Table 2 - Processed Values</h2>
    <table>
        <tr>
            <th>Category</th>
            <th>Value</th>
        </tr>
        <?php
        // Process calculations
        $alpha = $data['A5'] + $data['A20'];
        $beta = $data['A15'] / ($data['A7'] > 0 ? $data['A7'] : 1); // Avoid division by zero
        $charlie = $data['A13'] * $data['A12'];

        // Display Table 2
        echo "<tr><td>Alpha</td><td>{$alpha}</td></tr>";
        echo "<tr><td>Beta</td><td>{$beta}</td></tr>";
        echo "<tr><td>Charlie</td><td>{$charlie}</td></tr>";
        ?>
    </table>
</body>
</html>
