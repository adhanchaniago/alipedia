<style>
    .title {
        margin-bottom: 20px;
        text-align: center;
        font-size: 18px;
    }

    .judul {
        font-size: 14px;
        text-align: center;
    }

    .ikon {
        text-align: center;
        margin-top: 10px;
    }

    .ikon i {
        font-size: 48px;
    }

    .produk-image {
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
    }

    .produk-image img {
        width: 100px;
    }

    .produk-image2 {
        margin-top: 20px !important;
        margin-bottom: 10px;
    }

    .produk-image2 img {
        width: 100px;
    }

    .produk-image3 {
        margin-top: 20px !important;
        margin-bottom: 20px;
        text-align: center;
    }

    .produk-image3 img {
        width: 100px;
    }

    .produk-name {
        margin: 5px 0px 3px 0px;
        text-align: center;
    }

    .produk-price {
        margin: 0px 0px 8px 0px;
        text-align: center;
    }

    .produk-stock {
        margin: 0px 0px 5px 0px;
        text-align: center;
    }

    #pagination {
        margin-top: -15px;
    }

    .content2 {
        margin-top: 0px;
        text-align: center;
    }

    .invoice {
        font-size: 18px;
        text-align: center;
    }

    .invoice-harga {
        color: red;
        margin-top: 10px;
        font-size: 18px;
        text-align: center;
    }

    .blocks {
        cursor: default;
    }

    .transaksi-tanggal {
        margin-bottom: 10px;
    }

    .harga {
        font-size: 14px;
        margin: 10px 0px 30px 0px;
    }
