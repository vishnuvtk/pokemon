<?php
    // Connect to the MySQL database
    $connect = mysqli_connect(
        'localhost', 
        'root',
        'root',
        'pokemon_db');        

    if(!$connect){
        echo 'Error Code: ' . mysqli_connect_errno();
        echo 'Error Message: ' . mysqli_connect_error();
        exit;
    }    

    $query = 'SELECT `Name`, `Type`, `Health`, `Attack`, `Defense`, `Speed`, `Media`, `DateOfBirth` FROM pokemon';

    $results = mysqli_query($connect, $query);

    if(!$results){
        echo 'Error Message: '. mysqli_error($connect);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <h1>Pokémon List</h1>

    <?php
        // Checking if results exist and output the data in a table
        if($results && $results->num_rows > 0){
            echo '<table>';
            echo '<tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Health</th>
                    <th>Attack</th>
                    <th>Defense</th>
                    <th>Speed</th>
                    <th>Image</th>
                    <th>Date of Birth</th>
                  </tr>';
            
            foreach ($results as $result) {
                echo '<tr>';
                echo '<td>' . $result['Name'] . '</td>';
                echo '<td>' . $result['Type'] . '</td>';
                echo '<td>' . $result['Health'] . '</td>';
                echo '<td>' . $result['Attack'] . '</td>';
                echo '<td>' . $result['Defense'] . '</td>';
                echo '<td>' . $result['Speed'] . '</td>';
                echo '<td><img src="' . $result['Media'] . '" alt="' . $result['Name'] . '"></td>';
                echo '<td>' . $result['DateOfBirth'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No Pokémon found in the database.</p>';
        }

        // Closing the database connection
        mysqli_close($connect);
    ?>
</body>
</html>
