<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
  <head>
    <title>Job Listing Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <style>
      body{
      background-color: rgb(47, 56, 110);
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
      font-size: 40px;
      font-weight: bold;
      color: rgb(16, 16, 128);
      }

      .sub-title{
      font-size: 25px;
      }

      .content{
      margin-top: 1rem;
      background-color: rgb(231, 231, 231);
      border: 2px solid black;
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

      .listing-form{
      width: 20rem;
      text-align: right;
      list-style-type: none;
      font-size: 18px;
      }

      .listing-form li{
      margin-bottom: 5px;
      }

      .listing-form li:last-child{
      text-align: center;
      }

      .button{
      margin-top: 1rem;
      width: 10rem;
      padding: 5px;
      font-size: 13px;
      border-radius: 0.3rem;
      border: 1px solid rgb(0, 0, 0);
      cursor: pointer;
      background-color: rgb(30, 30, 90);
      color: white;
      font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      }

      .button:hover{
      background-color: rgb(45, 45, 136);
      }

      .thankyou{
      margin-top: 0.5rem;
      border-radius: 0.5rem;
      padding: 1rem;
      padding-top: 2rem;
      padding-bottom: 2rem;
      width: 27rem;
      text-align: center;
      font-weight: bold;
      font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      background-color: rgb(231, 231, 231);
      box-shadow: 0px 0px 4px 2px rgb(38, 158, 14);
      }
   </style>
    <div class="header">
      <div class="title"> Job Listing Form </div>
      <div class="sub-title">Submit your job advertisments here to get
        posted on the job noticeboard! </div>
    </div>
    <div class="content">
      <h3>Enter your job advertisment details here:</h3>
      <div class="listing-form">
        <form action="index.php" method="post">
          <fieldset>
            <li>
              Full Name: <input type="text" name="full_name">
            </li>
            <li>
              Location: <input type="text" name="location">
            </li>
            <li>
              Date Posted: <input type="text" placeholder="DD/MM/YYYY" name="date_posted">
            </li>
            <li>
              Phone Number: <input type="text" name="phone_number">
            </li>
            <li>
              Email: <input type="email" name="email">
            </li>      
            <li>
              Job Title: <input type="text" name="job_title">
            </li>          
            <li>
              Job Description
              <br><textarea cols="42" rows="5" name="description"></textarea>
            </li>
            <input type="submit" class="button" name="submit">
           </fieldset>
         </form>
      </div>
    </div>
 
    <div class="thankyou">
      Thank you for using our service!
      <br>
      Job Listing Noticeboard is located <a href="http://127.0.0.1:8081/index.php"> Here </a>
    </div>
    <?php
      if(isset($_POST['submit'])){
        ini_set('display_errors',true);
        error_reporting(E_ALL);
        $db_host = 'job-listingdb.cedymmk96tsp.us-east-1.rds.amazonaws.com';
        $db_user = 'admin';
        $db_passwd = 'password';
        $db_name = 'job_listing';
        $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";
        try{
          $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sqlquery = "INSERT INTO JOB_LISTING (full_name, location, date_posted, job_title, description, phone_number, email)
    VALUES ('".$_POST["full_name"]."','".$_POST["location"]."','".$_POST["date_posted"]."','".$_POST["job_title"]."','".$_POST["description"]."','".$_POST["phone_number"]."','".$_POST["email"]."')";
          if($pdo->query($sqlquery)){
            echo '<script>alert("Successfully created job listing")</script>';  
          }
        }catch(PDOException $error){
          echo "Error occurred: " . $error->getMessage(); 
        }
      }
    ?>
  </body>
</html>