</style>
<!-- ================================================== View ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">

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

            <div class="col-xs-12 col-md-12">
                <div class="title"> Pesanan Saya </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="content">
                            <form action="<?php echo base_url();?>website/transaksi" method="post" id="form">
                                <div class='btn-navigation'>
                                    <div class='pull-right'>
                                        <a class="btn btn-primary" href="<?php echo site_url();?>website/transaksi"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
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
                        </div>
                    </div>
                    <!-- ========== End Button ========== -->
                    <!-- ========== Table ========== -->
                    <div class="row">
                        <?php
	                        $like_invoice[$cari]			= $q;
	                        if ($jml_data > 0){
                                foreach ($this->ADM->grid_all_invoice('', 'invoice_id', 'DESC', $batas, $page, "", $like_invoice) as $invoice){ ?>
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="block-flat">
                                <div class="invoice">No Invoice : <?php echo $invoice->invoice_id;?></div>
                                <div class="invoice-harga">Rp<?php echo number_format($invoice->invoice_subtotal,0,',','.'); ?>,00</div>
                                
                                <?php if($invoice->invoice_bukti) { ?>
                                    <div class="produk-image">Foto Bukti Pembayaran Pembeli : <img src="http://localhost/ukmapp-android/assets/images/transaksi/<?php echo $invoice->invoice_bukti;?>"></div>
                                <?php } ?>

                                <?php if($invoice->invoice_resi) { ?>
                                    <div class="produk-image3">Foto No Resi : <img src="<?php echo base_url();?>assets/images/resi/<?php echo $invoice->invoice_resi;?>"></div>
                                <?php }  ?>
                               
                                <?php 
                                $where_transaksi['invoice_id']	=  $invoice->invoice_id;
	                            foreach ($this->ADM->grid_all_transaksi('', 'transaksi_id', 'DESC', "100", '', $where_transaksi, '') as $row){
	                            ?>
                 
                                <?php if($row->transaksi_bukti) { ?>
                                    <?php if($row->transaksi_resi) { ?>
                                        <div class="produk-image2">Foto No Resi : <img src="http://localhost/ukmapp-android/assets/images/resi/<?php echo $row->transaksi_resi;?>"></div>
                                    <?php } else { ?>
                                        <div class="produk-image2">Foto Bukti Pembayaran Toko : <img src="<?php echo base_url();?>/assets/images/transaksi/<?php echo $row->transaksi_bukti;?>"></div>
                                    <?php }?>
                                <?php } ?>
                                    <div class="content">
                                        <div class="transaksi-name">No Transaksi : <?php echo $row->transaksi_id;?> </div>
                                        
                                        <?php
                                        $where_toko['toko_id']	=  $row->toko_id;
                                        foreach ($this->ADM->grid_all_toko('', 'toko_nama', 'ASC', '1', '', $where_toko, '') as $row2){
	                                    ?>
                                            <div class="transaksi-name">Toko :<?php echo $row2->toko_nama;?> </div>
                                        <?php } ?>
                                            
                                        <?php
                                        $where_produk['produk_id']	=  $row->produk_id;
                                        foreach ($this->ADM->grid_all_produk('', 'produk_nama', 'ASC', '1', '', $where_produk, '') as $row3){
                               
                                        $where_admin['admin_user']	=  $row3->admin_user;
                                        foreach ($this->ADM->grid_all_admin2('', 'admin_nama', 'ASC', '1', '', $where_admin, '') as $row5){
                                        ?>
                                            <div class="transaksi-name">Penjual :<?php echo $row5->admin_nama;?> </div>
                                        <?php } ?>

                                        <?php 
                       
                                        $where_admin['admin_user']	=  $row->admin_user;
                                        foreach ($this->ADM->grid_all_admin2('', 'admin_nama', 'ASC', '1', '', $where_admin, '') as $pembeli){
                                        ?>
                                        <div class="transaksi-name">Pembeli :
                                            <?php echo $pembeli->admin_nama;?> </div>
                                        <div class="transaksi-name">Alamat Pembeli :
                                            <?php echo $pembeli->admin_alamat;?> </div>
                                        <?php } ?>

                                            <div class="transaksi-name">Nama Produk : <?php echo $row3->produk_nama;?> </div>
                                        <?php } ?>
                                                
                                    <div class="transaksi-name">Jumlah Pembelian :<?php echo $row->transaksi_jumlah;?> </div>
                                    <div class="transaksi-name">Total Harga : Rp<?php echo $row->transaksi_totalharga;?>,00 </div>
                                    <div class="transaksi-tanggal">Tanggal Pembelian : <?php echo  dateIndo($row->transaksi_created); ?> </div>
                    </div>
                    <?php if($row->transaksi_statusadmin === "unpaid") { ?>
                            <a style="margin-top: 10px;" class="btn btn-primary btn-block btn-produk" data-toggle="modal" data-target="#mod-info" type="button" href="<?php echo site_url();?>website/konfirmasipembayarantoko/<?php echo $row->transaksi_id;?>"
                            rel="detail"><i class="fa fa-money"></i> Kirim Bukti Pembayaran ke Toko</a>
                        <?php } else if ($row->transaksi_statusadmin === "paid" && $row->transaksi_confirm === "false") { ?>
                            <a style="margin-top: 30px;" class="blocks btn btn-warning btn-block btn-produk btn-sm">Menunggu Konfirmasi Toko</a>
                            <?php } else if ($row->transaksi_statusadmin === "paid" && $row->transaksi_confirm === "true" && $row->transaksi_end === "false") { ?>
                            <a style="margin-top: 30px;" class="blocks btn btn-warning btn-block btn-produk btn-sm">No Resi Sudah dikirim oleh Pemilik Toko</a>
                            <?php } ?>
                    <?php } ?>   
                        <?php if($invoice->invoice_confirm === "false" && $invoice->invoice_status === "paid") { ?>
                            <a style="margin-top: 30px;" class="btn btn-success btn-block btn-produk" data-toggle="modal" data-target="#mod-info" type="button" href="<?php echo site_url();?>website/konfirmasipembayaranpembeli/<?php echo $invoice->invoice_id;?>"
                            rel="detail"><i class="fa fa-money"></i> Konfirmasi & Kirim Bukti No Resi Ke Pembeli</a>
                        <?php } else if ($invoice->invoice_confirm === "true" && $invoice->invoice_status === "paid") { ?>
                            <a style="margin-top: 30px;" class="blocks btn btn-success btn-block btn-produk btn-sm">Sudah Dikonfirmasi</a>
                        <?php } ?>

                        <?php if($invoice->invoice_status === "unpaid") { ?>
                            <a style="margin-top: 30px;" class="blocks btn btn-warning btn-block btn-produk btn-sm">Pembeli belum melakukan Konfirmasi Pembayaran</a>
                        <?php } ?>
                    </div>
                    </div> 
                    <?php } ?>     
	                <?php } else {
                     ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="block-flat">
                            <div class="content2">
                                Belum ada data!.
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="block-flat">
                    <div id='pagination'>
                        <div class='pagination-left'>Total :
                            <?php echo $jml_data;?>
                        </div>
                        <div class='pagination-right'>
                            <ul class="pagination">
                                <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'pages/pesanan/view', $id=""); }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- ================================================== END VIEW ================================================== -->

