<?php
require_once('./../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `booking_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        $qry2 = $conn->query("SELECT c.*, cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$cab_id}' ");
        if($qry2->num_rows > 0){
            foreach($qry2->fetch_assoc() as $k => $v){
                if(!isset($$k))
                $$k=$v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-12">Transaction Code</dt>
                <dd class="col-sm-12"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                <dt class="col-sm-12">Category</dt>
                <dd class="col-sm-12"><?= isset($category) ? $category : "" ?></dd>
                <dt class="col-sm-12">Service</dt>
                <dd class="col-sm-12"><?= isset($cab_model) ? $cab_model : "" ?></dd>
            </dl>
        </div>
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-12">Address</dt>
                <dd class="col-sm-12"><?= isset($pickup_zone) ? $pickup_zone : "" ?></dd>
                <dt class="col-sm-12">Notes</dt>
                <dd class="col-sm-12"><?= isset($drop_zone) ? $drop_zone : "" ?></dd>
                <dt class="col-sm-12">Status</dt>
                <dd class="col-sm-12">
                    <?php 
                        switch($status){
                            case 0:
                                echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'>Pending</span>";
                                break;
                            case 1:
                                echo "<span class='badge badge-primary bg-gradient-primary px-3 rounded-pill'>Confirmed</span>";
                                break;
                            case 2:
                                echo "<span class='badge badge-warning bg-gradient-warning px-3 rounded-pill'>On-Going</span>";
                                break;
                            case 3:
                                echo "<span class='badge badge-success bg-gradient-success px-3 rounded-pill'>Completed</span>";
                                break;
                            case 4:
                                echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Cancelled</span>";
                                break;
                        }
                    ?>
                </dd>
            </dl>
        </div>
    </div>
    <div class="text-right">
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn btn-primary btn-flat bg-gradient-primary" type="button" id="confirm_booking">Confirm Booking</button>
        <?php elseif(isset($status) && $status == 1): ?>
        <button class="btn btn-warning btn-flat bg-gradient-warning" type="button" id="pickup_booking">On-Going</button>
        <?php elseif(isset($status) && $status == 2): ?>
        <button class="btn btn-success btn-flat bg-gradient-success" type="button" id="dropoff_booking">Completed</button>
        <?php endif; ?>
        <button class="btn btn-dark btn-flat bg-gradient-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
    $(function(){
        $('#confirm_booking').click(function(){
            _conf("Are you sure to confirm this booking [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",1])
        })
        $('#pickup_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as On-Going?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",2])
        }) 
        $('#dropoff_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as Completed?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",3])
        })
    })
    function update_booking_status($id,$status){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_booking_status",
            method:"POST",
            data:{id: $id,status:$status},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }
</script>
