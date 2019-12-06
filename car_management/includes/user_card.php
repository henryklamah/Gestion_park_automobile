<div class="row">
    <div class="col-12">
        <div class="card card-inverse" style="background-color: #333; border-color: #8BF9D9; border-width: medium;">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h2 class="card-title"><?php echo htmlentities($result->FullName);?></h2>
                        <p class="card-text"><strong>Address: </strong><?php echo htmlentities($result->Address);?></p>
                        <p class="card-text"><strong><?php echo htmlentities($result->City);?></strong> <?php echo htmlentities($result->Country);?></p>

                        <p class="card-text"><strong>Reg Date - </strong><?php echo htmlentities($result->RegDate);?> </p>
                        <?php if($result->UpdationDate!=""){?>
                            <p class="card-text"><strong>Last Update at  - </strong><?php echo htmlentities($result->UpdationDate);?></p>
                        <?php } ?>

                    </div>
                    <div class="col-md-4 col-sm-4 text-center">
                        <img class="btn-md" src="assets/img/logo_h.png" alt="" style="border-radius:50%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>