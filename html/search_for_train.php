<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>seach for train</title>
  </head>
  <body>
    <center>plan your journey<center><br>
    <!-- changed -->
    <?php
    error_reporting(E_ERROR | E_PARSE);
    ob_start();
    include('user_homepage.php');
    include('login.php');
    include('signup.php');
    ob_end_clean();

      error_reporting(E_ERROR | E_PARSE);
      $db=mysqli_connect("localhost","avantika","avantika","db1"); #port number

      if(isset($_POST['search'])){
        $from=$_POST['from'];
        $to=$_POST['to'];
        $type=$_POST['type'];

        $sql1="SELECT T.t_no,T.start_t,S.arrival_time as arrival_time from train T,station S
              WHERE T.start_station='$from' and (T.end_station='$to' or S.s_name='$to') and T.t_no=S.t_no";
        $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

        if(!$result1 || mysqli_num_rows($result1)==0){
          //output data of each row
            echo "0 results";
          }else{
            while($row=mysqli_fetch_assoc($result1)){
              //$i=$i+1;
              $train=$row['t_no'];
              $sql2=""; $fare="";
              if($type=='AC_fare'){
                $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
                $row1=mysqli_fetch_assoc($sql2);
                $fare=$row1['AC_fare'];
              }else {
                $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
                $row1=mysqli_fetch_assoc($sql2);
                $fare=$row1['g_fare'];
              }
              echo "<br><span>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
              echo "fare:".$fare."</span><br>";
              //echo "<input type='button' onclick='book('"."$i".".');' value='book ticket'/>";
          }
        }
        }
        if(isset($_POST['indirect_search'])){
          $from=$_POST['from'];
          $to=$_POST['to'];
          $type=$_POST['type'];

          $sql1="SELECT S.t_no,S.arrival_time from station S
                where t_no=(select T.t_no from station T where T.s_name='$from') and S.s_name='$to'";
          $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

          if(!$result1 || mysqli_num_rows($result1)==0){
            //output data of each row
              echo "0 results";
            }else{
              while($row=mysqli_fetch_assoc($result1)){
                //$i=$i+1;
                $train[$i]=$row['t_no'];
                $sql2=""; $fare="";
                if($type=='AC_fare'){
                  $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
                  $row1=mysqli_fetch_assoc($sql2);
                  $fare=$row1['AC_fare'];
                }else {
                  $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
                  $row1=mysqli_fetch_assoc($sql2);
                  $fare=$row1['g_fare'];
                }

                echo "<br>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
                echo "fare:".$fare."<br>";
                //echo "<input type='button' onclick='book(\"$i\")'; value='book'/>";
            }
          }
        }

     ?>
    <!-- change end -->
    <a href="book.php">want to book?</a><br>
    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>

  </body>
</html>
