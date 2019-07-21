<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice DashBoard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>
<style>
    body {
        width: 100%;
        height: auto;
        margin: 0 auto;
    }

    .title {
        text-align: center;
        margin-top: 3%;
        color: #E91E63;
        text-shadow: 0px 1px 1px black;
        font-size: 50px;

        font-family: 'Times New Roman', Times, serif;
    }

    a {
        color: white;
    }

    p {
        text-align: center;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin-bottom: 1%;
    }

    .fa {
        font-size: 170%;
    }

    #developer-foot-note {
        position: fixed;
        bottom: 0;
        margin-top: 10px;
        background-color: #17a2b8;
        color: white;
        text-align: center !important;
        width: 100%;
    }

    #developer-foot-note p {
        margin-bottom: 0;
    }
</style>

<body>
    <div class="container" style="margin-bottom: 20px;">
        <h1 class="title">Bakery</h1>

        <div class="row text-center align-center">
            <!-- <div class="col-md-1"></div> -->
            <h4 class="mb-3">Product Listing</h4>
            <form method="post" id="invoice" action="bill.php" onSubmit="return billGenerate()">
                <div class="row">
                    <div class="col-md-8">
                        <label for="name">Vegemite Scroll</label>
                        <input type="text" class="form-control" id="VS5" name="VS5" value="10" required="">
                    </div>
                    <div class="col-md-8">
                        <label for="GSThNO">Blueberry Muffin</label>
                        <input type="text" class="form-control" id="MB11" name="MB11" value="14">
                    </div>
                    <div class="col-md-8">
                        <label for="GSThNO">Croissant</label>
                        <input type="text" class="form-control" id="CF" name="CF" value="13">
                    </div>

                    <div class="col-md-8">
                    <input class="btn btn-primary btn-md"  style="margin-bottom: 30px;" type="submit" value="Generate Bill">
                    </div>
            </form>
        </div>
    </div>
</body>

</html>