<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>User Password</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"kutuphane");




        $query = mysqli_query($link,"SELECT * FROM users ORDER by username");
        while($row = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['userpass']."</td>";
            echo "</tr>";
        }
        //https://www.w3schools.com/php/php_mysql_select.asp
        ?>

    </tbody>
</table>