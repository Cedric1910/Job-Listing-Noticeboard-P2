<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">

<html>
  <head>
    <title> Job Listings Noticeboard  </title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>

    <style> 
      body{
    http://127.0.0.1:8081/index.php
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.header{
    background-color: rgb(235, 235, 235);
    border: 1px solid black;
    text-align: center;
    padding: 1.5rem;
    width: 95%;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    box-shadow: 0px 0px 11px 3px rgba(6, 5, 44, 0.75);
}

.title{
    font-size: 50px;
    font-weight: bold;
    color: rgb(16, 16, 128);
}

.sub-title{
    font-size: 25px;
}

.content{
    margin-top: 1rem;
    background-color: rgb(231, 231, 231);
    border: 2px solid blue;
    padding: 3rem;
    padding-top: 1rem;
    padding-bottom: 1.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    max-width: 30rem;
    align-items: center;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    border-radius: 0.5rem;
    box-shadow: 0px 0px 11px 3px rgba(6, 5, 44, 0.75);}

th {
    text-align: left;
 
}

table, th, td {
    font-size: 20px;
    border: 2px solid grey;
    border-collapse: collapse;
    background-color: white;
}

th, td {
    padding: 1rem;
}


    </style>
    <div class="header"> 
      <div class= "title"> Current Job Listings </div>
      <div class ="sub-title"> This shows all the jobs currently available</div> 
    </div> 

    <table border="1" bgcolor="lightgrey" bordercolor="black">
      <tr>
        <th> Name: </th>
        <th> Location: </th>
        <th> Date posted: </th>
        <th> Job title: </th>
        <th> Description: </th>
        <th> Phone Number: </th>
        <th> Email: </th>
      </tr>
      <?php
      	$db_host = 'job-listingdb.cedymmk96tsp.us-east-1.rds.amazonaws.com';
        $db_user = 'admin';
        $db_passwd = 'password';
        $db_name = 'job_listing';
        $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";
         
         try{
        	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
        	$q = $pdo->query("SELECT * FROM JOB_LISTING;");
        	while($row = $q->fetch()){
      echo "<tr><td>".$row["full_name"]."</td><td>".$row["location"]."</td><td>".$row["date_posted"]."</td><td>".$row["job_title"]."</td><td>".$row["description"]."</td><td>".$row["phone_number"]."</td><td>".$row["email"]."</td></tr>\n"; 
      		}
        } catch(PDOException $error){
        	echo "Connection error" . $error->getMessage(); 
                      }
                      ?>
      
      </table>
  </body> 
</html> 
