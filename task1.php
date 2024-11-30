<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Table Display</title>
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
        }
        .container {
            width: 80%;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Table 1 will be displayed here -->
        <h1>Table 1: Data from CSV</h1>
        <table id="table1">
            <thead>
                <tr>
                    <th>Index #</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here -->
            </tbody>
        </table>

        <!-- Table 2 will be displayed here -->
        <h1>Table 2: Calculated Values</h1>
        <table id="table2">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Alpha</td><td id="alpha"></td></tr>
                <tr><td>Beta</td><td id="beta"></td></tr>
                <tr><td>Charlie</td><td id="charlie"></td></tr>
            </tbody>
        </table>
    </div>

    <script>
        // Fetch the CSV file and parse it
        fetch('Table_Input.csv') // Make sure your CSV file is correctly placed in your web app directory
            .then(response => response.text())
            .then(csvText => {
                const rows = csvText.split('\n');
                const table1Data = [];
                
                rows.forEach((row, index) => {
                    if (index > 0) { // Skip the header row
                        const columns = row.split(',');
                        if (columns.length > 1) {
                            table1Data.push({
                                index: columns[0].trim(),
                                value: columns[1].trim()
                            });
                        }
                    }
                });

                // Populate Table 1 with data
                const table1Body = document.querySelector("#table1 tbody");
                table1Data.forEach(data => {
                    const row = document.createElement("tr");
                    row.innerHTML = `<td>${data.index}</td><td>${data.value}</td>`;
                    table1Body.appendChild(row);
                });

                // Calculate Table 2 values based on the CSV data
                const A5 = parseInt(table1Data.find(item => item.index === "A5").value);
                const A20 = parseInt(table1Data.find(item => item.index === "A20").value);
                const A15 = parseInt(table1Data.find(item => item.index === "A15").value);
                const A7 = parseInt(table1Data.find(item => item.index === "A7").value);
                const A13 = parseInt(table1Data.find(item => item.index === "A13").value);
                const A12 = parseInt(table1Data.find(item => item.index === "A12").value);

                // Calculate and update Table 2 values
                document.getElementById("alpha").textContent = A5 + A20;
                document.getElementById("beta").textContent = (A15 / A7); // Division result
                document.getElementById("charlie").textContent = A13 * A12;
            })
            .catch(error => console.error('Error loading CSV file:', error));
    </script>
</body>
</html>
