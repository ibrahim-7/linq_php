<?php  

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use MongoDB\Client;

$username=$_POST["username"];
$password=$_POST["password"];

function connectToMySQL() {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ecomm", "root", "");
         return $pdo;
        } catch (PDOException $e) {
            echo "Coudn't connect to mysql database" .$e->getMessage();
        }
    }
    
    function executeMySQLQuery($query) {
        $pdo = connectToMySQL();
        $result = $pdo->query($query);
        return $result;
    }
    
    function connectToPostgreSQL() {
        try{
            $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=ecomm;user=postgres;password=paasword");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Coudn't connect to postgress database" .$e->getMessage();
        }
        return $pdo;
    }
    
    function executePostgreSQLQuery($query) {
        $pdo = connectToPostgreSQL();
        $result = $pdo->query($query);
        return $result;
    }
    function connectToMSAccess() {
        try {
            $db = new COM("ADODB.Connection");
            $db->Open("Provider=Microsoft.ACE.OLEDB.12.0;Data Source=C:/programming/ecomm.accdb");
            return $db;
        } catch (com_exception $e) {
            echo "Coudn't connect to ms access database" .$e->getMessage();
        }
        
    }
    
    function executeMSAccessQuery($query) {
        $db = connectToMSAccess();
        $result = $db->Execute($query);
        return $result;
    }


    function connectToMongoDB() {
        $mongoClient = new Client("mongodb://localhost:27017");
        return $mongoClient;
    }
    
    function insertDataIntoMongoDB($collectionName, $data) {
        try {
            $client = new Client("mongodb://localhost:27017");
            $database = $client->selectDatabase('ecomm'); 
            $collection = $database->selectCollection($collectionName);
            $insertResult = $collection->insertOne($data);
    
            return "Inserted document with ID: " . $insertResult->getInsertedId();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    function loadExcelFile($filename) { 
        $spreadsheet = IOFactory::load($filename);
        return $spreadsheet;

        try {
            $excelFile = 'C:/programming/data.xlsx'; 
            $spreadsheet = IOFactory::load($excelFile);
            $worksheet = $spreadsheet->getActiveSheet();
        }
        catch(PDOException $e){
            echo "Coudn't connect to excel" .$e->getMessage();
        }        


    }
    
    function insertDataIntoExcel($newData) {
        try {
            $excelFile="C:/programming/data.xlsx";
            $spreadsheet = IOFactory::load($excelFile);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $nextRow = $highestRow + 1;
            foreach ($newData as $rowData) {
                $col = 'A'; 
                foreach ($rowData as $cellValue) {
                    $worksheet->setCellValue($col . $nextRow, $cellValue);
                    $col++; 
                }
                $nextRow++; 
            }
    
            $writer = new Xlsx($spreadsheet);
            $writer->save($excelFile);
    
            return true; 
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
                


    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $mysql_insert_qry="INSERT INTO `users` ( `username`, `password`) VALUES ('$username', '$password')";
        $mysql_select_qry="SELECT * FROM `users`";

        $selectedDatabase = "MySQL  ";
        switch ($selectedDatabase) {
            case 'MySQL': 
                echo "Executing mysql query...";
                $mysql_insert_query_res = executeMySQLQuery($mysql_insert_qry);
                $mysql_select_qry_res = executeMySQLQuery($mysql_select_qry);
                break;
            
            case 'PostgreSQL': 
                echo "Executing PG query...";
                $mysql_insert_query_res = executePostgreSQLQuery($mysql_insert_qry);
                $mysql_select_qry_res = executePostgreSQLQuery($mysql_select_qry);
                break;
            
            case 'MsAccess': 
                echo "Executing MS Access query...";
                $mysql_insert_query_res = executeMySQLQuery($mysql_insert_qry);
                $mysql_select_qry_res = executeMySQLQuery($mysql_select_qry);
                break;
            
            case 'MongoDb': 
                echo "Executing MongoDB query...";
                $collectionName = 'ecomm'; 
                $data = [
                    'username' => $username,
                    'password' => $password,
                ];
                $result = insertDataIntoMongoDB($collectionName, $data);
                echo $result;
                break;
            
            case 'Excel': 
                echo "Executing Excel query..."; 
                $newData = [
                    [$username, $password]
                ];

                $result = insertDataIntoExcel($newData);
                if ($result === true) {
                    echo "Data inserted successfully.";
                } else {
                    echo $result;
                }
                break;

            default:
                echo "Invalid database selection.";
                break;
        }
}
?>
        
