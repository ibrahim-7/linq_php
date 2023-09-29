function showConnectionCode(databaseType) {
    var connectionCode = '';
    switch (databaseType) {
        case 'MySQL':
            connectionCode = `$mysqlPDO = new PDO("mysql:host=localhost;dbname=ecomm", "username", "password");`;
            break;
        case 'PostgreSQL':
            connectionCode = `$postgresPDO = new PDO("pgsql:host=localhost;port=5432;dbname=ecomm;user=postgres;password=paasword");`;
            break;
        case 'MsAccess':
            connectionCode = `$accessPDO = new PDO("Provider=Microsoft.ACE.OLEDB.12.0;Data Source=C:/programming/ecomm.accdb");`;
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