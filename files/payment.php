<div class="w-full h-full flex flex-col ic rooms">
    <div class="w-full h-max flex ic">
        <form action="" method="post" style="display: flex; width: 50%; margin: auto;">
            <input type="text" placeholder="Search student by room number" name="search" style="flex: 1; border-radius: 20px; margin-right: 5px;">
            <input type="submit" name="save" value="Search" style="width: max-content; border-radius: 20px;">
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $search_input = $_POST['search'];
        $search = $con->query("SELECT * FROM students where roomno='$search_input'");
    ?>

        <div class="margin w-full flex h-max flex-col ic">
            <table>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>University</th>
                    <th>Room Number</th>
                    <th>Entry Date</th>
                    <th>Payment</th>
                    <th>Month</th>
                    <th>Balance</th>
                </thead>
                <tbody>
                    <?php
                    if ($search->num_rows > 0) {
                        while ($row = $search->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['phonenumber'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['university'] ?></td>
                                <td><?= $row['roomno'] ?></td>
                                <td><?= $row['entrydate'] ?></td>
                                <td><a href="?ref=dashboard&new=students&edit=1&id=<?= $row['id'] ?>&roomno=<?= $row['roomno'] ?>">Pay</a></td>
                                <?php
                                $roomno2=$row['roomno'];
                                $blnce = $con->query("SELECT * FROM payment WHERE roomno = '$roomno2' ORDER by date desc limit 1");
                                if ($blnce->num_rows > 0) {
                                    $bq=mysqli_fetch_assoc($blnce);
                                    ?>
                                    <td><?= $bq['month'] ?></td>
                                    <td><?= $bq['balance'] ?></td>
                                    <?php
                                }?>
                            </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="8">No results found for room number ' . htmlspecialchars($search_input) . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
    ?>

        <div class="margin w-full flex h-max flex-col ic">
            <table>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>University</th>
                    <th>Room Number</th>
                    <th>Entry Date</th>
                    <th>Tools</th>
                    <th>Month</th>
                    <th>Balance</th>
                </thead>
                <tbody>
                    <?php
                    $tb = $con->query("SELECT * FROM students");
                    if ($tb->num_rows > 0) {
                        while ($row = $tb->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['phonenumber'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['university'] ?></td>
                                <td><?= $row['roomno'] ?></td>
                                <td><?= $row['entrydate'] ?></td>
                                <td><a href="?ref=dashboard&new=payment&edit=1&id=<?= $row['id']?> &roomno=<?=$row['roomno']?>">Pay</a></td>
                                <?php
                                $roomno2=$row['roomno'];
                                $blnce = $con->query("SELECT * FROM payment WHERE roomno = '$roomno2' ORDER by date desc limit 1");
                                if ($blnce->num_rows > 0) {
                                    $bq=mysqli_fetch_assoc($blnce);
                                    ?>
                                    <td><?= $bq['month'] ?></td>
                                    <td><?= $bq['balance'] ?></td>
                                    <?php
                                }?>
                            </tr>
                          <?php
                        }
                       
                    } else {
                        echo '<tr><td colspan="8">No students found.</td></tr>';
                    }
                   
                        ?>
                </tbody>
            </table>
        </div>
    <?php
    }
   
if (isset($_GET['edit']) && $_GET['edit'] == 1 && isset($_GET['id']) & isset($_GET['roomno'])) {
    $id1 = $_GET['id'];
    $roomno1 = $_GET['roomno'];
    $q = $con->query("SELECT * FROM students WHERE id = '$id1'");
    
    if ($q->num_rows) {
        $qr = mysqli_fetch_assoc($q);
    }
    
    $bl = $con->query("SELECT * FROM payment WHERE roomno = '$roomno1' ORDER by date desc limit 1");
    
    ?>

    <div id="pop2" class="flex flex-col ic">
        <a href="?ref=dashboard&new=payment" style="color: red; font-size: 20px; margin-left: 43rem; margin-top: 5px;">X</a>
        <form action="" method="post" class="flex flex-col ic">
            <input type="hidden" name="id" value="<?= $qr['id'] ?>" readonly>
            <input type="text" name="name" value="<?= $qr['name'] ?>" readonly>
            <input type="text" name="email" value="<?= $qr['email'] ?>" readonly>
            <input type="text" name="university" value="<?= $qr['university'] ?>" readonly>
            <input type="text" name="roomno" value="<?= $qr['roomno'] ?>" readonly>
            <select name="month" id="">
                <?php
                if ($bl->num_rows) {
                    $bl_query = mysqli_fetch_assoc($bl);
                    ?>
                    <option value="<?=$bl_query['month']?>"><?=$bl_query['month']?></option>
                    <?php
                }
                    $months = [
                        'January', 'February', 'March', 'April',
                        'May', 'June', 'July', 'August',
                        'September', 'October', 'November', 'December'
                    ];
                    
                    foreach ($months as $month) {
                        echo "<option value='$month'>$month</option>";
                    }
                ?>
            </select>
             
            <input type="text" name="amount" placeholder="Enter Amount">
            <?php
            if ($bl_query ) {
                ?>
                <p>Balance</p>
                <input type="text" value="<?= $bl_query['balance'] ?>" readonly>
                <p>Last payment date</p>
                <input type="text" value="<?= $bl_query['date'] ?>" readonly>
                <?php
            }
            ?>
            <input type="submit" name="save" value="Pay">
        </form>

        <?php
$alert = "";
$initialBalance = 600000;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    // $date=date('y-m-d');
    $month = $_POST['month'];
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
    $name = $qr['name'];
    $id = $qr['id'];
    $email = $qr['email'];
    $roomno = $qr['roomno'];
    $year = date('Y');

    if (!$amount) {
        $error = "Invalid input data.";
    } else {
        $previousBalanceQuery = $con->query("SELECT balance FROM payment WHERE email='$email' and month='$month' and year ='$year' ORDER BY id DESC LIMIT 1");
        if ($previousBalanceQuery->num_rows > 0) {
            $previousBalanceRow = $previousBalanceQuery->fetch_assoc();
            $previousBalance = $previousBalanceRow['balance'];
        } else {
            $previousBalance = $initialBalance;
        }

        $balance = $previousBalance - $amount;

        if ($balance < 0) {
            $error = "Payment exceeds the available balance.";
        } else {
            $save = $con->query("INSERT INTO payment(name, email, roomno, month, year, amount_paid, balance,date) VALUES ('$name', '$email', '$roomno', '$month', '$year', '$amount', '$balance','$date')");

            if ($save) {
                $success = "Payment made";
            } else {
                $error = "Something went wrong: " . $con->error;
            }

            $alert = ($balance == 0) ? "Nil" : $balance;
        }
    }

    if (isset($error)) {
        ?>
        <div class="error"><?= $error ?></div>
        <?php
    }

    if (isset($success)) {
        ?>
        <div class="success"><?= $success . " of " . $amount . " and " . $alert . " balance" ?></div>
        <?php
    }
}
?>


    </div>
    <?php
}

    ?>
</div>
