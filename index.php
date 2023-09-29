<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINQ</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body> 
    <div class="frame">
        <h2>Frame 1 - Select Database</h2>
        <div class="button-container">
            <button class="custom-button" id="mysqlButton" onclick="showConnectionCode('MySQL')" name="MySQL">MySQL</button>
            <button class="custom-button" id="pgsqlButton" onclick="showConnectionCode('PostgreSQL')" name="PostgreSQL">PostgreSQL</button> 
            <button class="custom-button" id="pgsqlButton" onclick="showConnectionCode('MsAccess')" name="MsAccess">Ms Access</button> 
            <button class="custom-button" id="pgsqlButton" onclick="showConnectionCode('Excel')" name="Excel">Excel</button> 
            <button class="custom-button" id="pgsqlButton" onclick="showConnectionCode('MongoDb')" name="MongoDb">Mongo Db</button> 
        </div>
    </div>
 
    <div class="frame">
        <h2>Frame 2 - Connection Code</h2>
        <pre id="connectionCode"></pre>
    </div>
 
    <div class="frame">
        <h2>Frame 3 - Enter User Data</h2>
        <form id="userDataForm" method="post" action="db_conn.php">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter your username" name="username">
            <label for="username">Password</label>
            <input type="text" id="password" placeholder="Enter your password" name="password">
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
 
    <div class="frame">
        <h2>Frame 4 - Inserted Data</h2>
        <div id="insertedData"></div>
    </div>
 
</body>
</html>
