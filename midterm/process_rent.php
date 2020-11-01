<?php
    $link=mysqli_connect ('localhost','root','20172041','sakila');

    if(mysqli_connect_error()){

        echo "MariaDB 접속에 실패했습니다.";
        echo "<br>";
        echo mysqli_connect_error();
        exit(); #연결 종료
    }

    if(isset($_GET['id'])){
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
  } else {
      $filtered_id = mysqli_real_escape_string($link, $_POST['id']);
  }

  $query = "SELECT * FROM payment where customer_id='{$filtered_id}' limit 10";
    $result = mysqli_query($link, $query);
    $article='';

    while ($row=mysqli_fetch_array($result)){ // reulst에는 배열로 저장되었고
        #이를 fetch_arry를 통해서 한줄씩 가져옴
        #가져온 결과를 article에 저장함 -> 초기화 필요
        $article.='<tr><td></td>';
        $article.='<td>';

        $article.=$row['rental_id'];
        $article .='</td><td>';
        $article.=$row['amount'];
        $article .='</td><td>';

        $article.=$row['payment_date'];
        $article .='</td><td>';

        $article.=$row['last_update'];
        $article .='</td><td>';

        $article.='</tr>';//닫을 때는 거꾸로 닫아줌
    }

    if(isset($_GET['id'])){
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
  } else {
      $filtered_id = mysqli_real_escape_string($link, $_POST['id']);
  }

  $query = "select sum(amount) from payment left join customer
  on payment.customer_id =customer.customer_id
  where payment.customer_id='{$filtered_id}' ";
    $result = mysqli_query($link, $query);
    $info='';

  while ($row=mysqli_fetch_array($result)){
  $info.='<tr><td>';
            $info.=$row['sum(amount)'];
      $info.='</td>';
      $info.='</tr>';
  }


mysqli_free_result($result);//할당 되었던 리소스를 반납
mysqli_close($link);//링크연결 종료

?>

<!DOCTYPE html>
<head>
<title>@media query</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
 <style>
 a:link { color: white; text-decoration: none;}
 a:visited { color: white; text-decoration: none;}
 a:hover { color: white; text-decoration: underline;}
 p.margin {

     margin-top: 6px;

     margin-bottom: 6px;

     margin-right: 6px;

     margin-left: 6px;}

#nav{background-color:#3b4063; height:50px; font-size: 25px; color: white;
 font-family: "Comic Sans", "Apple Chancery", cursive; font-style: italic;}
#nav{margin:0 0 10px 0; padding:0px;}
#nav li{display:inline;}
table {
    width 100%;
}
th,
td {
    padding: 10px;
    border-bottom: px soid #dadada;
}

@media screen and (max-width: 480px)
{}
.main_right_btn {

width:50%;

height:600px;

background-color:#eeddee;

float:left;}


.main_left_btn {

width:50%;

height:600px;

background-color:#eeddee;

float:left;}

.main_list {

width:100%;

height:80px;
color: white;

background-color:#3b4063;

float:left;}



</style>


</head>

<body>

<img src='1.jpg' width='1400' height='400'>
<ul id="nav">
<li cal><a href="index.php"> &nbsp;Home  |</a></li>
<li><a href="Actor.php">Actor    |</a></li>
<li><a href="Movie.php">Movie    |</a></li>
<li><a href="Rent.php">Rent</a></li>
</ul>

<div>
  <div class="main_left_btn">
    <h1>&nbsp;&nbsp;   ---Search Rental list------</h1>
    <table>
            <tr>
              <th></th>
                <th>rental_id</th>
                <th>amount</th>
                <th>payment_date</th>
                <th>last_update</th>

              </tr>
     <?= $article?>
              </table>
  </div>

  <div class="main_right_btn">
    <br>
    <br>
    <table>
      <br>
            <tr>

            <h2>  ●Total number of customers with costomer_id = <?=$filtered_id?> ●</h2>
              <th></th>
              <?= $info?>
            </tr>
     </table>
     <img src='3.jpg' width='400' height='400'>
  </div>

  <div class="main_list">  <p style="text-align:center">Filmmaker: Marvel Company
  Company Contact: pmj7755@naver.com</div>



</body>

</html>