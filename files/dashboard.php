<div class="main flex w-full h-full flex-col">
   
    <div class="bottom flex w-full">
        <div class="left flex flex-col">
            <div class="top">
                <h3 class="margin">RK HOSTEL ROOM ALLOCATION MANAGEMENT SYSTEM</h3>
            </div>
            <a href="?ref=dashboard&new=rooms"  class="flex"><div class="icon"><?php require './icons/house.svg';?></div> <span>Rooms</span></a>
            <a href="?ref=dashboard&new=students"  class="flex"><div class="icon"><?php require './icons/users.svg';?></div> <span>Students</span></a>
            <a href="?ref=dashboard&new=payment"  class="flex"><div class="icon"><?php require './icons/list.svg';?></div> <span>Payments</span></a>
           
        </div>
        <div class="right">
            <?php
            $new="";
            if(isset($_GET['new'])) $new=$_GET['new'].".php";
            $new1 = str_replace('.php', '', $new);
            ?>
            <h3 class="flex margin sticky">Home <div class="icons"><?php require './icons/angle-right.svg'?></div><?=$new1?></h3>
            <?php
            if(file_exists($new)) require "$new";
            ?>
            

        </div>
    </div>
</div>