function showConnectionCode(databaseType) {
    var connectionCode = '';
    switch (databaseType) {
        case 'MySQL':
            connectionCode = `$mysqlPDO = new PDO("mysql:host=localhost;dbname=mydb", "username", "password");`;
            break;
        case 'PostgreSQL':
            connectionCode = `$postgresPDO = new PDO("pgsql:host=localhost;dbname=mydb", "username", "password");`;
            break;
        case 'MsAccess':
            connectionCode = `$accessPDO = new PDO("odbc:DSN=MyAccessDSN");`;
            break;
        case 'MongoDb':
            connectionCode = `require 'vendor/autoload.php'; use MongoDB\Client;  $mongoClient = new Client("mongodb://localhost:27017");`;
            break;
        case 'Excel':
            connectionCode = `require 'vendor/autoload.php';use PhpOffice\PhpSpreadsheet\IOFactory; $excelSpreadsheet = IOFactory::load('my_excel_file.xlsx');`;
            break;
        default:
            connectionCode = 'Invalid database type.';
    }
    document.getElementById('connectionCode').textContent = connectionCode;
} 