<?php } elseif ($action == 'toko') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css" />
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Konfirmasi Pembayaran Ke Toko</h4>
</div>
<form role="form" class="form-horizontal" action="<?php echo site_url();?>website/konfirmasipembayarantoko/<?php echo $transaksi->transaksi_id; ?>"
    method="post" enctype="multipart/form-data" parsley-validate validate>
    <div class="modal-body">

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

        <div class="nama">No Transaksi : <?php echo $transaksi->transaksi_id;?></div>
        <div class="harga">Total Bayar : Rp<?php echo number_format($transaksi->transaksi_totalharga,0,',','.') ?>,00</div>

        <div class="table-responsive">
            <table class="table no-border hover">
                <tbody class="no-border-y">
                    <tr>
                        <td>
                            <label for="transaksi_bukti" class="control-label">Foto Bukti Pembayaran <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="file" name="transaksi_bukti" id="transaksi_bukti" required class="form-control btn-sm input-sm" />
                            <div class="ket">Max. data 4MB</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="simpan" value="Konfirmasi">
        <a type="button" class="btn btn-default" href="<?php echo site_url();?>website/transaksi">Kembali</a>
    </div>
</form>

<?php } elseif ($action == 'pembeli') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css" />
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Konfirmasi Pembayaran</h4>
</div>
<form role="form" class="form-horizontal" action="<?php echo site_url();?>website/konfirmasipembayaranpembeli/<?php echo $invoice->invoice_id; ?>"
    method="post" enctype="multipart/form-data" parsley-validate validate>
    <div class="modal-body">

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

        <div class="nama">No Invoice : <?php echo $invoice->invoice_id;?></div>
        <div class="harga">Total Bayar : Rp<?php echo number_format($invoice->invoice_subtotal,0,',','.') ?>,00</div>

        <div class="table-responsive">
            <table class="table no-border hover">
                <tbody class="no-border-y">
                    <tr>
                        <td>
                            <label for="invoice_resi" class="control-label">Foto Bukti Pembayaran <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="file" name="invoice_resi" id="invoice_resi" required class="form-control btn-sm input-sm" />
                            <div class="ket">Max. data 4MB</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="invoice_dikirim" class="control-label">Tanggal Dikirim <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="date" name="invoice_dikirim" id="invoice_dikirim" required class="form-control btn-sm input-sm" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="invoice_sampai" class="control-label">Tanggal Sampai <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="date" name="invoice_sampai" id="invoice_sampai" required class="form-control btn-sm input-sm" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="simpan" value="Konfirmasi">
        <a type="button" class="btn btn-default" href="<?php echo site_url();?>website/transaksi">Kembali</a>
    </div>
</form>
<?php } ?>