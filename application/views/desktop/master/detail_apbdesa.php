<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>APBDESA</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> Tahun Anggaran </td>
                                        <td><?php echo $data_utama->tahun; ?></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
					<div class='row'>
						<div class="col-md-12" >
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo"></i>
                                        <span class="caption-subject font-red-sunglo bold">Rincian Anggaran</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_15_2" data-toggle="tab"> Pendapatan </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_3" data-toggle="tab"> Belanja </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_4" data-toggle="tab"> Surplus / Defisit </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_5" data-toggle="tab"> Pembiayaan </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_6" data-toggle="tab"> Silpa / Silpa Tahun Berjalan </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_15_2">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2),'a.keterangan'=>'pendapatan'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            $nominal = 0;
                                                            if($value->nominal==NULL OR $value->nominal==''){
                                                                echo'';
                                                            }else{
                                                                $nominal = $value->nominal;
                                                            }
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="'.site_url('detail_anggaran/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-action-redo"></i> Detail Data </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab_15_3">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2),'a.keterangan'=>'pengeluaran'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            $nominal = 0;
                                                            if($value->nominal==NULL OR $value->nominal==''){
                                                                echo'';
                                                            }else{
                                                                $nominal = $value->nominal;
                                                            }
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="'.site_url('detail_anggaran/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-action-redo"></i> Detail Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-trash"></i> Hapus Data </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab_15_4">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2),'a.keterangan'=>'surplus / defisit'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            $nominal = 0;
                                                            if($value->nominal==NULL OR $value->nominal==''){
                                                                echo'';
                                                            }else{
                                                                $nominal = $value->nominal;
                                                            }
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="'.site_url('detail_anggaran/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-action-redo"></i> Detail Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-trash"></i> Hapus Data </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab_15_5">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2),'a.keterangan'=>'pembiayaan'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            $nominal = 0;
                                                            if($value->nominal==NULL OR $value->nominal==''){
                                                                echo'';
                                                            }else{
                                                                $nominal = $value->nominal;
                                                            }
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="'.site_url('detail_anggaran/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-action-redo"></i> Detail Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-trash"></i> Hapus Data </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab_15_6">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2),'a.keterangan'=>'silpa'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            $nominal = 0;
                                                            if($value->nominal==NULL OR $value->nominal==''){
                                                                echo'';
                                                            }else{
                                                                $nominal = $value->nominal;
                                                            }
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="'.site_url('detail_anggaran/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-action-redo"></i> Detail Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
                                                                                    <i class="icon-trash"></i> Hapus Data </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."apbdesa"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>