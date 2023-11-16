<div class="w-full h-full flex flex-col ic rooms">
    <h2 class="margin">ROOMS</h2>
    <hr style="height: 2px; background-color: purple; width: 90%;">
    <div class="bottom w-full h-max">
        <div class="link flex ic js flex-col">
           <a href="?ref=dashboard&new=rooms&pop=1">+ Add rooms</a>
        </div>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $roomno=$_POST['roomno'];
            $own="Not booked";
            $status=$_POST['status'];
            $desc=$_POST['desc'];
            $id=$_POST['id'];
            if(empty($roomno) || empty($status) || empty($desc)){
                $error="All field must be filled";
            }
            else{
                $insert=$con->query("INSERT INTO rooms(id,roomno,status,descr,own) values('$id','$roomno','$status','$desc','$own') on duplicate key update roomno=values(roomno),status=values(status),descr=values(descr)") or die($con->error);
                if($insert){
                    $success="Room added";
                }
                else{
                    $error="Something went wrong";
                }
                
            }
        }
        ?>
        <div class="margin w-full flex h-max flex-col">
            <table>
                <thead>
                    <th>#</th>
                    <th>Room Number</th>
                    <th>Room Status</th>
                    <th>Room Description</th>
                    <th>State</th>
                    <th colspan=2>Tools</th>
                </thead>
                <tbody>
                    <?php
                    $select=$con->query("SELECT *FROM rooms");
                    if($select->num_rows){
                        while($selectq=$select->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?=$selectq['id']?></td>
                                <td><?=$selectq['roomno']?></td>
                                <td><?=$selectq['status']?></td>
                                <td><?=$selectq['descr']?></td>
                                <td><?=$selectq['own']?></td>
                                <td><a href="?ref=dashboard&new=rooms&edit=1&id=<?=$selectq['id']?>"><div class="icon"><?php require './icons/pencil.svg'?></div></a></td>
                                <td><a href="?ref=dashboard&new=rooms&delete=1&id=<?=$selectq['id']?>"><div class="icon"><?php require './icons/trash-can.svg'?></div></a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if (isset($_GET['delete']) && $_GET['delete'] == 1 && isset($_GET['id'])) {
            $id2 = $_GET['id'];
            $delete = $con->query("DELETE FROM rooms where id = '$id2'");
            if ($delete === TRUE) {
                echo '<script>alert("Room deleted"); window.location="?ref=dashboard&new=rooms";</script>';
            }
        }
        
        if(isset($_GET['pop']) && $_GET['pop']==1){
            ?>
            <div id="pop" class="flex flex-col ic">
                <a href="?ref=dashboard&new=rooms" style="color: red; font-size: 20px; margin-left: 43rem; margin-top: 5px;">X</a>
                <form action="" method="post" class="flex flex-col ic">
                    <input type="hidden" name="id">
                    <input type="text" placeholder="Enter room number" name="roomno">
                    <select name="status" id="">
                        <option value="null">~select room status~</option>
                        <option value="active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <input type="text" placeholder="Enter description" name="desc">
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
        if(isset($_GET['edit']) && $_GET['edit']==1 && isset($_GET['id'])){
            $id1=$_GET['id'];
            $sel=$con->query("SELECT *FROM rooms where id='$id1'");
            if($sel->num_rows){
                $q=mysqli_fetch_assoc($sel);
            }
            ?>
            <div id="pop" class="flex flex-col ic">
                <a href="?ref=dashboard&new=rooms" style="color: red; font-size: 20px; margin-left: 43rem; margin-top: 5px;">X</a>
                <form action="" method="post" class="flex flex-col ic">
                    <input type="hidden" name="id" value="<?=$q['id']?>">
                    <input type="text" value="<?=$q['roomno']?>" name="roomno">
                    <select name="status" id="">
                        <option value="null"><?=$q['status']?></option>
                        <option value="active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <input type="text" value="<?=$q['descr']?>" name="desc">
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
</div>