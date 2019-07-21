<?php

require 'include/orm.php';

$date = date("d/m/Y");

  //
  $VS5=(int)$_POST['VS5'];
  $MB11=(int)$_POST['MB11'];
  $CF=(int)$_POST['CF'];

//function to get lesser index based on the
// product packing and quantity comparision
function getLessIndex($packList,$start,$num)
{
    for ($i=$start;$i<count($packList);$i++)
    {
        if((int)$packList[$i]['pack_of']>$num)
        {
            $i++;
        }else{
            return $i;
        }
    }
}


  if ($VS5!=0)
  {

      //query to fetch product packing data in descending order of packing
      $product = ORM::for_table('packs')->where('product_id','VS5')->order_by_desc('pack_of')->find_many();
      //array count of product's packing listing in table
      $arrayLength= count($product);
      $i=1;
      $num1 = 1;
      $num2=1;
      $result=array();

      while ($num1!=0||$num2!=0)
      {

          for ($j=0; $j<$arrayLength;$j++)
          {

              //calling function to check whether product and requested quantity is greater than first index
              $index=getLessIndex($product,$j+1,$product[$i-1]['pack_of']);
              //mod operation on requested quantity and highest available packing of product
              $num1=$VS5%(int)$product[$i-1]['pack_of'];
              //fetching quotient of mod operation
              $quotient1=intdiv($VS5,(int)$product[$i-1]['pack_of']);

              //var_dump($quotient1.' X '.$product[$i-1]['pack_of'].' '.(float)$product[$i-1]['price'],'VS5');

              //storing of 
              if ($num1==0)
              {
                  $num2=0;
                  $result[(int)$_POST['VS5'].' VS5'][$quotient1][$product[$i-1]['pack_of']]=[(float)$product[$i-1]['price']];
                  break;
              }else{
                  $VS5 =$num1;
              }
              if ($quotient1!=0)
              {
                  $result[(int)$_POST['VS5'].' VS5'][$quotient1][$product[$i-1]['pack_of']]=[(float)$product[$i-1]['price']];
              }
              $index=getLessIndex($product,$j+1,$num1);
              $num2=$num1%(int)$product[$index]['pack_of'];
              if ($num2 != 0 )
              {

                  continue;
              }
              $quotient2=intdiv($VS5,(int)$product[$index]['pack_of']);
              if ($num2 == 0)
              {
                  $num1=0;
                  if ($quotient2!=0)
                  {
                      $result[(int)$_POST['VS5'].' VS5'][$quotient2][$product[$index]['pack_of']]=[(float)$product[$index]['price']];
                  }
                  break;
              }else{
                  $VS5 = $num2;
              }
              $i++;
          }
      }
  }

  if ($MB11!=0)
  {

      $product = ORM::for_table('packs')->where('product_id','MB11')->order_by_desc('pack_of')->find_many();
      $arrayLength= count($product);
      $i=1;
      $num1 = 1;
      $num2=1;

      while ($num1!=0||$num2!=0)
      {

          for ($j=0; $j<$arrayLength;$j++)
          {

              $index=getLessIndex($product,$j+1,$product[$i-1]['pack_of']);

              $num1=$MB11%(int)$product[$i-1]['pack_of'];
              $quotient1=intdiv($MB11,(int)$product[$i-1]['pack_of']);

              //var_dump($MB11,'q1=',$quotient1,'n1=',$num1);
              if ($num1==0)
              {
                  $num2=0;
                  $result[(int)$_POST['MB11'].' MB11'][$quotient1][$product[$i-1]['pack_of']]=[(float)$product[$i-1]['price']];
                  break;
              }else{
                  $MB11 = $num1;
              }
              if ($quotient1!=0)
              {
                  $result[(int)$_POST['MB11'].' MB11'][$quotient1][$product[$i-1]['pack_of']]=[(float)$product[$i-1]['price']];
              }
              //var_dump($quotient1.' X '.$product[$i-1]['pack_of'].' '.(float)$product[$i-1]['price'],'MB11-1');

              $index=getLessIndex($product,$j+1,$num1);
              $num2=$num1%(int)$product[$index]['pack_of'];
              if ($num2 != 0 )
              {
                  continue;
              }
              $quotient2=intdiv($MB11,(int)$product[$index]['pack_of']);

              if ($num2 == 0)
              {
                  $num1=0;
                  if ($quotient2!=0)
                  {
                      $result[(int)$_POST['MB11'].' MB11'][$quotient2][$product[$index]['pack_of']]=[(float)$product[$index]['price']];
                  }

                  //var_dump($quotient2.' X '.$product[$index]['pack_of'].' '.(float)$product[$index]['price'],'MB11-2');
                  break;
              }else{
                  $MB11 = $num2;
              }
              $i++;
          }
          //var_dump('hi',$num1,$num2);
      }
      //var_dump('hi2');exit();
  }


  if ($CF!=0)
  {

      $product = ORM::for_table('packs')->where('product_id','CF')->order_by_desc('pack_of')->find_many();
      $arrayLength= count($product);
      $i=1;
      $num1 = 1;
      $num2=1;


      while ($num1!=0||$num2!=0)
      {

          for ($j=0; $j<$arrayLength;$j++)
          {
//              echo "j1 :".$j++. " num1: ".$product[$i-1]['pack_of'];
              $index=getLessIndex($product,$j+1,$product[$i-1]['pack_of']);

              $num1=$CF%(int)$product[$i-1]['pack_of'];
              $quotient1=intdiv($CF,(int)$product[$i-1]['pack_of']);
              //var_dump($CF,'q1=',$quotient1,'n1=',$num1);
              if ($num1==0)
              {
                  $num2=0;
                  break;
              }else{
                  $CF = $num1;
              }

              $result[(int)$_POST['CF'].' CF'][$quotient1][$product[$i-1]['pack_of']]=[(float)$product[$i-1]['price']];
              //var_dump($quotient1.' X '.$product[$i-1]['pack_of'].' '.(float)$product[$i-1]['price'],'CF');

              $index=getLessIndex($product,$j+2,$num1);

              $num2=$num1%(int)$product[$index]['pack_of'];
//              var_dump($num1% $product[$index]['pack_of']);
              if ($num2 != 0 )
              {

                  if (!array_key_exists($index+1,$product))
                  {

                      unset($result[(int)$_POST['CF'].' CF']);

                      $CF=(int)$_POST['CF'];
                      $index=getLessIndex($product,$j+1,$product[$i]['pack_of']);

                      $num1=$CF%(int)$product[$i]['pack_of'];
                      $quotient1=intdiv($CF,(int)$product[$i]['pack_of']);
                      //var_dump($CF,'q1=',$quotient1,'n1=',$num1);
                      if ($num1==0)
                      {
                          $num2=0;
                          break;
                      }else{
                          $CF = $num1;
                      }
                      $result[(int)$_POST['CF'].' CF'][$quotient1][$product[$i]['pack_of']]=[(float)$product[$i]['price']];
                      //var_dump($quotient1.' X '.$product[$i]['pack_of'].' '.(float)$product[$i]['price'],'CF');

                      $index=getLessIndex($product,$j++,$num1);
                      $num2=$num1%(int)$product[$index]['pack_of'];

                      if ($num2 != 0 )
                      {
                          continue;
                      }
                      $quotient2=intdiv($CF,(int)$product[$index]['pack_of']);
                      //var_dump((int)$product[$i-1]['pack_of'],$quotient2);
                      if ($num2 == 0)
                      {
                          $num1=0;

                          $result[(int)$_POST['CF'].' CF'][$quotient2][$product[$index]['pack_of']]=[(float)$product[$index]['price']];
                          //var_dump($quotient2.' X '.$product[$index]['pack_of'].' ' .(float)$product[$index]['price'],'CF');
                          break;
                      }else{
                          $CF = $num2;
                      }
                      $i++;

                  }

                  continue;
              }else{
                  $quotient2=intdiv($CF,(int)$product[$index]['pack_of']);
                  //var_dump((int)$product[$i-1]['pack_of'],$quotient2);
                  if ($num2 == 0)
                  {
                      $num1=0;
                      $result[(int)$_POST['CF'].' CF'][$quotient2][$product[$index]['pack_of']]=[(float)$product[$index]['price']];
                      //var_dump($quotient2.' X '.(float)$product[$index]['price'],'j');
                      break;
                  }else{
                      $CF = $num2;
                  }
                  $i++;
              }
          }
          //var_dump('hi',$num1,$num2);
      }

  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jquery.js"></script>
    <!-- <script src="js/custom.js"></script> -->
    <title>Bill Generated</title>
</head>

<style>
    body {
        /* background-image: url("img/bill_color.png"); */
        /* background-repeat: no-repeat; */
        background-size: 210mm 297mm;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    p {
        font-size: 18px;
        font-weight: 600;
    }
    span {
        font-size: 18px;
        font-weight: 600;
	    width: 5px;
    }
</style>
<body>
<?php include 'include/header.php' ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="text-left">
            <h2 class="text-primary">BILL</h2>
        </div>
<!--    <img src="img/bill.png" style="position: absolute; ma width:210mm; height:297mm;" alt="">-->
        <table id="myTable" class="table table-striped" style="max-width: 30%;" border="4">
            <tbody>
        <?php
            foreach($result as $key=> $row)
            {
        ?>
        <tr>
            <td>
                <?php
                echo $key.' ';
                ?>
            </td>
            <td></td>
        </tr>
        <?php
                $totalValue=0;
        foreach($row as $rKey=>$rData)
        {
        ?>
        <tr>
            <td></td>
            <td>
                <?php
                echo $rKey.' X ';
                foreach ($rData as $val=>$value)
                {
                    echo $val.' = $' .$value[0];
                    $totalValue=$totalValue+$rKey*$value[0];
                }
                ?>

            </td>
        </tr>
            <?php
        }
        ?>
                <tr>
                    <td>
                        <?php
                        echo '$'.$totalValue;
                        ?>
                    </td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>



        <script>
        function final_print() {
            $("#final_print").css("display","none");
            window.print();
            $("#final_print").css("display","block");
            return true;
        }
        </script>


</body>

</html>
