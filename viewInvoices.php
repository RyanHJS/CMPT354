<?php
    function myTable($obConn,$sql){
        $rsResult = mysqli_query($obConn,
        $sql) or die(mysqli_error($obConn));
        if(mysqli_num_rows($rsResult)>0){
            echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\"
                    cellpadding=\"0\"><tr align=\"center\" bgcolor=\"#CCCCCC\">";
            $i = 0;
            while ($i < mysqli_num_fields($rsResult)){
                $field = mysqli_fetch_field_direct($rsResult, $i);
                $fieldName=$field->name;
                echo "<td><strong>$fieldName</strong></td>";
                $i = $i + 1;
            }
            echo "</tr>";

            $bolWhite=true;
            while ($row = mysqli_fetch_assoc($rsResult)) {
                echo $bolWhite ? "<tr bgcolor=\"#CCCCCC\">" : "<tr bgcolor=\"#FFF\">";
                $bolWhite=!$bolWhite; 
                foreach($row as $data) {
                    echo "<td>$data</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    include 'connect.php';
    $conn = OpenCon();

    if(isset($_POST['submit'])){
        $column = $_POST['column'];

        if(!$column){
            $sql = 
            "SELECT * FROM bill";
        }
        else{
            $sql =
            "SELECT $column FROM bill";
        }

        myTable($conn,$sql);
    }
?>