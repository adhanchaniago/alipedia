<!-- Include More Css For This Content -->
<link href="<?php echo base_url();?>templates/admin/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3>Daftar <small>Transaksi</small></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li class="active">
            <?php echo $breadcrumb; ?>
        </li>
    </ol>
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="content">
                    <!-- ========== Flashdata ========== -->
                    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                    <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check sign"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } else if ($this->session->flashdata('warning')) { ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check sign"></i>
                        <?php echo $this->session->flashdata('warning'); ?>
                    </div>
                    <?php } else { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-warning sign"></i>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <!-- ========== End Flashdata ========== -->
                    <!-- ========== Button ========== -->
                    <form action="<?php echo base_url();?>website/transaksiall" method="post" id="form">
                        <div class='btn-navigation'>
                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>website/transaksiall"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='btn-search'>Cari Berdasarkan :</div>
                            <div class='col-md-3 col-sm-12'>
                                <div class='button-search'>
                                    <?php array_pilihan('cari', $berdasarkan, $cari);?>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-12'>
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
                                    <span class="input-group-btn">
                                        <button type="submit" name="kirim" class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- ========== End Button ========== -->
                    <!-- ========== Table ========== -->
                    <div class="table-responsive">
                        <table class="hover">
                            <thead class="primary-emphasis">
                                <tr>
                                    <th width="30">#</th>
                                    <th width="200">No Invoice</th>
                                    <th width="400">No Transaksi</th>
                                    <th width="400">Pembeli</th>
                                    <th width="400">Produk</th>
                                    <th width="400">Jumlah</th>
                                    <th width="400">Harga</th>
                                    <th width="400">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
	                            $i	= $page+1;
	                            $like_transaksi[$cari]			= $q;
	                        if ($jml_data > 0){
	                            foreach ($this->ADM->grid_all_transaksi('', 'transaksi_id', 'ASC', $batas, $page, '', $like_transaksi) as $row){
	                            ?>
                                    <tr>
                                        <td align="center">
                                            <?php echo $i;?>
                                        </td>
                                        <td>
                                            <?php echo $row->invoice_id;?>
                                        </td>
                                        <td>
                                            <?php echo $row->transaksi_id;?>
                                        </td>
                                        <td>
                                        <?php 
                       
                                        $where_admin['admin_user']	=  $row->admin_user;
                                        foreach ($this->ADM->grid_all_admin2('', 'admin_nama', 'ASC', '1', '', $where_admin, '') as $pembeli){
                                        ?>
                                         <?php echo $pembeli->admin_nama;?>
                                        <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $row->produk_nama;?>
                                        </td>
                                        <td>
                                           <?php echo $row->transaksi_jumlah ?> pcs
                                        </td>
                                        <td>
                                            Rp<?php echo number_format($row->transaksi_harga,0,',','.'); ?>,00
                                        </td>
                                        <td>
                                            Rp<?php echo number_format($row->transaksi_totalharga,0,',','.'); ?>,00
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
	                            }
	                        } else {
                                ?>
                                <tr>
                                    <td colspan="12">Belum ada data!.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <!-- ========== End Table ========== -->
                    </div>
                    <div id='pagination'>
                        <div class='pagination-left'>Total :
                            <?php echo $jml_data;?>
                        </div>
                        <div class='pagination-right'>
                            <ul class="pagination">
                                <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'website/transaksiall/view', $id=""); }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php } ?>
<!-- Include More Js For This Content -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.slider/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>