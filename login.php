<html>
<head>
    <title>
        Create your event.
    </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<!--    <script src="main.js"></script>-->
</head>


<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST["username"];
    $password = $_POST["password"];

    "<input type='hidden' name='username' value='$username'>";

    $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['username'] == $username && $row['password'] == $password) {
        echo  'Welcome ',$row['name'],"<br>";
    } else {
        echo 'Error Logging In !';
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

?>

<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Create Event</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New Event</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" id="submitform">
                    <div class="form-group">



                        <label class="control-label">Name of Event:</label>
                        <input type="text" class="form-control" id="recipient-name" name="event">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Description:</label>
                        <textarea class="form-control" id="message-text" name="description"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="image" class="control-label">Upload Image for Event:</label>
                        <input type="file" id="image" accept=".jpeg,.png,.gif,.jpg">
                    </div>

                    <div class="form-group">
                        <label for="doe" class="control-label">Date of Event:</label>
                        <br>
                            <in class="form-group">

                                <label>DAY</label>
                                <select name="date">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</opt
                                        ion>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>

                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                </select>

                                <label>Month</label>
                                <select name="month">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>

                                <label>Year</label>
                                <select name="year">
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                    <option>2022</option>
                                    <option>2023</option>
                                    <option>2024</option>
                                    <option>2025</option>
                                    <option>2026</option>
                                    <option>2027</option>
                                    <option>2028</option>
                                    <option>2029</option>
                                    <option>2030</option>
                                    <option>2031</option>
                                    <option>2032</option>
                                </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Done">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<span id="result">

</span>

<script>
    $("#submitform").on("submit",function (event) {
        event.preventDefault();
        console.log( $(this).serialize() );
        var formdata = $(this).serialize();
        var username = '<?php echo $username; ?>';
        // alert(formdata);
        $.ajax({
            type:"POST",
            url:'addEvent.php?username='+username,
            dataType:'text',
            data:formdata,
            success: function(data){

                var res = $.parseJSON(data);
                //alert(res.result);
                $.("#result").text(res.result[0]);


            },
            error:function (err) {
                console.log(err);
                alert(err);
            }
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>