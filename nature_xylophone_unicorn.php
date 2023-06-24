<?php 
 
// Initializing Variables
$url = "https://www.savethesea.org/";
$name = "Save the Sea";
$followers = 0;

// Establishing Database Connection
$conn = new mysqli("localhost", "root", "password", "savethesea");

// Checking Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserting Data Into Database
$sql = "INSERT INTO savethesea (url, name, followers) 
        VALUES ('$url', '$name', '$followers')";

if ($conn->query($sql) === TRUE) {
    echo "Data successfully added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
// Closing Connection
$conn->close();

// Creating an Interactive page
echo "<html>
  <head>
    <title>" . $name . "</title>
  </head>
  <body>
    <h1>" . $name . "</h1>
    <h3> Followers: " . $followers . "</h3>
    <a href='$url'>" . $name . "</a>
  </body>
</html>";

//Controller Code
class SaveTheSeaController
{
    public function index()
    {
        $url = "https://www.savethesea.org/";
        $name = "Save the Sea";
        $data = array('name' => $name, 'url' => $url);
        return view('savethesea.index', $data);
    }
 
    public function update(Request $request)
    {
        // Establishing Database Connection
        $conn = new mysqli("localhost", "root", "password", "savethesea");
 
        // Checking Connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
 
        // Updating Data in Database
        $name = "Save the Sea";
        $followers = $request->input('followers');
        $sql = "UPDATE savethesea SET followers = '$followers' WHERE name = '$name'";
 
        if ($conn->query($sql) === TRUE) {
            echo "Data successfully updated in database";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
 
        // Closing Connection
        $conn->close();
 
        return redirect()->route('savethesea.index');
    }
}

//Routes Code
Route::get('/savethesea', 'SaveTheSeaController@index');
Route::post('/savethesea/update', 'SaveTheSeaController@update');

//CRUD Code
public static function create($name, $url, $followers)
{
    // Establishing Database Connection
    $conn = new mysqli("localhost", "root", "password", "savethesea");

    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Inserting Data Into Database
    $sql = "INSERT INTO savethesea (url, name, followers) 
            VALUES ('$url', '$name', '$followers')";

    if ($conn->query($sql) === TRUE) {
        echo "Data successfully added to database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Closing Connection
    $conn->close();
}

public static function read($name)
{
    // Establishing Database Connection
    $conn = new mysqli("localhost", "root", "password", "savethesea");

    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieving Data From Database
    $sql = "SELECT * FROM savethesea WHERE name = '$name'";
    $result = $conn->query($sql);

    // Processing Result Set
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data = array($row['name'], $row['url'], $row['followers']);
        }
    } else {
        echo "0 results";
    }

    // Closing Connection
    $conn->close();

    return $data;
}

public static function update($name, $followers)
{
    // Establishing Database Connection
    $conn = new mysqli("localhost", "root", "password", "savethesea");

    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Updating Data in Database
    $sql = "UPDATE savethesea SET followers = '$followers' WHERE name = '$name'";

    if ($conn->query($sql) === TRUE) {
        echo "Data successfully updated in database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Closing Connection
    $conn->close();
}

public static function delete($name)
{
    // Establishing Database Connection
    $conn = new mysqli("localhost", "root", "password", "savethesea");

    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Deleting Data From Database
    $sql = "DELETE FROM savethesea WHERE name = '$name'";

    if ($conn->query($sql) === TRUE) {
        echo "Data successfully deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Closing Connection
    $conn->close();
}

//Image Upload Code
public static function uploadImage($name)
{
    // Establishing Database Connection
    $conn = new mysqli("localhost", "root", "password", "savethesea");

    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieving Data From Database
    $sql = "SELECT * FROM savethesea WHERE name = '$name'";
    $result = $conn->query($sql);

    // Processing Result Set
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $url = $row['url'];
        }
    } else {
        echo "0 results";
    }

    // Uploading Image
    $imgData = base64_encode(file_get_contents($url));
    $src = 'data:image/png;base64,'.$imgData;

    // Closing Connection
    $conn->close();

    return $src;
}

?>