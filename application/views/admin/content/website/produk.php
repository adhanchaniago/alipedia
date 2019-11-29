<!-- Include More Css For This Content -->
<link href="<?php echo base_url();?>templates/admin/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3>Daftar <small>Produk</small></h3>
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
                    <form action="<?php echo base_url();?>website/produk" method="post" id="form">
                        <div class='btn-navigation'>

                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>website/produk"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
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
                                    <th width="400">Photo Produk</th>
                                    <th width="400">Nama Toko</th>
                                    <th width="400">Penjual</th>
                                    <th width="400">Nama Produk</th>
                                    <th width="150">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
	                            $i	= $page+1;
	                            $like_produk[$cari]			= $q;
	                        if ($jml_data > 0){
	                            foreach ($this->ADM->grid_all_produk('', 'produk_nama', 'ASC', $batas, $page, '', $like_produk) as $row){
	                            ?>
                                    <tr>
                                        <td align="center">
                                            <?php echo $i;?>
                                        </td>
                                        <td align="center">
                                            <style>
                                                .image-produk img {
                                                    width: 100px;
                                                }
                                            </style>
                                            <div class="image-produk">
                                                <img src="http://localhost/ukmapp-android/assets/images/produk/<?php echo $row->produk_photo;?>">
                                                <div>
                                        </td>
                                        <td>
                                            <?php 
                                            $where_toko['toko_id']	= $row->toko_id;
                                            foreach ($this->ADM->grid_all_toko('', 'toko_id', 'ASC', '1', '', $where_toko, '') as $row2){ ?>
                                            <?php echo $row2->toko_nama;?>
                                            <?php }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $where_admin['admin_user']	= $row->admin_user;
                                            foreach ($this->ADM->grid_all_admin2('', 'admin_user', 'ASC', '1', '', $where_admin, '') as $row2){ ?>
                                            <?php echo $row2->admin_nama;?>
                                            <?php }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $row->produk_nama;?>
                                        </td>
                                        <td align="center">
                                            <!-- ========== EDIT DETAIL HAPUS ========== -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-xs">Actions</button>
                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
									            <span class="caret"></span>
									            <span class="sr-only">Toggle Dropdown</span>
								            </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="javascript:;" data-id="<?php echo $row->produk_id;?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $row->produk_nama; ?>"><i class='fa fa-trash-o'></i> Hapus</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- ========== End EDIT DETAIL HAPUS ========== -->
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
	                            }
	                        } else {
                                ?>
                                <tr>
                                    <td colspan="4">Belum ada data!.</td>
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
                                    <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'website/produk/view', $id=""); }?>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- ========== Modal Detail ========== -->
        <div class="modal fade" id="mod-info" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- ========== End Modal Detail ========== -->

        <!-- ========== Modal Konfirmasi ========== -->
        <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Konfirmasi</h4>
                    </div>

                    <div class="modal-body" style="background:#d9534f;color:#fff">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>

                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" id="hapus-produk">Ya</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
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