<!-- Include More Css For This Content -->
<link href="<?php echo base_url();?>templates/admin/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<!-- Breadcrumb -->
<?php } elseif ($action == 'tambah') { ?>

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3>Edit <small><?php echo $breadcrumb; ?></small></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li>
            <a href="<?php echo base_url();?>website/kategori">
                <?php echo $breadcrumb; ?>
            </a>
        </li>
        <li class="active">Edit</li>
    </ol>
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>website/rekening/edit" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <input type="hidden" name="toko_id" value="<?php echo $toko_id;?>" />
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td width="130">
                                            <label for="toko_bank" class="control-label">Jenis Bank <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_bank" type="text" id="toko_bank" value="<?php echo $toko_bank;?>" size="30" maxlength="255"
                                                required class="form-control input-sm" placeholder="Masukan Bank" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_norek" class="control-label">No Rek Bank <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_norek" type="text" id="toko_norek" required class="form-control input-sm" value="<?php echo $toko_norek;?>"
                                                size="30" maxlength="255" placeholder="No Rek Bank" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_atasnama" class="control-label">Atas Nama <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_atasnama" type="text" id="toko_atasnama" required class="form-control input-sm" value="<?php echo $toko_atasnama;?>"
                                                size="30" maxlength="255" placeholder="Atas Nama" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<!-- ================================================== END EDIT ================================================== -->
<?php } ?>
<!-- ================================================== END HAK AKSES ================================================== -->
<!-- Include More Js For This Content -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.slider/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>