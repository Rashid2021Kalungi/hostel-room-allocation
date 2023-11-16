<div class="w-full h-full flex flex-col ic rooms">
    <h2 class="margin">STUDENTS</h2>
    <div class="flex js w-half" style="margin-left: 40rem; margin-top: -2rem;">
        <div class="flex icon" onclick="navToggle('search')"; style="fill: #0d0034; cursor: pointer;margin-top: -2rem;"><?php require './icons/magnifying-glass.svg';?></div>
    </div>
        <div class="ic w-full flex-col"  id="search" style="display: none;">
            <form action="" class="form flex ic w-half" method="post">
                <input type="text" name="search" placeholder="Search students">
                <input type="submit" value="Search" name="submit" style="width: max-content">
            </form>
           
        </div>
    <hr style="height: 2px; background-color: purple; width: 90%;">
    <div class="bottom w-full h-max">
        
        <div class="link flex ic js flex-col">
           <a href="?ref=dashboard&new=students&pop1=1">+ Add New</a>
        </div>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){
            $search_input=$_POST['search'];
            $search=$con->query("SELECT *from students where email like '%$search_input%' or name like '%$search_input%' or university like '%$search_input%' or roomno like '%$search_input%'");
                    ?>
                     <div class="margin w-full flex h-max flex-col">
            <table>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>phone Number</th>
                    <th> Email</th>
                    <th> University</th>
                    <th> Room Number</th>
                    <th> Entry Date</th>
                    <th colspan=2>Tools</th>
                </thead>
                <tbody>
                    <?php
                    if($search->num_rows){
                        while($searchr=$search->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?$searchr['id']?></td>
                                <td><?=$searchr['name']?></td>
                                <td><?=$searchr['phonenumber']?></td>
                                <td><?=$searchr['email']?></td>
                                <td><?=$searchr['university']?></td>
                                <td><?=$searchr['roomno']?></td>
                                <td><?$searchr['entrydate']?></td>
                                <td><a href="?ref=dashboard&new=students&edit=1&id=<?=$searchr['id']?>&roomno=<?=$searchr['roomno']?>"><div class="icon"><?php require './icons/pencil.svg'?></div></a></td>
                                <td><a href="?ref=dashboard&new=students&delete=1&id=<?=$searchr['id']?>&roomno=<?=$searchr['roomno']?>"><div class="icon"><?php require './icons/trash-can.svg'?></div></a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
                    <?php
                }
           
        else{
        ?>
        <div class="margin w-full flex h-max flex-col">
            <table>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>phone Number</th>
                    <th> Email</th>
                    <th> University</th>
                    <th> Room Number</th>
                    <th> Entry Date</th>
                    <th colspan=2>Tools</th>
                </thead>
                <tbody>
                    <?php
                    $tb=$con->query("SELECT * FROM students");
                    if($tb->num_rows){
                        while($tbq=$tb->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?=$tbq['id']?></td>
                                <td><?=$tbq['name']?></td>
                                <td><?=$tbq['phonenumber']?></td>
                                <td><?=$tbq['email']?></td>
                                <td><?=$tbq['university']?></td>
                                <td><?=$tbq['roomno']?></td>
                                <td><?=$tbq['entrydate']?></td>
                                <td><a href="?ref=dashboard&new=students&edit=1&id=<?=$tbq['id']?>&roomno=<?=$tbq['roomno']?>"><div class="icon"><?php require './icons/pencil.svg'?></div></a></td>
                                <td><a href="?ref=dashboard&new=students&delete=1&id=<?=$tbq['id']?>&roomno=<?=$tbq['roomno']?>"><div class="icon"><?php require './icons/trash-can.svg'?></div></a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
            ?>
        </div>
           
            <?php
            if (isset($_GET['delete']) && $_GET['delete'] == 1 && isset($_GET['id']) && isset($_GET['roomno'])) {
                $id2 = $_GET['id'];
                $roomno1 = $_GET['roomno'];
                $delete = $con->query("DELETE FROM students where id = '$id2'");
                if ($delete === TRUE) {
                    $up=$con->query("UPDATE rooms set own='Not booked' where roomno='$roomno1'");
                    echo '<script>alert("Room deleted"); window.location="?ref=dashboard&new=students";</script>';
                }
            }

           if(isset($_GET['edit']) && $_GET['edit']==1 && isset($_GET['id']) && isset($_GET['roomno'])){
            $id1=$_GET['id'];
            $room=$_GET['roomno'];
            $q=$con->query("SELECT *FROM students where id ='$id1'");
            if($q->num_rows){
                $qr=mysqli_fetch_assoc($q);
            }
            $s=$con->query("SELECT *from rooms where status='active' and own !='booked'");
            
            ?>
            <div id="pop2" class="flex flex-col ic">
                <a href="?ref=dashboard&new=students" style="color: red; font-size: 20px; margin-left: 43rem; margin-top: 5px;">X</a>
                <form action="" method="post" class="flex flex-col ic">
                   <input type="hidden" name="id" value="<?=$qr['id']?>">
                   <input type="text" name="name" value="<?=$qr['name']?>">
                   <input type="text" name="email" value="<?=$qr['email']?>" readonly>
                   <input type="text" name="phone" value="<?=$qr['phonenumber']?>">
                   <input type="text" name="university" value="<?=$qr['university']?>">
                   <select name="roomno" id="">
                       <option value="<?=$qr['roomno']?>"><?=$qr['roomno']?></option>
                       <?php
                        if($s->num_rows){
                            while($sl=$s->fetch_assoc()){
                                ?>
                            <option value="<?=$sl['roomno']?>"><?=$sl['roomno']?></option>
                                <?php
                            }
                        }
                        if($roomno !=$room){
                        $upd=$con->query("UPDATE rooms set own='Not booked' where roomno='$room'");
                        }
                        ?>
                   </select>
                   <p> date of entry</p>
                   <input type="date" name="date" id="" value="<?=$qr['entrydate']?>" readonly>
                    <input type="submit" name="save">
                    <?php
                    if($error){
                        ?>
                        <div class="error"><?=$error?></div>
                        <?php
                    }
                    if($success){
                        ?>
                        <div class="success"><?=$success?></div>
                        <?php
                    }
                    ?>
                </form>
            </div>
            <?php
        }
            ?>
            <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save'])){
            
            $name=$_POST['name'];
            $university=$_POST['university'];
            $email=$_POST['email'];
            $date1=$_POST['date'];
            $phone=$_POST['phone'];
            $roomno=$_POST['roomno'];
            $id=$_POST['id'];
            if(empty($name) || empty($email) || empty($phone) || empty($date) || empty($university)){
                $error="All fields must be filled";
            } 
            else{
                if(!isset($id1)){
                    $select =$con->query("SELECT *FROM students where email='$email'");
                    if($select->num_rows>0){
                        $error="Email Already exists";
                    }
                }
                else{
                    $insert=$con->query("INSERT INTO students(id,name,email,phonenumber,roomno,university,entrydate) values('$id','$name','$email','$phone','$roomno','$university','$date1') on duplicate key update name =values(name),phonenumber=values(phonenumber), roomno=values(roomno),university=values(university)");
                    if($insert){
                        $con->query("UPDATE rooms set own='booked' where roomno='$roomno'");
                        $success="Student added successfully";
                    }
                    else{
                        $error="Something went wrong".die($con->error);
                    }
                }
            }
        }
        ?>
    </div>
    <?php
            if(isset($_GET['pop1']) && $_GET['pop1']==1){
                $s=$con->query("SELECT *from rooms where status='active' and own !='booked'");
                
                ?>
                <div id="pop1" class="flex flex-col ic">
                    <a href="?ref=dashboard&new=students" style="color: red; font-size: 20px; margin-left: 43rem; margin-top: 5px;">X</a>
                    <form action="" method="post" class="flex flex-col ic">
                       <input type="hidden" name="id" placeholder="Enter student Name">
                       <input type="text" name="name" placeholder="Enter student Name">
                       <input type="email" name="email" placeholder="Enter student email">
                       <input type="text" name="phone" placeholder="Enter student phone number">
                       <input type="text" name="university" placeholder="Enter university of study">
                       <select name="roomno" id="">
                           <option value="null">~Select room~</option>
                        <?php
                        if($s->num_rows){
                            while($sl=$s->fetch_assoc()){
                                ?>
                            <option value="<?=$sl['roomno']?>"><?=$sl['roomno']?></option>
                                <?php
                            }
                        }
                        ?>
                       </select>
                       <input type="date" name="date">
                        <input type="submit" name="save">
                        <?php
                        if($error){
                            ?>
                            <div class="error"><?=$error?></div>
                            <?php
                        }
                        if($success){
                            ?>
                            <div class="success"><?=$success?></div>
                            <?php
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
            ?>
</div>
<script>
    function navToggle(el){
        let nav = document.getElementById(el);
        nav.style.transition = "left 0.2s ease";
        nav.style.left = "0px";
        if(nav.style.display == "flex") nav.style.display = "none";
        else nav.style.display = "flex";
    }
</script>